const Routers = [
    {
        path: '/eleme/goods',
        meta: {
            title: '商品列表'
        },
        component: (resolve) => require(['./views/goods/goods.vue'], resolve)
    },
    {
        path: '/eleme/ratings',
        meta: {
            title: '商品详情'
        },
        component: (resolve) => require(['./views/ratings/ratings.vue'], resolve)
    },
    {
        path: '/eleme/seller',
        meta: {
            title: '购物车'
        },
        component: (resolve) => require(['./views/seller/seller.vue'], resolve)
    },
    {
        path: '*',
        redirect: '/eleme/goods'
    }
];

export default Routers;