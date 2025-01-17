import Vue from 'vue';
import App from './App.vue'
import router from './router/config';
import '@fortawesome/fontawesome-free/css/all.min.css';

Vue.component('app-layout-default', require('./layouts/Default.vue').default);

Vue.component('app-iqomah-countdown', require('./components/IqomahCountdown.vue').default);
Vue.component('app-reminder-upcoming-time', require('./components/ReminderUpcomingTime.vue').default);
Vue.component('app-time-item', require('./components/TimeItem.vue').default);
Vue.component('app-home-slider', require('./components/HomeSlider.vue').default);

const app = new Vue({
	router: router,
	el: '#app',
	render: h => h(App)
});
