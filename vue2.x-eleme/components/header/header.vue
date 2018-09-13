<template>
    <div class=header>
         <div class="content-wrapper">
             <div class="avatar">
                <img  :src="getSeller.avatar">
             </div>
             <div class="content">
                 <div class="title">
                     <span class="brand"></span>
                     <span class="name">{{getSeller.name}}</span>
                 </div>
                 <div class="description">
                     {{getSeller.description}}/{{getSeller.deliveryTime}}分钟送达
                 </div>
                 <div v-if="getSeller.supports" class="support">
                     <span class="icon" :class="classMap[getSeller.supports[0].type]"></span>
                     <span class="text">{{getSeller.supports[0].description}}</span>
                 </div>
             </div>
             <div v-if="getSeller.supports" class="support-count"  @click="showDetail">
                 <span class="count">{{getSeller.supports.length}}个</span>
                 <i class="icon-keyboard_arrow_right"></i>
             </div>
         </div>

         <div class="bulletin-wrapper"  @click="showDetail">
             <span class="bulletin-title bulletin"></span><span
              class="bulletin-text">{{getSeller.bulletin}}</span>
             <i class="icon-keyboard_arrow_right"></i>
         </div>

         <div class="background">
             <img :src="getSeller.avatar" width="100%" height="100%"/>
         </div>
         <transition name="fade">
         <div v-show="detailShow" class="detail" >
            <div class="detail-wrapper clearfix">
              <div class="detail-main">
                 <h1 class="name">{{getSeller.name}}</h1>
                 <div class="star-wrapper">
                    <star :size="48" :score="getSeller.score"></star>
                 </div>
                 <div class="title">
                        <div class="line"></div>
                        <div class="text">优惠信息</div>
                        <div class="line"></div>
                 </div>
                 <ul v-if="getSeller.supports" class="supports">
                        <li class="support-item" v-for="(item,index) in getSeller.supports">
                          <span class="icon" :class="classMap[getSeller.supports[index].type]"></span>
                          <span class="text">{{getSeller.supports[index].description}}</span>
                        </li>
                </ul>
                <div class="title">
                    <div class="line"></div>
                    <div class="text">商家公告</div>
                    <div class="line"></div>
                </div>
                <div class="bulletin">
                    <p class="content">{{getSeller.bulletin}}</p>
                </div>
              </div>
            </div>
            <div class="detail-close" @click="hideDetail">
              <i class="icon-close"></i>
            </div>
          </div>
        </transition>   
    </div>
 </template>
    
<script>
    import star from '../star/star.vue';
export default {
    props:{
        seller:Object
    },
    components: {
        star
    },
    data(){ 
         return {
         detailShow:false
            }
    },
    created(){
        this.classMap=['decrease','discount','special','invoice','guarantee'];
    },
    computed: {
        getSeller(){
             return this.seller;
        }
    },
    methods:{
        showDetail(){
            this.detailShow=true;
        },
        hideDetail() {
        this.detailShow = false;
      }
    }
        
    
}
</script>
    
<style scoped>
    .fade-enter-active,.fade-leave-active {
  transition: all 1s;
  opacity: 1;
  background: rgba(7, 17, 27, 0.8);
}

.fade-enter,.fade-leave-to {
  opacity: 0;
  background: rgba(7, 17, 27, 0);
}
 
     .detail .detail-close {
       position: relative;
       width: 32px;
       height: 32px;
       margin: -64px auto 0 auto;
       clear:both;
       font-size: 32px;
   }
    .detail-main .bulletin{
            width: 80%;
            margin: 0 auto;
        }
    .bulletin .content {
        
              padding: 0 10px;
              line-height: 24px;
              font-size: 12px;

    }
    .support-item .text {
            line-height: 16px;
            font-size: 12px;
        }
    .support-item .icon{
            display: inline-block;
            width: 16px;
            height: 16px;
            vertical-align: top;
            margin-right: 6px;
            background-size: 16px 16px;
            background-repeat: no-repeat;
            }
    .detail-main  .supports{
            width: 80%;
            margin: 0 auto;
        }
    .supports .support-item{
              padding: 0 10px;
              margin-bottom: 12px;
              font-size: 0;
            }
.supports .support-item:last-child {
                margin-bottom: 0;
            }
    .title .line{
              flex: 1;
              position: relative;
              top: -6px;
              border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            }
    .title .text {
              padding: 0 12px;
              font-weight: 700;
              font-size: 14px;
            }

    .detail-main .title {
        
            display: flex;
            width: 80%;
            margin: 28px auto 24px auto;
    }
    .detail-main .star-wrapper {
        margin-top: 18px;
        padding: 2px 0;
         text-align: center;
    }
    .detail-main .name {
        line-height: 16px;
        text-align: center;
        font-size: 16px;
        font-weight: 700;
    }
    .header {
        position: relative;
        color:white;
        background:rgba(7, 17, 27, 0.5);
        overflow: hidden;
    }
    .content-wrapper {
        position: relative;
        padding:24px 12px 18px 24px;
        font-size: 0;
    }

    .content-wrapper .avatar {
        display: inline-block;
        vertical-align: top;
    }
    .content-wrapper .content {
        display: inline-block;
        margin-left:16px;
    }
   .content .title {
        margin:2px 0 8px 0;

    }
    .content .description {
        margin-bottom: 10px;
        font-size: 12px;
        line-height: 12px;
    }
    .content .brand {
        display: inline-block;
        vertical-align: top;
        width:30px;
        height: 18px;
        background-size:30px 18px;
        background-repeat: no-repeat;
    }
    .content .name {
        margin-left:6px;
        font-size: 16px;
        line-height: 18px;
        font-weight: bold;
    }
    .avatar img {
        width:64px;
        height:64px;
        border-radius: 2px;
    }
    .support .icon {
        display: inline-block;
        vertical-align: top;
        width: 12px;
        height: 12px;
        margin-right: 4px;
        background-size:12px 12px;
        background-repeat: no-repeat;
    }
    .support .text {
        font-size: 10px;
        line-height: 12px;
    }
    .support-count {
        position: absolute;
        right:12px;
        bottom:16px;
        padding: 0 8px;
        height:24px;
        line-height: 24px;
        border-radius: 14px;
        background:rgba(0, 0, 0, 0.2);
        text-align: center;

    }
    .support-count .count {
        font-size: 10px;
        vertical-align: top;
    }
    .icon-keyboard_arrow_right {
        font-size: 10px;
        margin-left:2px;
        line-height: 24px;
    }

     .bulletin-wrapper {
        position: relative;
        height: 28px;
        line-height: 28px;
        padding: 0 22px 0 12px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        background:rgba(7, 17, 27, 0.2);
    }
    .bulletin-title {
        vertical-align: top;
        margin-top:8px;
        display: inline-block;
        width:22px;
        height: 12px;
        background-size: 22px 12px;
        background-repeat: no-repeat;
    }
    .bulletin-text {
        vertical-align: top;
        font-size: 10px;
        margin: 0 4px;
        
    }
    .bulletin-wrapper .icon-keyboard_arrow_right {
        position: absolute;
        line-height: 28px;
        font-size: 10px;
        right:12px;
    }
   .header .background {
        position: absolute;
        top:0;
        left:0;
        width: 100%;
        height: 100%;
        z-index: -1;
        filter: blur(10px);
    }
    .header .detail {
        position:fixed;
        z-index: 100;
        top:0;
        left:0;
        width:100%;
        height: 100%;
        overflow: auto;
        backdrop-filter: blur(10px);
        background: rgba(7,17,27,0.8);
    }
    .detail .detail-wrapper {
        min-height: 100%;
        width: 100%;
    }
    .detail-wrapper .detail-main {
        margin-top: 64px;
        padding: 64px 32px 100px 32px;
    }
  
</style>