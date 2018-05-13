/* function addload(func){
	var oldonload=window.onload;
	if(typeof window.onload!='function')
	  {
		window.onload=func;
	  }
	  else{
		window.onload=function(){
			oldonload();
			func();
		}
		
	  }
}
addload(add1);    */

//第一个滑动；
$(function(){
	var page=1;
	
	
	$("div#right").click(function(){
		var $content = $(this).parents("section#slider");
		var $show = $content.find("ul#begin");
		var v_width=$content.width();
		var len = $show.find("li").length;
		var page_count=len;
		if(!$show.is(":animated")){
			if(page==page_count){
				$show.animate({left:'0px'},"normal");
				page=1;
			}else{
				$show.animate({left:'-='+v_width}, "normal");
				page++;
			}

		
		}


});

$("div#left").click(function(){
	var $content = $(this).parents("section#slider");
	var $show = $content.find("ul#begin");
	var v_width=$content.width();
	var len = $show.find("li").length;
	var page_count=len;
	if(!$show.is(":animated")){
		if(page==1){
			$show.animate({left:'-='+v_width*(page_count-1)},"normal");
			page=page_count;
		}else{
			$show.animate({left:'+='+v_width}, "normal");
			page--;
		}

	
	}

});

});


//最后的滑动；
$(function(){
	var page=1;
	var i=1;
	
	$("div#prev1").click(function(){
		var $content = $("div#human_content");
		var $show = $("div#human_list");
		var v_width="1120px";
		var len = $show.find("li").length;
		var page_count=len;
		if(!$show.is(":animated")){
			if(page==1){
				$show.animate({left:'-='+v_width},"normal");
				page++;
			}else{
				$show.animate({left:'+='+v_width}, "normal");
				page--;
			}

		
		}


});

$("div#next1").click(function(){
	var $content = $("div#human_content");
	var $show = $("div#human_list");
	var v_width="1120px";
	var len = $show.find("img").length;
	var page_count=len/2;
	if(!$show.is(":animated")){
		if(page==page_count){
			$show.animate({left:'+='+v_width},"normal");
			page--;
		}else{
			$show.animate({left:'-='+v_width}, "normal");
			page++;
		}

	
	}

});
});


//中间的滑动；
$(function(){
	var page=2;
	var i=1;
	
	$("div#next").click(function(){
		var $content = $(this).parents("div#pic_content");
		var $show = $content.find("div#show");
		var v_width="602px";
		var len = $show.find("img").length;
		var page_count=len;
		if(!$show.is(":animated")){
			if(page==page_count){
				$show.animate({left:'+=602px'},"normal");
				page=2;
			}else{
				$show.animate({left:'-='+v_width}, "normal");
				page++;
			}

		
		}


});

$("div#middle").click(function(){
	var $content = $(this).parents("div#pic_content");
	var $show = $content.find("div#show");
	var v_width="602px";
	var len = $show.find("img").length;
	var page_count=len;
	if(!$show.is(":animated")){
		if(page==page_count){
			$show.animate({left:'+=602px'},"normal");
		
			page=2;
		}else{
			$show.animate({left:'-='+v_width}, "normal");
			page++;
		}

	
	}


});

$("div#prev").click(function(){
	var $content = $(this).parents("div#pic_content");
	var $show = $content.find("div#show");
	var v_width="602px";
	var len = $show.find("img").length;
	var page_count=len;
	if(!$show.is(":animated")){
		if(page==1){
			$show.animate({left:'-=602px'},"normal");
			page=2;
		}else{
			$show.animate({left:'+='+v_width}, "normal");
			page--;
		}

	
	}

});


$("div#next1").click(function(){
	var $content = $("div#human_content");
	var $show = $content.find("div#human_list");
	var v_width="1120px";
	var len = $show.find("img").length;
	var page_count=len/2;
	if(!$show.is(":animated")){
		if(i==page_count){
			$show.animate({left:'+=1120px'},"normal");
			i=1;
		}else{
			$show.animate({left:'-='+v_width}, "normal");
			i++;
		}

	
	}


});



});




//当滚动的时候，固定导航栏；
$(function(){

	var nav=$("#header"); //得到导航对象
	
	var win=$(window); //得到窗口对象
	
	var sc=$(document);//得到document文档对象。
	
	win.scroll(function(){
	
	  if(sc.scrollTop()>=63){
		// alert("niaho");
	
		nav.addClass("fixednav"); 
		nav.removeClass("header2"); 
		
	
	  }else{
	
	   nav.removeClass("fixednav");
	   nav.addClass("header2"); 
	
	 
	  }
	
	});
});  







