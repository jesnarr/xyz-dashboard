import Vue from 'vue';
// import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        counter: 1000,
        deleteModalObj:{
            showDeleteModal: false,
            deleteUrl: '',
            data: null,
			deletingIndex: -1,
            isDeleted: false,
        }
    },
    getters: {
        getCounter(state){
            return state.counter;
        }, 
        getDeleteModalObj(state){
            return state.deleteModalObj;
        }
    },
    mutations:{
        changeTheCounter(state, payload){
                state.counter += payload;
        },
        setDeleteModal(state){
            state.deleteModalObj.isDeleted = true;
        }
    },
    actions: {
        changeCounterAction({commit}, payload){
           commit('changeTheCounter', payload);
        }   
    }
});