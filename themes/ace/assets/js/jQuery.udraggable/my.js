var position='';
$(document).ready(function(){

//每次页面加载的时候，就让左边可以拖动
//有个神奇的问题：直接写没反应，要用setTimeout来执行这个事件	
	//setTimeout(dragevent,10);
	function dragevent(){
	$('#dragleft ul ul li.block').udraggable({
 		containment: 'parent',
    });
	}
	dragevent();
	
//手风琴效果
//应该是顺序问题导致的错误，所以延迟10ms发生就正常了
	//setTimeout(yincang,10);//加入延迟，不然很奇怪，不知道为啥位置都变成0px,0px？被挤跑？而且这个鬼东西还要放在最下面才有效果
	function yincang(){$("#dragleft .submenu").hide();	}
/******甲板位置设置时无需进行如下代码********/
	$("#dragleft .mainmenu >li").click(function(){
		//alert(1);
		$(this).next(".submenu").slideToggle();		
		$(this).next(".submenu").siblings(".submenu").slideUp();
		//siblings查找每个 p 元素的所有类名为 "selected" 的所有同胞元素：
		//$(this).next(".submenu").slideToggle().siblings(".submenu").slideUp();}
		})
		yincang();
//(前面两个函数：手风琴效果和拖动效果位置不能倒放，否则会出现由于延迟发生函数导致的某些效果不起作用)


//图片默认拖动时候，会自动生成一个展示图片的页面，阻止浏览器的默认操作，貌似只能在mousedown。也可以考虑用延迟来让默认操作完成再发生
	$(document).on('mousedown',"img",function (e) { e.preventDefault(); }, false);


	var ularr=[];//创建一个数组来存放ul的id  ul1  ul2  ul3
	var liarr=[];//存储li的id  ul1li1  ul1li2  ul1li3

	//判断当前有多少个ul，每个ul下面有多少个li
	var onulSize=$("#dragleft ul ul").size();
	var onliSize=$("#dragleft ul ul li").size();
		
	for(var i=0;i<onulSize;i++){
		ularr[i]=$("#dragleft ul ul").eq(i).attr("id");			
		//alert(ularr[i]);
		$("#"+ularr[i]).html(localStorage.getItem(ularr[i]));
		localStorage.setItem(ularr[i],$("#"+ularr[i]).html());//ul1,<li id="ul2li1">2-1</li>		
	}

//点击保存按钮。把目前存在的li保存起来，在加载的时候输入
//另外将每个li的位置也输出来
	$("body").on("click","#save",function(){
		var ulSize=$("#dragleft ul ul").size();
		var liSize=$("#dragleft ul ul li").size();
		for(var i=0;i<ulSize;i++){
			ularr[i]=$("#dragleft ul ul").eq(i).attr("id");			
			//alert(ularr[i]);
			//alert($("#"+ularr[i]).html());
			localStorage.setItem(ularr[i],$("#"+ularr[i]).html());//ul1,<li id="ul2li1">2-1</li>		
		}	
		for(var j=0;j<liSize;j++){
			liarr[j]=$("#dragleft ul ul li").eq(j).attr("id");	
		}
		
		var ularr1=[];//创建一个数组来存放ul的id  ul1  ul2  ul3，为避免变量重复，在后面加1
		var liarr1=[];//存储li的id  ul1li1  ul1li2  ul1li3

		//判断当前有多少个ul，每个ul下面有多少个li
		var ulSize1=$("#dragleft ul ul").size();
		var liSizeul=[];
		for(var k=0;k<ulSize1;k++){
		liSizeul[k]=$("#dragleft ul #ul"+(k+1)+" li").size();//用于存放当前第k个ul中的li个数
		}	

		for(var i=1;i<=ulSize1;i++){
		//目前有三个ul，所以会执行6次
			for(var j=1;j<=liSizeul[i-1];j++){
				//每个li中有几个图，就执行几次
				var ulliid=$("#ul"+i+"li"+j);
				var csstop = ulliid.css("top");
				var cssleft = ulliid.css("left");
				csstop =  parseInt(csstop.slice(0,-2));
				cssleft =  parseInt(cssleft.slice(0,-2));
				var bb="#ul"+i+"li"+j;
				var l_id = ulliid.find("div").attr("l_id");
				position += bb+"-"+l_id+"-"+cssleft+"-"+csstop+';';
				}	
		}
	//alert(position);	
	})

//控制动态生成的拖动事件可以移动
	$("#dragleft").on("mousedown",'li.block',function(e){
		$('li.block').udraggable({
 			containment: 'parent',
    	});	
//这个地方要小心，当设置weposition:absolute而上层元素没有设置成relative的时候，会默认body为parent
	})
	
//这个地方有多少层就要写多少个，否则会出现部分没有增加id，后续获取不到位置值
//拖动后在哪个ul放，则添加进哪个ul,同时增加唯一标识		
//鼠标点击后移除，用于判断在哪个ul移除，则将文字添加进哪个ul中，同时增加唯一标识id
	$("body").on("mouseup","#dragleft ul ul",function(e){
		if($(".clone").length>0){//表示有复制东西
			var index=$(this).index();//判断当前是第几个，1,3,5
			index=Math.ceil(index/2);
			$("#dragleft ul").eq(index).append($(".clone"));//clone样式为了让移动复制的块突出，表示在那个位置添加这个样式的元素
			
			var childrenSize=$("#dragleft ul").eq(index).children().size();
			if(index==1){$(".clone").attr({"id":"ul6li"+childrenSize});
			}
			else
			if(index==2){$(".clone").attr({"id":"ul5li"+childrenSize});//alert(2);
			}
			else
			if(index==3){$(".clone").attr({"id":"ul4li"+childrenSize});//alert(3);	
			}	
			else
			if(index==4){$(".clone").attr({"id":"ul3li"+childrenSize});//alert(3);	
			}	
			else
			if(index==5){$(".clone").attr({"id":"ul2li"+childrenSize});//alert(3);	
			}			
			else
			if(index==6){$(".clone").attr({"id":"ul1li"+childrenSize});//alert(3);	
			}	
			//因为位置是取鼠标，而位置是相对父亲，所以需要减去他的父亲距离浏览器左上角和右上角的距离
			var ot=$(".clone").parent().offset().top;
			var ol=$(".clone").parent().offset().left;
			
			var st=$(document).scrollTop();
			//alert(st+130);
			//alert(st);
			if(((e.clientX+1-ol+50)>1200)&&((e.clientY+1-ot+50)>200-st)){
			$(".clone").css('top',"150px");//"130"是不行的，要么就130 要么就"130x"
			$(".clone").css('left',"1150px");	
			}			
			
			else if((e.clientX+1-ol+50)>1200){
			$(".clone").css('left',"1150px");
			$(".clone").css('top',e.clientY+1-ot+st);
			}
			else if((e.clientY+1-ot+50)>200-st){
				$(".clone").css('top',150);		//200	
				$(".clone").css('left',e.clientX+1-ol);
			}
			else{
				$(".clone").css('left',e.clientX+1-ol);
				$(".clone").css('top',e.clientY+1-ot+st);								
			}			
			$(".clone").removeClass("clone");//把当前的clone样式清空
}

//刚移动过来的时候没有促发移动事件，要拖动的时候需要点击或者是拖一下让鼠标的焦点在左边才能拖动,所以在拖动过来之后顺便促发
//alert(1);
//alert('#dragleft ul #ul'+index+' li.block');
	$('#dragleft ul #ul'+index+' li.block').udraggable({
 		containment: 'parent',
    });	
})		

//鼠标按下拖动手柄h3时，鼠标变为移动标志，复制元素，复制元素的位置随着鼠标移动
	$("body").on("mousedown","#dragright ul li .dragdhk img",function(e){
		var st=$(document).scrollTop();//alert(st);
		$(this).parent().parent().clone().addClass("clone").addClass("block").appendTo($("body"));//暂时借助一个位置来放置克隆元素
		$("body").css('cursor','move');
		$(".clone").css('left',e.clientX+1);
		$(".clone").css('top',e.clientY+1+st);		
		})	

//鼠标移动的时候，复制的东西如果存在，就跟着鼠标移走
/*下面这个可以不用on写，因为生成的元素并没有用到这个事件*/
	$(document).mousemove(function(e){
		var st=$(document).scrollTop();
		if($(".clone").length>0){
			$(".clone").css('left',e.clientX+1);
			$(".clone").css('top',e.clientY+1+st);
			$(".clone img").css('height',"50px");	
			$(".clone img").css('width',"50px");
			}
		})
	$(document).mouseup(function(e){
		$(".clone").remove();
		$("body").css('cursor','auto');
		})

//点击清除按钮，把存储的数据清空	
	/*$("body").on("click","#clear",function(){
		localStorage.clear();
		$("#pinner").html("");	
		$("ul ul").html("");
	})*/
	
	
})