<template>
<div class="cartcontrol" >
    <transition name="move">
        <div class="cart-decrease" v-show="food.count>0" @click.stop="decCart">
           <span class="inner  icon-dec_circle" ></span>
        </div>
    </transition>
    <div class="cart-count" v-show="food.count>0">{{food.count}}</div>
    <div class="cart-add  icon-add_circle" @click.stop="addCart"></div>

</div>
</template>

<script>
      import Vue from 'vue';
     export default {
    props:{
        food:{
            type:Object
            
        }
       
    },
    created(){
        
    },
    methods:{
        addCart(event){
            if(!event._constructed)return;
             if(!this.food.count){
                 Vue.set(this.food,'count',1);
                
            }else{
                this.food.count++;
             
            }
           
            this.$emit('cartadd',event.target);
        },
        decCart(event){
            if(!event._constructed)return;
            this.food.count--;
        }
    }

}
</script>

<style scoped>
    .cartcontrol {
        font-size: 0;
    }
    .cartcontrol .cart-decrease{
        display:inline-block;
        padding: 6px;
    }
    .cart-decrease .inner {
        display: inline-block;
        line-height: 24px;
     font-size: 24px;
     color:rgb(0,160,220);
    }
 .cartcontrol .cart-add{
     display: inline-block;
     padding: 6px;
     line-height: 24px;
     font-size: 24px;
     color:rgb(0,160,220);
 }
 .cartcontrol .cart-count{

      display: inline-block;
        font-size: 10px;
        padding: 6px;
        color:rgb(147,153,159);
        line-height: 24px;
        text-align: center;
        vertical-align: top;
        width:12px;
      }
.move-enter-active,.move-leave-active{
    transition: all 0.5s linear;
    opacity: 1;
    transform:translate3d(0, 0, 0);
}
.move-enter,.move-leave-to {
    opacity: 0;
    transform: translate3d(48px, 0, 0);
}
.move-enter-active .inner,.move-leave-active .inner{
    transition: all 0.5s linear;
    transform: rotate(0);
}
.move-enter .inner,.move-leave-to .inner{
    transform: rotate(360deg);
}


 

</style>