 var $list = $(".list");
 var $right = $("#right");
 var timer;
 var l=0;
	
	function slideLeft(){						//动画实现函数；
		 l++;
        if(!$list.is(":animated")){
			if(l==6){
				    $list.animate({left:0,},"fast");
					l=1;
			  }
            $list.stop(true,true).animate({left:'-='+400},"normal");
              
            }
	}
	
$(function(){

timer=setInterval(function(){
		slideLeft();
	},3000);									//load事件默认;
	
    $right.click(function(){				//点击触发;
       slideLeft();
    });
	
	$(".animation").mouseenter(function(){		//进入时清除默认和事件的定时器;
			clearInterval(timer);
	}).mouseleave(function(){
		timer = setInterval(function(){				//离开时，执行定时器动画；
		slideLeft();
	},3000);
	});
	

});

