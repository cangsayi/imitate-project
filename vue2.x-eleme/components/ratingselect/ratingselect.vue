<template>
    <div class="ratingselect">
        <div class="rating-type border-1px">
            <span @click="selects(2,$event)"class="block positive" :class="{'active': select===2}">{{desc.all}}<span class="count">{{ratings.length}}</span></span>
            <span @click="selects(0,$event)"class="block positive" :class="{'active': select===0}">{{desc.positive}}<span class="count">{{positives.length}}</span></span>
            <span @click="selects(1,$event)"class="block negative" :class="{'active': select===1}">{{desc.negative}}<span class="count">{{regatives.length}}</span></span>
        </div>
        <div class="switch" :class="{'on':onlyContent}" @click="toggleContent">
            <span class="icon-check_circle" ></span>
            <span class="text">只看有内容的评价</span>
        </div>
    </div>
</template>

<script>
    const POSITIVE = 0;
    const NEGATIVE = 1;
    const ALL = 2;
export default {
    props:{
        ratings:{
            type:Array,
            default(){
                return [];
            }
        },
        select:{
            type:Number,
            default:ALL
        },
        onlyContent:{
            type:Boolean,
            defulat:false
        },
        desc:{
            type:Object,
            default(){
                return {
                    all:'全部',
                    positive:'满意',
                    negative:'不满意'
                }
            }
        }
    },
    data(){
        return{
            selected:this.select,
            onlyContented:this.onlyContent
        }
    },
    computed:{
      
        positives(){
            return this.ratings.filter((rating) =>{
                return rating.rateType===POSITIVE;
            });
        },
        regatives(){
            return this.ratings.filter((rating)=>{
                return rating.rateType===NEGATIVE;
            })
        }
    },
    methods:{
        selects(type,event){
            if(!event._constructed)return;
            this.selected=type;
            this.$emit('type',type);
        },
        toggleContent(){
            if(!event._constructed)return;
            this.onlyContented =!this.onlyContented;
            this.$emit('tog',this.onlyContented);
        }
    }


}
</script>

<style scoped>
.ratingselect .rating-type {
    position: relative;
    padding: 18px 0;
    margin: 0 18px;
    font-size: 0;
}
.rating-type .block {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 1px;
    margin-right: 8px;
    color:rgb(77,85,93);
    font-size: 12px;

}
.block.positive {
    background:rgba(0,160,220,0.2);

}
.block.active {
    color:white;
}
.positive.active {
    background:rgb(0,160,220);
}
.block.negative {
    background:rgba(77,85,93,0.2);
}
.negative.active {
    background:rgb(0,160,220);
}

.block .count {
    font-size: 8px;
    margin-left:2px;
    line-height: 16px;
}
.ratingselect .switch {
    padding: 12px 18px;
    line-height: 24px;
    border-bottom: 1px solid rgba(7,17,27,0.1);
    font-size: 0;
}
.switch.on .icon-check_circle {
    color:#00c850;
}
.switch .icon-check_circle {
    font-size: 24px;
    margin-right: 4px;
    display: inline-block;
    vertical-align: top;
}
.switch .text {
    font-size: 14px;
    display: inline-block;
    vertical-align: top;
}
</style>