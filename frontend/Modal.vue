<template>
  <div class="modal-overlay" @click.self="$emit('close')">
    <div class="modal">
      <header class="modal-header">
        <slot name="header"></slot>
        <button class="modal-close" @click="$emit('close')">&times;</button>
      </header>
      <section class="modal-body">
        <slot></slot>
      </section>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Modal',
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal {
  background: white;
  padding: 20px;
  border-radius: 8px;
  width: 500px;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal-close {
  background: none;
  border: none;
  font-size: 20px;
  cursor: pointer;
}
</style>