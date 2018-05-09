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

$(function(){
	var page=1;
	var i=1;
	
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
			$show.animate({left:'-='+v_width*(page_count-2)},"normal");
			page=2;
		}else{
			$show.animate({left:'+='+v_width}, "normal");
			page--;
		}

	
	}

});

});


$(function(){

	var nav=$("#header2"); //得到导航对象
	
	var win=$(window); //得到窗口对象
	
	var sc=$(document);//得到document文档对象。
	
	win.scroll(function(){
	
	  if(sc.scrollTop()>=30){
		 // alert("niaho");
	
		nav.addClass("fixednav"); 
	
	  }else{
	
	   nav.removeClass("fixednav");
	
	 
	  }
	
	});
});  







