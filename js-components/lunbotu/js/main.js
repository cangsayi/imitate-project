 var $list = $(".list");
 var $right = $("#right");
 var $button  = $("#button");
 var $test1 = $(".test1");
  var $test2 = $(".test2"); 
  var $test3 = $(".test3");
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
	
$(function(){										//可以衔接的轮播图，难点是一个周期之后，衔接的处理。

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

/*
$( function(){											//长宽改变的轮播图,方法一
	var i=0;
	$button.click(function(){							//方法一：缺点是代码量跟图片数量成正比，
													
		i++;
		  if(!$test1.is(":animated") && !$test2.is(":animated") && !$test3.is(":animated")){
			  if(i%3==1){
		$test2.css({zIndex:2}).animate({left:250,width:400,height:200,top:80},400);
		$test3.css({zIndex:1}).animate({left:0,width:300,height:150,top:25,},400);
		$test1.css({zIndex:0}).animate({left:600},400);
		}
		if(i%3==2){
		$test2.css({zIndex:1}).animate({left:0,width:300,height:150,top:25,},400);
		$test3.css({zIndex:0}).animate({left:600},400);
		$test1.css({zIndex:2}).animate({left:250,width:400,height:200,top:80},400);
		}
		if(i%3==0){
		$test2.css({zIndex:0}).animate({left:600},400);
		$test3.css({zIndex:2}).animate({left:250,width:400,height:200,top:80},400);
		$test1.css({zIndex:1}).animate({left:0,width:300,height:150,top:25,},400);
		}
		  }
		
		
	});       
	
}
);

 */



$( function(){											//长宽改变的轮播图,方法二
	$button.click(function(){						
		var $test1 = $(".test1");
		var $test2 = $(".test2"); 
		var $test3 = $(".test3");					//方法二：缺点需要每次点击都要获取DOM节点，对性能有影响；
													//优点是：代码量小；
		  if(!$test1.is(":animated") && !$test2.is(":animated") && !$test3.is(":animated")){
			
		$test2.css({zIndex:2}).animate({left:250,width:400,height:200,top:80},400,function(){
			$(this).removeClass("test2").addClass("test3");
		});
		$test3.css({zIndex:1}).animate({left:0,width:300,height:150,top:25,},400,function(){
			$(this).removeClass("test3").addClass("test1");
		});
		$test1.css({zIndex:0}).animate({left:600},400,function(){
			$(this).removeClass("test1").addClass("test2");
		});
		}
		
		  });
		
		
	});
	
