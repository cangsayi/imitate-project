<template>
    <div v-if="product" class="list">
        <div class="header">
            <div class="list-image"><img :src="product.image"></div>

            <div class="list-text">
                <h1>{{product.name }}</h1>
                <div class="list-cost">￥{{product.cost}}</div>
                <div class="list-cart" @click="addCart">加入购物车</div>
            </div>

        </div>
        
         <div class="product-desc">
        <h2>产品介绍</h2>
        <img v-for="n in 10" :src="'http://ordfm6aah.bkt.clouddn.com/shop/' + n + '.jpeg'">
         </div>
       
    </div>
</template>
    
<script>
    export default {
        data(){
            return{
                id:parseInt(this.$route.params.id),
                product:null
            }
        },
        computed: {
            
        },
        methods: {
            getProduct(){
                setTimeout(() =>{
            const product =this.$store.state.productList
            this.product = product.find(item => item.id===this.id);
                },500);
            },
            addCart(){
                this.$store.commit('addCart',this.id);

            }

        },
        mounted(){
            this.$store.dispatch('getProductList');
            this.getProduct();
        }

    }
</script>
    
<style scoped>

.header {
        margin: 32px;
        padding: 32px;
        background: #fff;
        border: 1px solid #dddee1;
        border-radius: 10px;
        overflow: hidden;
        
    }
    .list-image{
        width: 50%;
        height: 600px;
        float: left;
        text-align: center;
       
      
    }
.list-image img {
    width:100%;
}
.list-text {
    width: 50%;
    padding: 150px 0 250px;
    height: 150px;
     float: left;
     text-align: center;
}
.list-cost{
        color: #f2352e;
        margin: 8px 0;
    }
    .list-cart {
        display: inline-block;
        padding: 8px 64px;
        margin: 8px 0;
        background: #2d8cf0;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }
    .product-desc{
        background: #fff;
        margin: 32px;
        padding: 32px;
        border: 1px solid #dddee1;
        border-radius: 10px;
        text-align: center;
    }
    .product-desc img{
        display: block;
        width: 50%;
        margin: 32px auto;
        padding: 32px;
        border-bottom: 1px solid #dddee1;
    }
        
</style>
    