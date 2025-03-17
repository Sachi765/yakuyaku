import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

import Echo from 'laravel-echo';

Pusher.logToConsole = true;

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: import.meta.env.REVERB_APP_KEY,
  cluster: import.meta.env.REVERB_APP_CLUSTER, 
  forceTLS: true,
});

Echo.channel('my-channel')
.listen('my-event', (data) => {
  console.log('受信したメッセージ:', data);
    //console.log(data.message); // メッセージデータを取得
});
