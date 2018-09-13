import Vue from 'vue';
import VueRouter from 'vue-router';
import Routers from './router';
import Vuex from 'vuex';
import App from './app.vue';
import Data from './data.js';
import './css/reset.css';
import './style.css';
import './resource/sell-icon.css';
import  data  from  './data.js';

Vue.use(VueRouter);
Vue.use(Vuex);

// 路由配置
const RouterConfig = {
    // 使用 HTML5 的 History 路由模式
    mode: 'history',
    routes: Routers
};
const router = new VueRouter(RouterConfig);

router.beforeEach((to, from, next) => {
    window.document.title = to.meta.title;
    next();
});

router.afterEach((to, from, next) => {
    window.scrollTo(0, 0);
});



const store = new Vuex.Store({
    state: {
        seller:{},
        goods: [],
        ratings: [],
        
    },
    getters: {
        
       
    },
    mutations: {
        setSeller(state,data){
            state.seller=data;
        },
        setGoods(state,data){
            state.goods=data;
        },
        setRatings(state,data){
            state.ratings=data;
        },
      
    },
    actions: {
        getSeller(context){
            setTimeout(() => {
                context.commit('setSeller',data.seller);
            },500);
        },
        getGoods(context){
            setTimeout(() => {
                context.commit('setGoods',data.goods);
            },500);
        },
        getRatings(context){
            setTimeout(() => {
                context.commit('setRatings',data.ratings);
            },500);
        }

    }

});

new Vue({
    el: '#app',
    router: router,
    store: store,
    render: h =>  h(App)
    
    
});