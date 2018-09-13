<template>
   <div class="comtainer">
       <div class="header">
           <router-link to="/list"><span class="header-left">电商网站示例</span></router-link>
           <router-link to="/cart" class="header-right">购物车
            <span  class="cart-length" v-if="cartList.length" >
                {{cartList.length}}</span> </router-link>
        </div>
        <router-view></router-view>
   </div>
</template>
<script>
  

    export default {
        computed:{
            cartList(){
                return this.$store.state.cartList;
            }
        },
       
       
    }
</script>
<style scoped>
    .header {
        width: 100%;
        height: 50px;
        background-color:#4A4A4A;

    }
    .header-left, .header-right {
        margin-left: 30px;
        color:white;
        line-height:50px;
        text-decoration:none;

    }
    .header-right {
        position: absolute;
        right: 30px;
    }
    .cart-length {
        display: inline-block;
        width:30px;
        height:30px;
        line-height: 30px;
        border-radius: 50%;
        background-color:red;
        text-align: center;
    }
</style>