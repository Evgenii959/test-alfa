<template>
  <div class="domain">
    <h1 class="domain__title">Доменная таблица</h1>
    <table class="domain__table">
      <thead class="domain__header">
        <tr>
          <th class="domain__cell">ID домена</th>
          <th class="domain__cell">Домен</th>
          <th class="domain__cell">Количество посещений</th>
          <th class="domain__cell">Посещения за прошлый месяц</th>
          <th class="domain__cell">Количество оставленных контактов</th>
          <th class="domain__cell" @click="fetchVisitorIDs(domain)">Количество людей, оставивших контакты</th>
          <th class="domain__cell">Дата последнего оставленного контакта</th>
        </tr>
      </thead>
      <tbody class="domain__body">
        <tr v-for="domain in domains" :key="domain.id" class="domain__row">
          <td class="domain__cell">{{ domain.id }}</td>
          <td class="domain__cell">{{ domain.name }}</td>
          <td class="domain__cell">{{ domain.visits }}</td>
          <td class="domain__cell">{{ domain.visits_last_month }}</td>
          <td class="domain__cell domain__cell--clickable" @click="fetchContacts(domain)">{{ domain.contact_count }}</td>
          <td class="domain__cell domain__cell--clickable" @click="fetchVisitorIDs(domain)">{{ domain.visitor_count }}</td>
          <td class="domain__cell">{{ domain.last_contact_date }}</td>
        </tr>
      </tbody>
    </table>

    <modal v-if="showModal" @close="closeModal" class="domain__modal">
      <template #header>
        <h2 class="domain__modal-title">{{ modalTitle }}</h2>
      </template>
      <template #default>
        <ul v-if="isContactsModal" class="domain__contact-list">
          <li v-for="contact in contacts" :key="contact.id" class="domain__contact-item">{{ contact.name }}</li>
        </ul>
        <ul v-else-if="isVisitorIDsModal" class="domain__visitor-list">
          <li v-for="visitor in visitorIDs" :key="visitor.visitor_id" class="domain__visitor-item">{{ visitor.visitor_id }}</li>
        </ul>
      </template>
    </modal>
  </div>
</template>

<script>
import axios from 'axios';
import Modal from './Modal.vue';

export default {
  components: { Modal },
  data() {
    return {
      domains: [],
      contacts: [],
      visitorIDs: [],
      showModal: false,
      modalTitle: '',
      isContactsModal: false,
      isVisitorIDsModal: false,
      selectedDomain: null,
    };
  },
  created() {
    this.fetchDomains();
  },
  methods: {
    async fetchDomains() {
      try {
        const response = await axios.get('http://localhost:8000/controllers/getDomains.php');
        this.domains = response.data;
      } catch (error) {
        console.error('Ошибка при получении доменов:', error);
      }
    },
    async fetchContacts(domain) {
      try {
        this.selectedDomain = domain;
        const response = await axios.get(`http://localhost:8000/controllers/getContacts.php?domain_id=${domain.id}`);
        this.contacts = response.data.slice(0, domain.contact_count);
        this.modalTitle = `Контакты для домена ${domain.name}`;
        this.isContactsModal = true;
        this.isVisitorIDsModal = false;
        this.showModal = true;
      } catch (error) {
        console.error('Ошибка при получении контактов:', error);
      }
    },
    async fetchVisitorIDs(domain) {
      try {
        this.selectedDomain = domain;
        const response = await axios.get(`http://localhost:8000/controllers/getVisitors.php?domain_id=${domain.id}`);
        this.visitorIDs = response.data.slice(0, domain.visitor_count);
        this.modalTitle = `Люди, оставившие контакты для домена ${domain.name}`;
        this.isVisitorIDsModal = true;
        this.isContactsModal = false;
        this.showModal = true;
      } catch (error) {
        console.error('Ошибка при получении людей, оставивших контакты:', error);
      }
    },
    closeModal() {
      this.showModal = false;
    },
  },
};
</script>

<style scoped lang="css">
.domain {
  margin: 20px;
  font-family: Arial, sans-serif;
}

.domain__title {
  font-size: 24px;
  margin-bottom: 20px;
}

.domain__table {
  width: 100%;
  border-collapse: collapse;
}

.domain__header {
  background-color: #f2f2f2;
}

.domain__cell {
  padding: 12px;
  border: 1px solid #ccc;
  text-align: left;
}

.domain__cell--clickable {
  cursor: pointer;
  color: blue;
}

.domain__cell--clickable:hover {
  text-decoration: underline;
}

.domain__body {
  background-color: #fff;
}

.domain__row:nth-child(even) {
  background-color: #f9f9f9;
}

.domain__modal-title {
  font-size: 20px;
}

.domain__contact-list,
.domain__visitor-list {
  list-style-type: none;
  padding: 0;
}

.domain__contact-item,
.domain__visitor-item {
  padding: 8px 0;
  border-bottom: 1px solid #ccc;
}
</style>