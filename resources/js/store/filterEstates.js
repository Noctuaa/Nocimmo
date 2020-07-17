/**
 * Vuex for searchfilter.
 * We use Vuex to retrieve the data, paging with the filter, and send it to the real estate list, we keep the filters used in the filterData object.
 * If it's okay, we reset the realEstates array, the pagination object and the filter state becomes false
 */
const state = {
    realEstates: Array,
    pagination: Object,
    filterData: Object,
    filter: null,
}

const mutations = {
    SUCCESS(state, payload) {
        state.filter = true;
        state.realEstates = payload.realEstates;
        state.pagination = payload.pagination;
        state.filterData = payload.filterData;
    },

    RESET(state) {
        state.filter = false;
        state.realEstates = Array;
        state.pagination = Object;
    },
}

// We define the getters we can call in the other components to get information
const getters = {
    realEstates: (state) => state.realEstates,
    filter: (state) => state.filter,
    paginate: (state) => state.pagination,
    filterData: (state) => state.filterData
}

const actions = {
    success: ({commit}, payload) => {
        commit('SUCCESS', {
            realEstates : payload.realEstates,
            pagination: payload.pagination,
            filterData: payload.filterData,
        })
    },
    reset:({commit}, payload) => {
        commit('RESET', payload)
    },
}

export default {
    state,
    mutations,
    getters,
    actions
}