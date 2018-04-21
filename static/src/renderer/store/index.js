import Vue from 'vue';
import Vuex from 'vuex';
import modules from './modules';
import actions from './actions';
import mutations from './mutations';

Vue.use(Vuex);

const state = {
    editObj:null
};

export default new Vuex.Store({
    state,
    mutations,
    actions,
    modules,
    strict: process.env.NODE_ENV !== 'production'
})
