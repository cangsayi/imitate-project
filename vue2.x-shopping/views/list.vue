<template>
    <div class="list" v-show="list.length">
        <div class="list-header">

            <div class="brand">
            <span>品牌:</span>
            <span
            class="list-control-filter-item"
            :class="{on: item === filterBrand}"
            v-for="item in brands"
            @click="handleFilterBrand(item)">{{ item }}</span>
            </div>

            <div class="color">
            <span> 颜色:</span>
            <span 
            class="list-control-filter-item"
            v-for="item in colors" 
            :class="{on: item ===filterColor}"
            @click="handleFilterColor(item)">{{item}}</span>   
            </div>

            <div class="sort">
             <span>排序:</span>   
             <span
             class="list-control-order-item"
             :class="{on: order === ''}"
             @click="handleOrderDefault">默认</span>
             <span
             class="list-control-order-item"
             :class="{on: order === 'sales'}"
             @click="handleOrderSales">
             销量
             <template v-if="order === 'sales'">↓</template>
             </span>
                <span
                    class="list-control-order-item"
                    :class="{on: order.indexOf('cost') > -1}"
                    @click="handleOrderCost">
                    价格
                    <template v-if="order === 'cost-asc'">↑</template>
                    <template v-if="order === 'cost-desc'">↓</template>
                </span>
             
            </div>
        </div>
        <div class="list-content">
            <Product v-for="item in filterProductList" :info="item" :key="item.id"></Product>
            <div class="product-not-found" v-show="!filterProductList.length">暂无相关商品</div>
        </div>
       

    </div>
</template>
    
<script>
    import Product from '../components/product.vue';
    export default {
        components: { Product},
        data(){
            return {
                filterBrand: '',
                filterColor: '',
                order: ''
            
            }
        },
        computed: {
            list(){
                return this.$store.state.productList;
            },
            brands(){
                return this.$store.getters.brands;
            },
            colors(){
                return this.$store.getters.colors;
            },
            filterProductList(){
                let list = [...this.list];
                if(this.filterBrand!==''){
                    list = list.filter(item => item.brand===this.filterBrand);
                }
                if(this.filterColor!==''){
                    list = list.filter(item => item.color===this.filterColor);
                }
                if(this.order!==''){
                    if(this.order==='sales'){
                        list.sort((a,b) =>b.sales - a.sales);
                    }else if(this.order==='cost-desc'){
                        list.sort((a,b) => b.cost - a.cost);
                        
                    }else if(this.order==='cost-asc'){
                        list.sort((a,b) => a.cost - b.cost);
                    }
                }
                return list;
            }
        },
        methods:{
            handleFilterBrand(item){
                if(this.filterBrand === item){
                this.filterBrand='';
                } else {
                    this.filterBrand = item;
                    }
            },
            handleFilterColor (color) {
                if (this.filterColor === color) {
                    this.filterColor = '';
                } else {
                    this.filterColor = color;
                }
            },
            handleOrderDefault(){
                this.order='';
            },
            handleOrderSales(){
                this.order='sales';
            },
            handleOrderCost(){
                if(this.order==='cost-desc'){
                    this.order='cost-asc';
                }else{
                    this.order='cost-desc';
                }
            }

        },
        mounted(){
            this.$store.dispatch('getProductList');
        }

    }
    
</script>
    
<style scoped>
    .list {
     border-radius: 5px; 
      margin:10px;
    
    }
    .list-header {
       
        height:120px;
        padding: 10px;
        background:white;
        padding:20px 4px;
        border-radius: 6px;
        margin-bottom:15px;
    }
    .list-content {
     
        margin-top:10px;
        background-color:white;
    

    }
    .list-control-filter-item,.list-control-order-item {
      border-radius: 4px;
      border:1px solid #e9eaec;
      cursor: pointer;
       margin:2px 5px;
       display: inline-block;
   }
   .brand,.color,.sort {
       margin-left:10px;
       margin-bottom:20px;
   }
   .list-control-filter-item.on,
    .list-control-order-item.on{
        background: #f2352e;
        border: 1px solid #f2352e;
        color: #fff;
    }
    .product-not-found {
        text-align: center;
        margin-top:20px;
        height:100px;
        width:100%;
        line-height: 100px;
    }
</style>
    