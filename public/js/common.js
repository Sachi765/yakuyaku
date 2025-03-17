function togglePushNotification() {
    const checkbox = document.getElementById('push_notification');
    const toggle = document.getElementById('push_notification_toggle');
    const button = toggle.parentElement;

    checkbox.checked = !checkbox.checked;

    if (checkbox.checked) {
        button.classList.remove('bg-gray-200', 'border-gray-300');
        button.classList.add('bg-green-500', 'border-green-500');
        toggle.classList.add('translate-x-6');
    } else {
        button.classList.remove('bg-green-500', 'border-green-500');
        button.classList.add('bg-gray-200', 'border-gray-300');
        toggle.classList.remove('translate-x-6');
    }
}