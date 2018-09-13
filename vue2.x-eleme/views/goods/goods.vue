<template>
<div>
    <div class="goods">
        <div class="menu-wrapper" ref="menu">
            <ul>
                <li @click="selectMenu(index,$event)" v-for="(item,index) in getGoods" class="menu-item " :class="{'current': index===currentIndex}">
                    <span class="text border-1px">
                       <span v-show="item.type>0" class="icon" :class="classMap[item.type]"></span>{{item.name}}
                    </span>
                </li>
            </ul>
        </div>

        <div class="goods-wrapper"  ref="goods">
            <ul>
                <li v-for="item in getGoods" class="food-list">
                    <h1 class="title">{{item.name}}</h1>
                    <ul>
                        <li  @click="selectFood(food,$event)" v-for="food in item.foods" class="food-item border-1px">
                            <div class="icon">
                                <img :src="food.icon">
                            </div>
                            <div class="content">
                                <h2 class="name">{{food.name}}</h2>
                                <p class="desc">{{food.description}}</p>
                                <div class="extra">
                                    <span class="count">月售{{food.sellCount}}份</span><span
                                    class="rating">好评率{{food.rating}}%</span>
                                    
                                </div>
                                <div class="price" ref="price">
                                    <span class="now">￥{{food.price}}</span><span
                                     class="old" v-show="food.oldPrice">￥{{food.oldPrice}}</span>
                                </div>
                                <div class="cartcontrol-wrapper">
                                <cartcontrol :food="food"  @cartadd="_drop"></cartcontrol>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
   
    </div>
<food :food="selectedFood"  @cartadd="_drop"   ref="food"></food>
</div>
 </template>
    
 <script>
     import food from '../../components/food/food.vue';
     import BScroll  from  'better-scroll';
     import shopcart from '../../components/shopcart/shopcart.vue';
     import cartcontrol from '../../components/cartcontrol/cartcontrol.vue';
export default {
    props:{
        seller:Object,
        goods:Array
    },
    components: {shopcart,cartcontrol,food},
    
    data(){
        return {
         listHeight:[],
         scrollY:0,
         selectedFood:{}

        }
    },
    computed: {
        getGoods(){
            return this.goods;
        },
        currentIndex() {
        for (let i = 0; i < this.listHeight.length; i++) {
          let height1 = this.listHeight[i];
          let height2 = this.listHeight[i + 1];
          if (!height2 || (this.scrollY >= height1 && this.scrollY < height2)) {
            return i;
          }
        }
        return 0;
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
    created(){
       
        this.classMap=['decrease','discount','special','invoice','guarantee'];
        this.$nextTick( () => {
            this._initScroll();
            
           
        });
         setTimeout(()=>{
            this._calculateHeight();
            },1000);
    },
    methods:{
        selectFood(food,event){
            if(!event._constructed)return;
           
            this.selectedFood=food;
            this.$refs.food.show();
        },
        _drop(target){

        this.$emit('cartadd',target);
        },
        selectMenu(index,event){
            if(!event._constructed)
            return;
            let foodList =document.getElementsByClassName('food-list');
            let el = foodList[index];
            this.foodsScroll.scrollToElement(el,300);
        },
        _initScroll(){
           
            this.menuScroll = new BScroll(this.$refs.menu, {
        click:true
        });

        this.foodsScroll = new BScroll(this.$refs.goods, 
        {probeType:3,click:true});
        this.foodsScroll.on('scroll', (pos) => {
          this.scrollY = Math.abs(Math.round(pos.y));
        });
        },
        _calculateHeight() {
        let foodList =document.getElementsByClassName('food-list');
      
        let height = 0;
        this.listHeight.push(height);
        for (let i = 0; i < foodList.length; i++) {
          let item = foodList[i];
          height += item.clientHeight;
          this.listHeight.push(height);
        }
      }
    }
   
}
 </script>
    
<style scoped>
.goods {
    position: absolute;
    display: flex;
    top:174px;
    bottom:46px;
    width:100%;
    overflow: hidden;
}
.menu-wrapper {
    flex:0 0 80px;
    width:80px;
    background:#f3f5f7;
}
.menu-wrapper .menu-item {
    display: table;
    height: 54px;
    width: 56px;
    padding: 0 12px;
    line-height: 14px;
    
}
.menu-item.current {
    position: relative;
    z-index: 10;
    margin-top: -1px;
    background:#fff;
    font-weight: 700;

    
}

.current .text::after{
    display: none;
}
.menu-item .icon {
        display: inline-block;
        vertical-align: top;
        width: 12px;
        height: 12px;
        margin-right: 2px;
        background-size:12px 12px;
        background-repeat: no-repeat;
    }

.menu-item .text {
    position: relative;
    font-size: 12px;
    display: table-cell;
    width:56px;
    vertical-align:middle;
    
}

.goods-wrapper {
    flex:1;

}
.goods-wrapper .title {
    padding-left:14px;
    height:26px;
    line-height: 26px;
    border-left: 2px solid #d9dde1;
    font-size:12px;
    color:grb(147,153,159);
    background:#f3f5f7;
}
.goods-wrapper .food-item {
    display: flex;
    margin:18px;
    position: relative;
    padding-bottom: 18px;
    

}
.food-item:last-child {
    margin-bottom: 0;
}
.food-item:last-child::after{
    display: none;
}
.food-item .icon {
    margin-right: 2px;
    flex: 0 0 57px;
}
.food-item .content {
    flex:1;
    
}
.content .name {
    margin:2px 0 8px 0;
    height: 14px;
    line-height: 14px;
    font-size: 14px;
    color:rgb(7,17,27);
    
}
.content .desc  {
    display: inline-block;
   padding: 2px 0;
   line-height: 15px;
    font-size: 10px;
    color:rgb(147,153,159);
    margin-bottom: 8px;
}
.content .extra {
    font-size: 5px;
}
 .extra .count {
   margin-right:2px;
}

.content .price {
    font-weight: 700;
    line-height: 24px;
}
.content .cartcontrol-wrapper{
    position: absolute;
    right:0;
    bottom: 12px;
}
.price .now {
    margin-right: 4px;
    font-size: 14px;
    color:rgb(240,20,20);
}
.price .old {
    text-decoration: line-through;
    font-size: 10px;
    color:rgb(147,153,159);
}
 </style>