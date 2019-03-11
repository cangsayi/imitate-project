var h = 10146, m = 39, sec =28, i=true;
var hour = document.getElementById("hour");
var min = document.getElementById("min");
var second = document.getElementById("second");
 var lis =$('nav li');

$(document).ready(

 function(){
	
	console.log(lis.eq(0));
$(window).scroll(function(){
	var scrY = $(window).scrollTop();
	        
	    if(scrY> 99)                                    //固定导航栏
	    {
	      $('nav').addClass("fixed");
		
	    }else{
	      $('nav').removeClass("fixed");
	    }
	    if(scrY >150){
	      $('nav').addClass("awake");
	    }else {
	      $('nav').removeClass("awake");
	    }
	
	    if(scrY >= 700){   
	       lis.eq(0).removeClass("active");                       //导航到小项的地方添加active类高亮显示;
	       lis.eq(1).addClass("active");
	    }else {
	       lis.eq(1).removeClass("active");
	      lis.eq(0).addClass("active");
	    }
	    if(scrY >=2190){
	       lis.eq(1).removeClass("active");
	       lis.eq(2).addClass("active");
	    } else {
	       lis.eq(2).removeClass("active");
	    }
	    if(scrY >=3390){
	       lis.eq(2).removeClass("active");
	       lis.eq(3).addClass("active");
	    }else{
	       lis.eq(3).removeClass("active");
	    }
	    if(scrY >=6860){
	       lis.eq(3).removeClass("active");
	       lis.eq(4).addClass("active");
	    }else {
	       lis.eq(4).removeClass("active");
	    }
	    if(scrY >=9290){
	       lis.eq(4).removeClass("active");
	       lis.eq(5).addClass("active");
	    }else {
	       lis.eq(5).removeClass("active");
	    }
	
	   if(scrY >=8100){
	       if(i == true){
	           i=false;
	           time = setInterval(function(){
	            h+=500;
	            m+=25;
	            sec+=2;
	              hour.innerHTML = h;
	              min.innerHTML = m;
	              second.innerHTML = sec;
	  
	          if(h >=34146){
	              clearInterval(time);
	          }
	           },100);
	       }
	   }
	    
	   // console.log(scrY);
	}
);
});
 


var $list = $(".all-content");
var $right = $("#right");
var timer;
var l=0;	
	
	function slideLeft(){						//动画实现函数；
		 l++;
        if(!$list.is(":animated")){
			if(l==5){
				    $list.animate({left:0,});
					l=1;
			  }
            $list.stop(true,true).animate({left:'-='+360},"normal");
              
            }
    }
    
    
	
	
$(function(){										//可以衔接的轮播图，难点是一个周期之后，衔接的处理。
									
	
    $right.click(function(){				//点击触发;
       slideLeft();
    });
   
 
 
    /*
 
timer=setInterval(function(){                       //load事件默认;  
		slideLeft();
	},3000);
	$(".animation").mouseenter(function(){		//进入时清除默认和事件的定时器;
			clearInterval(timer);
	}).mouseleave(function(){
		timer = setInterval(function(){				//离开时，执行定时器动画；
		slideLeft();
	},3000);
	});         */    


});