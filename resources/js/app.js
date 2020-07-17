/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(VueAxios, axios);

import { library } from '@fortawesome/fontawesome-svg-core'
import { 
    faMapMarkerAlt, faDesktop, faAngleUp, faHome,faMugHot, faGlasses, 
    faCloud, faTimes, faBed, faBath, faMapMarkedAlt, faChevronCircleUp,
    faCheck,faSearch, faUsers,
} 
from '@fortawesome/free-solid-svg-icons'
import { faFacebookF, faTwitter, faInstagram, faLinkedinIn } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faMapMarkerAlt, faDesktop, faFacebookF, faTwitter, 
    faInstagram, faLinkedinIn ,faAngleUp, faHome, faMugHot,
    faGlasses, faCloud, faTimes, faBed, faBath, faMapMarkedAlt,
    faChevronCircleUp,faCheck,faSearch,faUsers
);
 
Vue.component('font-awesome-icon', FontAwesomeIcon)



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('scrollto', require('./components/Navigation/scrollTo.vue').default);
Vue.component('slider', require('./components/Slidershow/Slider.vue').default);
Vue.component('backtop', require('./components/Navigation/BackTop.vue').default);
Vue.component('nav_mobile', require('./components/Navigation/MenuMobile.vue').default);
Vue.component('mobilenav', require('./components/Navigation/MenuMobile.vue').default);
Vue.component('image-upload', require('./components/Image/ImageUpload.vue').default);
Vue.component('search-filter', require('./components/Search/SearchFilter.vue').default);
Vue.component('list-estate', require('./components/RealEstate/ListEstate.vue').default);
Vue.component('carousel', require('./components/RealEstate/Carousel.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store';

const app = new Vue({
    el: '#app',
    store
});
