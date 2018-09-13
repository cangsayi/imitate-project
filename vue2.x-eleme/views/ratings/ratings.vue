<template>
  <div class="wrapper">
    <div class="ratings" ref=ratings>
        <div class="ratings-content">
          <div class="overview">
            <div class="overview-left">
              <h1 class="score">{{seller.score}}</h1>
              <div class="title">综合评分</div>
              <div class="rank">高于周边商家{{seller.rankRate}}%</div>
            </div>
            <div class="overview-right">
              <div class="score-wrapper">
                <span class="title">服务态度</span>
                <span class="star"><star :size="36" :score="seller.serviceScore" class="star"></star></span>
                <span class="score">{{seller.serviceScore}}</span>
              </div>
              <div class="score-wrapper">
                <span class="title">商品评分</span>
                <span class="star"><star :size="36" :score="seller.foodScore"></star></span>
                <span class="score">{{seller.foodScore}}</span>
              </div>
              <div class="delivery-wrapper">
                <span class="title">送达时间</span>
                <span class="delivery">{{seller.deliveryTime}}分钟</span>
              </div>
            </div>
          </div>
          <split></split>
          <ratingselect 
          :select="selectType" 
          :only-content="onlyContent" 
          :desc="desc"
         :ratings="ratings"
         @type="seleType" @tog="toggle"></ratingselect>

          <div class="rating-wrapper">
            <ul>
              <li v-for="rating in ratings" v-show="needShow(rating.rateType, rating.text)" class="rating-item border-1px">
                <div class="avatar">
                  <img width="28" height="28" :src="rating.avatar">
                </div>
                <div class="content">
                  <h1 class="name">{{rating.username}}</h1>
                  <div class="star-wrapper">
                    <span class="star"><star :size="24" :score="rating.score"></star></span>
                    <span class="delivery" v-show="rating.deliveryTime">{{rating.deliveryTime}}分钟到达</span>
                  </div>
                  <p class="text">{{rating.text}}</p>
                  <div class="recommend" v-show="rating.recommend && rating.recommend.length">
                    <span class="icon-thumb_up"></span>
                    <span class="item" v-for="item in rating.recommend">{{item}}</span>
                  </div>
                  <div class="time">
                    {{rating.rateTime | formatDate}}
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
     
    </div>
</template>

<script>
  import shopcart from '../../components/shopcart/shopcart.vue';
  import BScroll from 'better-scroll';
  import {formatDate} from '../../date.js';
  import star from '../../components/star/star.vue';
  import ratingselect from '../../components/ratingselect/ratingselect.vue';
  import split from '../../components/split/split.vue';

  const ALL = 2;
  const ERR_OK = 0;

  export default {
    props: {
      seller: {
        type: Object
      },
      goods:Array,
      ratings:{
          type:Array,
          default(){
              return []
          }
      }
    },
    data() {
      return {
        selectType: ALL,
        onlyContent: true,
        desc:{
                    all:'全部',
                    positive:'满意',
                    negative:'不满意'
            }
     }
      
    },
    computed:{
      getGoods(){
            return this.goods;
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
    created() {
          this.$nextTick(() =>{
            this.scroll = new BScroll(this.$refs.ratings, {
              click: true
            });
          });
              
    },
    methods: {
        seleType(type){
         this.selectType = type;
        this.$nextTick(() => {
          this.scroll.refresh();
        });
        },
        toggle(onlyContent){
            this.onlyContent = onlyContent;
        this.$nextTick(() => {
          this.scroll.refresh();
        }); 
        },
      needShow(type, text) {
        if (this.onlyContent && !text) {
          return false;
        }
        if (this.selectType === ALL) {
          return true;
        } else {
          return type === this.selectType;
        }
      }
    },
    filters: {
      formatDate(time) {
      
        return formatDate(time);
      }
    },
    components: {
      star,
      split,
      ratingselect,
      shopcart
    }
  }
</script>

<style scoped>
.ratings {
    position: absolute;
    top: 174px;
    bottom: 0;
    left: 0;
    width: 100%;
    
    overflow: hidden;
}
.overview{
      display: flex;
      padding: 10px 0;
    }
 .overview .overview-left{
        flex: 0 0 137px;
        padding: 6px 0;
        width: 137px;
        border-right: 1px solid rgba(7, 17, 27, 0.1);
        text-align: center;
        vertical-align: middle;

}
@media only screen and (max-width: 320px){
    .overview .overview-left {  
       flex: 0 0 120px;
          width: 120px;
    }  
}
  .overview-left  .score{
          margin-bottom: 6px;
          line-height: 28px;
          font-size: 24px;
          color: rgb(255, 153, 0);
        }
    .overview-left .title{
          margin-bottom: 6px;
          line-height: 12px;
          font-size: 12px;
          color: rgb(7, 17, 27);
        }
    .overview-left .rank{
          line-height: 10px;
          font-size: 10px;
          color: rgb(147, 153, 159);
        }
    .overview-right{
        flex: 1;
        padding: 6px 0 6px 12px;
    }
 @media only screen and (max-width: 320px){
    .overview-right{
        padding-left: 6px;
    }    

 }
 .overview-right .score-wrapper{
          margin-bottom: 8px;
          font-size: 0;
        }
.score-wrapper .title{
            display: inline-block;
            line-height: 18px;
            vertical-align: top;
            font-size: 12px;
            color: rgb(7, 17, 27);
        }
 .score-wrapper .star{
            display: inline-block;
            margin: 0 6px;
            vertical-align: top;
        }
 .score-wrapper .score{
            display: inline-block;
            line-height: 18px;
            vertical-align: top;
            font-size: 12px;
            color: rgb(206, 137, 35);
        }
.delivery-wrapper{
          font-size: 0;
}
 .delivery-wrapper .title{
      line-height: 18px;
      font-size: 12px;
      color: rgb(7, 17, 27);
        }
.delivery-wrapper .delivery{
    margin-left: 12px;
    font-size: 12px;
    color: rgb(147, 153, 159);
        }
.rating-wrapper{
      padding: 0 18px;
    }
.rating-wrapper .rating-item{
        position: relative;
        display: flex;
        padding: 18px 0;
      
    }
.rating-item  .avatar{
          flex: 0 0 28px;
          width: 28px;
          margin-right: 12px;
        }
      .avatar img{
            border-radius: 50%;
        }
.rating-item  .content{
          position: relative;
          flex: 1;
        }
.content .name{
            margin-bottom: 4px;
            line-height: 12px;
            font-size: 10px;
            color: rgb(7, 17, 27);
        }
.content  .star-wrapper{
            margin-bottom: 6px;
            font-size: 0;
        }
.star-wrapper .star{
              display: inline-block;
              margin-right: 6px;
              vertical-align: top;
            }
.star-wrapper .delivery{
              display: inline-block;
              vertical-align: top;
              line-height: 12px;
              font-size: 10px;
              color: rgb(147, 153, 159);
            }
.content .text{
            margin-bottom: 8px;
            line-height: 18px;
            color: rgb(7, 17, 27);
            font-size: 12px;
        }
.content .recommend{
            line-height: 16px;
            font-size: 0;
        }
 .recommend .icon-thumb_up,.item{
              display: inline-block;
              margin: 0 4px 4px 0;
              font-size: 9px;
            }
.recommend .icon-thumb_up{
              color: rgb(0, 160, 220);
            }
.recommend .item{
              padding: 0 2px;
              border: 1px solid rgba(7, 17, 27, 0.1);
              border-radius: 1px;
              color: rgb(147, 153, 159);
              background: #fff;
              vertical-align: left;
            }
    
.content .time{
            position: absolute;
            top: 0;
            right: 0;
            line-height: 12px;
            font-size: 10px;
            color: rgb(147, 153, 159);
        }
</style>