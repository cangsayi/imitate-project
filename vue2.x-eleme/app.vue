<template>
  <div>
    <headers :seller="getSeller"></headers>
    <div class="tab border-1px">
       <router-link to="/eleme/goods">商品</router-link>
       <router-link to="/eleme/ratings">评论</router-link>
       <router-link to="/eleme/seller">商家</router-link>
    </div>

    <router-view  @cartadd="_drop" :seller="getSeller" :goods="getGoods" :ratings="getRatings"></router-view>
    <shopcart  ref="shopcart"  
     :select-foods="selectFoods" 
    :delivery-price="getSeller.deliveryPrice" 
    :min-price="getSeller.minPrice"></shopcart>
  </div>
</template>
<script>
  import shopcart from './components/shopcart/shopcart.vue';
  import  headers  from './components/header/header.vue';
  export default {
    data(){
      return{

      }
    },
    components: {headers,shopcart},
    computed: {
        getSeller(){
             return this.$store.state.seller;
        },
        getGoods(){
            return this.$store.state.goods;
        },
        getRatings(){
          return this.$store.state.ratings;
        },
        selectFoods(){
        let foods=[];
        this.getGoods.forEach((good) => {
            good.foods.forEach((food)=>{
                if(food.count){
                    foods.push(food);
                }
            });
        });
        return foods;
      }
    
    },  
    methods:{
      _drop(target){
        this.$nextTick(() =>{
          this.$refs.shopcart.drop(target);  
        });

      }
    } ,
    mounted(){
          this.$store.dispatch('getSeller');
          this.$store.dispatch('getGoods');
          this.$store.dispatch('getRatings');
     }
  

  }
</script>

<style scoped>
 .tab {
 width:100%;
 height:40px;
 line-height: 40px;
 display: flex;
position: relative;
 }
 
 a{
  flex:1;
  float: left;
  color:rgb(77,85,93);
  display: block;
  text-align: center;
  font-size:16px;
  
 }
 .router-link-active {
        color:red;
      }
     
  
</style>