<template>
<div class="wrapper">
    <div class="shopcart">
        <div class="content" @click="toggleList">
            <div class="content-left">
                <div class="logo-wrapper">
                    <div class="logo" :class="{'highlight':totalCount>0}">
                        <i class="icon-shopping_cart" :class="{'highlight':totalCount>0}"></i>
                    </div>
                    <div class="num" v-show="totalCount>0">{{totalCount}}</div>

                </div>
                <div class="price" :class="{'highlight':totalPrice>0}">￥{{totalPrice}}</div>
                <div class="desc">另需配送费{{deliveryPrice}}元</div>
            </div>
            <div class="content-right" @click.stop="pay">
                <div class="pay" :class="payClass">{{payDesc}}</div>
            </div>
        </div>
        <div class="ball-container">
            <transition-group name="drop"  
            @before-enter="beforeEnter"
            @enter="enter"
            @after-enter="afterEnter">
             <div v-for="(ball,index) in balls" v-show="ball.show" class="ball" :key="index">
                 <div class="inner inner-hook"></div>
             </div>
            </transition-group> 
        </div>

        <transition name="fold">
        <div class="shopcart-list" v-show="listShow" >
            <div class="list-header">
                <h1 class="title">购物车</h1>
                <span class="empty" @click="empty">清空</span>
            </div>
            <div class="list-content" ref="content" >
                <ul>
                    <transition-group  name="fold-list"  tag="ul">
                    <li class="food  border-1px" v-for="(food,index) in selectFoods"  :key="index" >
                        <span class="name">{{food.name}}</span>
                        <div class="price">
                            <span>￥{{food.price*food.count}}</span>
                        </div>
                        <div class="cartcontrol-wrapper">
                            <cartcontrol :food=food  @cartadd="drop"></cartcontrol>
                        </div> 
                    </li>
                    </transition-group>
                </ul>
            </div>
        </div>
    </transition>
    </div>
    <transition name="fade">
            <div class="list-mask" @click="hideList" v-show="listShow" ></div>
    </transition>
    
</div>
</template>

<script>
     import BScroll  from  'better-scroll';
    import cartcontrol from '../cartcontrol/cartcontrol.vue';
    export default {
        props:{
            deliveryPrice:Number,
            minPrice:Number,
            selectFoods:{
                type:Array,
                default(){
                    return [];
                }
            }
           

        },
        components:{cartcontrol},
        data(){
            
            return{
                balls:[{
                   show:false 
                },
                {
                   show:false 
                },
                {
                   show:false 
                },
                {
                   show:false 
                },{
                   show:false 
                }],
                dropBalls:[],
                fold:true
            }
        },
        computed:{
            listShow(){
                if(!this.totalCount){
                    this.fold=true;
                    return false;
                }
                let show=!this.fold;
                if(show){
                    this.$nextTick(() => {
                        
                        if(!this.scroll){
                   this.scroll=new BScroll(this.$refs.content,{click:true});//引用dom不能用'-'作为分割,否则dom为undefined;
                    }else{
                    this.scroll.refresh();
                    }
                    });
                }
                return show;
            },
            totalPrice(){
                let total = 0;
                this.selectFoods.forEach((food)=>{
                    total+=food.price * food.count;
                });
                return total;
            },
            totalCount(){
                let count = 0;
                this.selectFoods.forEach((food) =>{
                    count+=food.count;
                });
                return count;
            },
            payClass(){
                if(this.totalPrice<this.minPrice){
                    return 'not-enough';
                }else{
                    return 'enough';
                }
            },
            payDesc(){
                if(this.totalPrice===0){
                    return '￥'+this.minPrice+'元起送';
                }else if(this.totalPrice<this.minPrice){
                    let diff=this.minPrice-this.totalPrice;
                    return '还差￥'+diff+'元起送';
                }else{
                    return '去结算';
                }
            }
        },
        created(){
            this.cartList=this.$store.state.cart;
           
        },
    methods:{
        pay(){
            if(this.totalPrice<this.minPrice){
                return;
            }
            let all=this.totalPrice+this.deliveryPrice;
            let c=0;
            if(this.totalPrice>=28){
                c=5;
            }
           let allc=all-c;
            alert('应付:'+all+'元,优惠:'+c+'元,实付:'+allc+'元。');

        },
        hideList(){
        this.fold=true;
        },
        empty(){
            this.selectFoods.forEach((food) =>{
                food.count=0;
            });
           
        },
        toggleList(){
        
            if(!this.totalCount){
                return;
            }
            this.fold=!this.fold;
        },
            drop(el){
              for(let i=0;i<this.balls.length;i++){
                  let ball = this.balls[i];
                  if(!ball.show){
                      ball.show=true;
                      ball.el=el;
                      this.dropBalls.push(ball);
                      return;
                  }
              }
              stopPropagation();
            },
            beforeEnter(el) {
          let count = this.balls.length;
          while (count--) {
            let ball = this.balls[count];
            if (ball.show) {
              let rect = ball.el.getBoundingClientRect();
              let x = rect.left - 32;
              let y = -(window.innerHeight - rect.top - 22);
              el.style.display = '';
              el.style.webkitTransform = `translate3d(0,${y}px,0)`;
              el.style.transform = `translate3d(0,${y}px,0)`;
              let inner = el.getElementsByClassName('inner-hook')[0];
              inner.style.webkitTransform = `translate3d(${x}px,0,0)`;
              inner.style.transform = `translate3d(${x}px,0,0)`;
            }
          }
        },
        enter(el) {
         
          let rf = el.offsetHeight;
          this.$nextTick(() => {
            el.style.webkitTransform = 'translate3d(0,0,0)';
            el.style.transform = 'translate3d(0,0,0)';
            let inner = el.getElementsByClassName('inner-hook')[0];
            inner.style.webkitTransform = 'translate3d(0,0,0)';
            inner.style.transform = 'translate3d(0,0,0)';
          });
          
        },
        afterEnter(el) {
          let ball = this.dropBalls.shift();
          if (ball) {
            ball.show = false;
            el.style.display = 'none';
          }
        }
    }
 

}
</script>

<style scoped>
.shopcart {
    width:100%;
    position: fixed;
    left:0;
    bottom:0;
    z-index: 50;
    height:48px;
    
}
.shopcart .content {
    background:#141d27;
    display: flex;
    font-size: 0;
    color:rgba(255,255,255,0.4);
}
.content .content-left{
    flex:1;


}
.content-left .logo-wrapper {
    position: relative;
    top:-10px;
    padding: 6px;
    margin: 0 12px;
    width: 56px;
    height:56px;
    box-sizing: border-box;
    vertical-align: top;
    border-radius: 50%;
    background:#141d27;
}
 .logo-wrapper,.price,.desc {
    display: inline-block;
}
.content-left .price {
    vertical-align: top;
    line-height: 24px;
    margin-top:12px;
    padding-right: 12px;
    box-sizing: border-box;
    border-right:1px solid rgba(255,255,255,0.1);
    font-size: 16px;
    font-weight: 700;
   
}
.price.highlight {
    color:white;
}
.content-left .desc {
    vertical-align: top;
    line-height: 24px;
    margin:12px 0 0 12px;
   
    font-size: 10px;

}
.logo-wrapper .logo{
    width:100%;
    height: 100%;
    border-radius: 50%;
    background:#2b343c;
    text-align: center;

}
.logo.highlight {
    background:rgb(0,160,220);
}
.logo .icon-shopping_cart.highlight {
    color:#fff;
}
.logo-wrapper .num {
    position: absolute;
    top:0;
    right:0;
    width:24px;
    height: 16px;
    line-height: 16px;
    text-align: center;
    border-radius: 16px;
    font-size: 9px;
    font-weight: 700;
    color:white;
    background:rgb(240,20,20);
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.4);

}
.logo .icon-shopping_cart {
    font-size: 24px;
    color: #80858a;
    line-height: 44px;
}
.content .content-right {
    flex: 0 0 105px;
    width:105px;
}
.content-right .pay {
    height: 48px;
    line-height: 48px;
    text-align: center;
    font-size: 12px;
    font-weight: 700;
    
}
.pay.not-enough {
    background:#2b333b;
}
.pay.enough {
    background:#00b43c;
    color:#fff;
}
.ball-container .ball {
    position: fixed;
    left:32px;
    bottom: 22px;
    z-index: 200;
}

.ball .inner {
    width:16px;
    height: 16px;
    border-radius: 50%;
    background:rgb(0,160,220);

}
.drop-enter-active {
    transition: all 0.5s cubic-bezier(0.49,-0.5,0.75,0.41);

}

.drop-enter-active .inner{
    transition: all 0.5s linear;

}
.shopcart-list {
    position: absolute;
    left: 0;
    bottom: 48px;
    z-index:-1;
    width: 100%;
}

.shopcart-list .list-header {
    height: 40px;
    line-height: 40px;
    padding: 0 18px;
    background: #f3f5f7;
    border-bottom: 1px solid rgba(7, 17, 27, 0.1);
}
.list-header .title {
    float: left;
    font-size: 14px;
    color: rgb(7, 17, 27);
}
.list-header .empty {
    float: right;
    font-size: 12px;
    color: rgb(0, 160, 220);
}
.shopcart-list .list-content{
        padding: 0 12px;
        max-height: 217px;
        overflow: hidden;
        background: #fff;
    }
.list-content .food {
          position: relative;
          padding: 12px 0;
          box-sizing: border-box;
          
        }
 .food  .name{
            line-height: 24px;
            font-size: 14px;
            color: rgb(7, 17, 27);
        }
.food .price{
            position: absolute;
            right: 110px;
            bottom: 12px;
            line-height: 24px;
            font-size: 14px;
            font-weight: 700;
            color: rgb(240, 20, 20);
           
        }
.food .cartcontrol-wrapper{
            position: absolute;
            right: 0;
            bottom: 6px;
        }
.fold-enter-active,.fold-leave-active{
    transition: all 0.5s;
    transform: translate3d(0, 0, 0);
}
.fold-enter,.fold-leave-to{
    transform: translate3d(0, 100%, 0);

}

.fold-list-leave-active {
    transition: all 0.5s;
    opacity:1;
}
.fold-list-leave-to {
    opacity: 0;
}
.list-mask {
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height: 100%;
    z-index: 40;
    backdrop-filter:blur(10px);
    background:rgba(7,17,27,0.6);
}
.fade-enter-active,.fade-leave-active {
    transition: all 0.5s;
    opacity: 1;
    background:rgba(7,17,27,0.6);
}
.fade-enter,.fade-leave-to {
    opacity: 0;
    background:rgba(7,17,27,0);

}

</style>