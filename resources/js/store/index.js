import Vue from 'vue';
import Vuex from 'vuex';

import filterEstates from './filterEstates';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        filterEstates
    }
});