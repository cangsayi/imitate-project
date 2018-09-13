<template>
<transition name="move">
<div v-show="showFlag" class="food" ref="food">
  <div class="food-content">
    <div class="image-header">
        <img :src="food.image">
        <div class="back" @click="hide">
        <i class="icon-arrow_lift"></i>
        </div>
    </div>   

    <div class="content">
        <h1 class="title">{{food.name}}</h1>
        <div class="detail">
            <span class="sell-count">月售{{food.sellCount}}份</span>
            <span class="rating">好评率{{food.rating}}%</span>
        </div>
        <div class="price">
            <span class="now">￥{{food.price}}</span><span
            class="old" v-show="food.oldPrice">￥{{food.oldPrice}}</span>
        </div>
        <div class="cartcontrol-wrapper" v-show="food.count>=1">
             <cartcontrol :food="food" @cartadd="cartaddc"></cartcontrol>
        </div>
        <transition name="cart">
        <div class="buy"  @click.stop.prvent="addFirst"  v-show="!food.count || food.count===0">加入购物车</div>
        </transition>
    </div>
    <split v-show="food.info"></split>
    <div class="info" v-show="food.info">
        <div class="title">商品信息</div>
        <p class="text">{{food.info}}</p>
    </div>
    <split></split>
    <div class="rating">
        <h1 class="title">商品评价</h1>
        <ratingselect  
        :ratings="food.ratings" 
        :desc="desc"  
        :select="selectType"
         :only-content="onlyContent"  @type="seleType" @tog="toggle"></ratingselect>
         <div class="rating-wrapper">
           <ul v-show="food.ratings && food.ratings.length"  >
               <li v-show="needShow(rating.rateType,rating.text)" v-for="(rating,index) in food.ratings" class="rating-item  border-1px" :key="index">
                   <div class="user">
                       <span class="name">{{rating.username }}</span>
                       <img :src="rating.avatar" class="avatar" width="12" height="12" />
                   </div>
                   <div class="time">{{rating.rateTime |formatDate}}</div>
                   <p class="text">
                       <span :class="{'icon-thumb_up':rating.rateType===0,
                       'icon-thumb_down':rating.rateType===1}"></span>{{rating.text}}
                   </p>
               </li>
           </ul>
           <div class="no-rating"  v-show="!food.ratings || !food.ratings.length">
            暂无评价
           </div>
         </div>
    </div>
  </div> 
</div>
</transition>
</template>

<script>
    const POSITIVE = 0;
    const NEGATIVE = 1;
    const ALL = 2;
    import Vue from 'vue';
    import Bscroll from 'better-scroll';
    import cartcontrol from '../cartcontrol/cartcontrol.vue';
    import split from '../split/split.vue';
    import ratingselect from '../ratingselect/ratingselect.vue';
    import {formatDate} from '../../date.js';
    export default {
        components:{cartcontrol,split,ratingselect},
        props:{
            food:{
                type:Object
                
            }
        },
        filters:{
            formatDate(time){
               
                return formatDate(time);
            }
        },
        computed:{
            
        },
        data(){
            return{
                showFlag:false,
                selectType:ALL,
                onlyContent:true,
                desc:{
                    all:'全部',
                    positive:'推荐',
                    negative:'吐槽'
                }
            }
        },
        methods:{
            seleType(type){
                this.selectType=type;
                this.$nextTick(()=>{
                    this.scroll.refresh();
                });
            },
            toggle(content){
                this.onlyContent=content;
                this.$nextTick(()=>{
                    this.scroll.refresh();
                });
            },
            needShow(type,text){
                if(this.onlyContent && !text){
                    return false;
                }
                if(this.selectType===ALL){
                    return true;
                }else{
                    return type===this.selectType;
                }

            },
            cartaddc(el){
             this.$emit('cartadd',el);
            },
            hide(){
                this.showFlag=false;
            },
            show(){
               this.selectType=ALL;
                this.onlyContent=true;
                this.showFlag=true;
                this.$nextTick(() =>{
                    if(!this.scroll){
                        this.scroll = new Bscroll(this.$refs.food,{click:true});
                    }else{
                        this.scroll.refresh();
                    }
                });
            },
            addFirst(event){
                if(!event._constructed)return;
                Vue.set(this.food,'count',1);
                this.$emit('cartadd',event.target);
            }
        }
    }
</script>

<style scoped>
    .food {
        position: fixed;
        left:0;
        top:0;
        bottom:48px;
        z-index: 30;
        width:100%;
        background:white;
    }
.move-enter-active,.move-leave-active {
    transition: all 0.2s linear;
    transform: translate3d(0,0,0);
}
.move-enter,.move-leave-to {
    transform:translate3d(100%,0,0);
}

.food .image-header {
  
    position: relative;
    width:100%;
    height: 0;
    padding:50%;
}
.image-header img {
    position: absolute;
    top:0;
    left:0;
    width:50%;
    height:100%; 
}
.image-header .back {
    position: absolute;
    top:10px;
    left:0;
}
.back .icon-arrow_lift {
    display: block;
    padding: 10px;
    font-size:20px;
    color:white;
}
.food .content {
    padding: 18px;
    position: relative;

}
.content .title {
    line-height: 14px;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 700;
    color:rgb(7,17,27);
}
.content .detail{
    margin-bottom: 18px;
    line-height: 10px;
    font-size: 0;
    height:10px;
}
.detail .sell-count,.rating {
    font-size: 10px;
    color:rgb(147,153,159);
   
}
.detail .sell-count{
    margin-right: 12px;
}
.content .price {
    font-weight: 700;
    line-height: 24px;
}
.price .now {
    margin-right:8px;
    font-size: 14px;
    color:rgb(240,20,20);
}
.price .old{
    text-decoration: line-through;
    font-size: 10px;
    color:rgb(147,153,159);
}
.food  .cartcontrol-wrapper {
    position:absolute;
    right: 12px;
    bottom:12px;
}
.food .buy {
    position: absolute;
        right: 18px;
        bottom: 18px;
        z-index: 10;
        height: 24px;
        line-height: 24px;
        padding: 0 12px;
        box-sizing: border-box;
        border-radius: 12px;
        font-size: 10px;
        color: #fff;
        background: rgb(0, 160, 220);
}

.cart-enter-active,.cart-leave-active{
    transition: all 0.2s;
    transform: translate3d(0,0,0);
    
}
.cart-enter,.cart-leave-to{
    transform: translate3d(100%,0,0);
}
.info{
    padding: 18px;

}
.info .title {
    line-height: 14px;
    margin-bottom: 6px;
    font-size: 14px;
    color:rgb(7,17,27);
}
.info .text {
    line-height: 24px;
    padding:0 8px;
    font-size: 12px;
    color:rgb(77,85,93);

}
.rating {
    padding-top:18px;
}
.rating .title {
    line-height: 14px;
    margin-left: 18px;
    font-size: 14px;
    color:rgb(7,17,27);
}
.rating-wrapper {
    padding: 0 18px;

}
.rating-wrapper .rating-item {
    position: relative;
    padding: 16px 0;

}
.rating-item .user {
    position: absolute;
    right:0;
    top:16px;
    font-size: 0;
    line-height: 12px;
}
.user .name {
    display: inline-block;
    vertical-align: top;
    font-size: 10px;
    color:rgb(147,153,159);
    margin-right:6px;
}
.user .avatar {
    border-radius: 50%;
}
.rating-item .time {
    font-size: 10px;
    line-height: 12px;
    color:rgb(147,153,159);
    margin-bottom: 6px;
}
.rating-item .text {
    line-height: 16px;
    font-size: 12px;
    color:rgb(7,17,27);
}
.text  .icon-thumb_up,.icon-thumb_down{
    line-height: 16px;
    margin-right: 4px;
    font-size: 12px;
   
}
.text .icon-thumb_up {
    color:rgb(0, 160, 220);
}
.text .icon-thumb_down {
    color:rgb(147,153,159);

}
.no-rating {
    padding:16px 0;
    font-size: 12px;
    color:rgb(147,153,159);
}
</style>