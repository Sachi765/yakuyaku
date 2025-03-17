import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// window.Echo.channel('status-updated')
// .listen('StatusUpdated', (e) => {
//   const reservationStatusElement = document.getElementById('reservation-status');
//   reservationStatusElement.innerHTML = `ステータスが更新されました: ${JSON.stringify(e.reservation)}`;
// });

