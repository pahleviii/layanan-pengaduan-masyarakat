import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

// Import Toast
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';

const app = createApp(App);

// Use Toast with custom options
app.use(Toast, {
    position: 'top-right',
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: false,
    closeButton: 'button',
    icon: true,
    rtl: false,
    transition: 'Vue-Toastification__fade',
    maxToasts: 3,
    newestOnTop: true
});

app.use(router);
app.mount('#app');
