webpackJsonp([2],{103:function(t,s,o){t.exports={render:function(){var t=this,s=t.$createElement,o=t._self._c||s;return o("div",{staticClass:"cart"},[t._m(0),t._v(" "),o("div",{staticClass:"cart-content"},[t._l(t.cartList,function(s,e){return o("div",{staticClass:"cart-content-main"},[o("div",{staticClass:"cart-info"},[o("img",{attrs:{src:t.productDictList[s.id].image}}),t._v(" "),o("span",[t._v(t._s(t.productDictList[s.id].name))])]),t._v(" "),o("div",{staticClass:"cart-price"},[t._v("¥ "+t._s(t.productDictList[s.id].cost))]),t._v(" "),o("div",{staticClass:"cart-count"},[o("span",{staticClass:"cart-control-minus",on:{click:function(s){t.handleCount(e,-1)}}},[t._v("-")]),t._v("\n                "+t._s(s.count)+"\n                "),o("span",{staticClass:"cart-control-add",on:{click:function(s){t.handleCount(e,1)}}},[t._v("+")])]),t._v(" "),o("div",{staticClass:"cart-cost"},[t._v("¥ "+t._s(t.productDictList[s.id].cost*s.count))]),t._v(" "),o("div",{staticClass:"cart-delete"},[o("span",{staticClass:"cart-control-delete",on:{click:function(s){t.handleDelete(e)}}},[t._v("删除")])])])}),t._v(" "),t.cartList.length?t._e():o("div",{staticClass:"cart-empty"},[t._v("购物车为空")])],2),t._v(" "),o("div",{directives:[{name:"show",rawName:"v-show",value:t.cartList.length,expression:"cartList.length"}],staticClass:"cart-promotion"},[o("span",[t._v("使用优惠码：")]),t._v(" "),o("input",{directives:[{name:"model",rawName:"v-model",value:t.promotionCode,expression:"promotionCode"}],attrs:{type:"text"},domProps:{value:t.promotionCode},on:{input:function(s){s.target.composing||(t.promotionCode=s.target.value)}}}),t._v(" "),o("span",{staticClass:"cart-control-promotion",on:{click:t.handleCheckCode}},[t._v("验证")])]),t._v(" "),o("div",{directives:[{name:"show",rawName:"v-show",value:t.cartList.length,expression:"cartList.length"}],staticClass:"cart-footer"},[o("div",{staticClass:"cart-footer-desc"},[t._v("\n            共计 "),o("span",[t._v(t._s(t.countAll))]),t._v(" 件商品\n        ")]),t._v(" "),o("div",{staticClass:"cart-footer-desc"},[t._v("\n            应付总额 "),o("span",[t._v("¥ "+t._s(t.costAll-t.promotion))]),t._v(" "),o("br"),t._v(" "),t.promotion?[t._v("\n                （优惠 "),o("span",[t._v("¥ "+t._s(t.promotion))]),t._v("）\n            ")]:t._e()],2),t._v(" "),o("div",{staticClass:"cart-footer-desc"},[o("div",{staticClass:"cart-control-order",on:{click:t.handleOrder}},[t._v("现在结算")])])])])},staticRenderFns:[function(){var t=this,s=t.$createElement,o=t._self._c||s;return o("div",{staticClass:"cart-header"},[o("div",{staticClass:"cart-header-title"},[t._v("购物清单")]),t._v(" "),o("div",{staticClass:"cart-header-main"},[o("div",{staticClass:"cart-info"},[t._v("商品信息")]),t._v(" "),o("div",{staticClass:"cart-price"},[t._v("单价")]),t._v(" "),o("div",{staticClass:"cart-count"},[t._v("数量")]),t._v(" "),o("div",{staticClass:"cart-cost"},[t._v("小计")]),t._v(" "),o("div",{staticClass:"cart-delete"},[t._v("删除")])])])}]},t.exports.render._withStripped=!0},86:function(t,s,o){o(98);var e=o(44)(o(90),o(103),"data-v-060499ec",null);e.options.__file="D:\\code-angular\\vue-project\\vue-book-master\\shopping\\views\\cart.vue",e.esModule&&Object.keys(e.esModule).some(function(t){return"default"!==t&&"__esModule"!==t})&&console.error("named exports are not supported in *.vue files."),e.options.functional&&console.error("[vue-loader] cart.vue: functional components are not supported with templates, they should use render functions."),t.exports=e.exports},90:function(t,s,o){"use strict";Object.defineProperty(s,"__esModule",{value:!0});var e=o(23),i=function(t){return t&&t.__esModule?t:{default:t}}(e);s.default={computed:{cartList:function(){return this.$store.state.cartList},productDictList:function(){var t={};return this.productList.forEach(function(s){t[s.id]=s}),t},countAll:function(){var t=0;return this.cartList.forEach(function(s){t+=s.count}),t},costAll:function(){var t=this,s=0;return this.cartList.forEach(function(o){s+=t.productDictList[o.id].cost*o.count}),s}},data:function(){return{productList:i.default,promotionCode:"",promotion:0}},methods:{handleCount:function(t,s){s<0&&1===this.cartList[t].count||this.$store.commit("editCartCount",{id:this.cartList[t].id,count:s})},handleDelete:function(t){this.$store.commit("deleteCart",this.cartList[t].id)},handleCheckCode:function(){if(""===this.promotionCode)return void window.alert("请输入优惠码");"Vue.js"!==this.promotionCode?window.alert("优惠码验证失败"):this.promotion=500},handleOrder:function(){this.$store.dispatch("buy").then(function(){window.alert("购买成功")})}}}},98:function(t,s){}});