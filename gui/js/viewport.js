var screenHeight,// 可见页面的高度
	screenWidth,// 可见页面的宽度
	mainpanelHeight,// yzt_body高度
	leftpanelHeight,// 左侧导航条内容高度
	rightpanelWidth;// frame高度

function getViewPort(){
	return {
			height:parseInt(document.documentElement.clientHeight),
			width:parseInt(document.documentElement.clientWidth)
		}
	
	// 计算
	if(document.compatMode=='BackCompat'){
		return {
			height:parseInt(document.body.clientHeight),
			width:parseInt(document.body.clientWidth)
		}
	}else{
		return {
			height:parseInt(document.documentElement.clientHeight),
			width:parseInt(document.documentElement.clientWidth)
		}
	}
}

/**
 * 初始化 计算、设置高度 为元素绑定事件
 */
function init(){
	
	//计算
	var viewPort = getViewPort();
	screenHeight = viewPort.height;		
	screenWidth = viewPort.width;	

	mainpanelHeight = screenHeight - 127;
	leftpanelHeight = mainpanelHeight - 8;
	rightpanelWidth = screenWidth - 210;
	
	//设置
	$(".mainpanel").css('height',mainpanelHeight);
	$(".leftpanel").css('height',leftpanelHeight);
	$(".rightpanel").css('height',mainpanelHeight);
	$(".rightpanel").css('width',rightpanelWidth);
	//绑定事件.3
	navigation();
}

/**
 * 导航条内容 元素绑定事件 实现导航
 */
function navigation(){
	//导航条内容的dd
	var li=$(".leftpanel ul li");
	//导航条内容的a
	var a=$(".leftpanel ul li a");
	a.bind('click',function(){ 
		
		
		li.each(function(i,obj){
			alert($(obj).attr('class'));
		});
		
		$(this).parent().attr('class','navLiCurrent');
		
		var url=$(this).attr('url');
		$("#mainframe").attr('src',url);
		
		return false;
	})
}


$(function(){
	init();
	$(window).resize(init); 
}) 