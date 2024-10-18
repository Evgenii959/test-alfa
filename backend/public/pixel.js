window.addEventListener('DOMContentLoaded', () => {
  // Собираем данные о визите
  const visitData = {
    domain: window.location.hostname,
    userAgent: navigator.userAgent,
    browser: getBrowserInfo(),
    device: getDeviceType(),
    platform: navigator.platform,
    visit_time: new Date().toISOString().slice(0, 19).replace('T', ' '), // Преобразование формата
  };

  // Отправляем данные на сервер
  fetch('http://localhost:8000/controllers/visit.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(visitData),
  })
    .then((response) => response.text())
    .then((data) => {
      console.log('Visit data sent:', data);
    })
    .catch((error) => console.error('Error:', error));

  function getBrowserInfo() {
    let userAgent = navigator.userAgent;
    let browserName = '';

    if (userAgent.indexOf('Firefox') > -1) {
      browserName = 'Mozilla Firefox';
    } else if (
      userAgent.indexOf('Opera') > -1 ||
      userAgent.indexOf('OPR') > -1
    ) {
      browserName = 'Opera';
    } else if (userAgent.indexOf('Chrome') > -1) {
      browserName = 'Google Chrome';
    } else if (userAgent.indexOf('Safari') > -1) {
      browserName = 'Apple Safari';
    } else if (
      userAgent.indexOf('MSIE') > -1 ||
      userAgent.indexOf('Trident') > -1
    ) {
      browserName = 'Microsoft Internet Explorer';
    } else {
      browserName = 'Unknown';
    }

    return browserName;
  }

  function getDeviceType() {
    const ua = navigator.userAgent;
    if (/Mobile|Android|iP(hone|od)|IEMobile|BlackBerry/i.test(ua)) {
      return 'Mobile';
    } else if (/Tablet|iPad/i.test(ua)) {
      return 'Tablet';
    } else {
      return 'Desktop';
    }
  }
});
