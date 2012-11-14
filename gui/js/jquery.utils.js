(function(w,d) {
	
	var loadReact = function (url,data,fn) {
		
		$.ajax({
			url:url,
			data:data,
			type:'post',
			async: true,
			success:function(msg){
				var d = eval("(" + msg + ")");
				var flag = d.res;
				var data = d.data;
				fn(flag,data);
			},error:function(XMLHttpRequest, textStatus, errorThrown) {
				   alert(XMLHttpRequest.status);
                   alert(XMLHttpRequest.readyState);
                   alert(textStatus);
			}
		});
		
	};
	
	
	var qn = function(name) {
		return $("*[name="+name+"]");
	};

	
	var QJ = {};
	
	QJ.loadReact = loadReact;
	
	w.QJ = QJ;
	
	w._n = w.qn = qn;
	
		
	w.getLoaderUrl = function(name) {
		return AJAXURL+ name;
	};

	w.loader = {};
	
	w.loader.load = function(name,data,fn){
		var url = getLoaderUrl(name);
		loadReact(url,data,fn);
	};
	
	w.jumpto = function(url) {
		window.location.href=url;
	};


	w.goback = function(){
		window.history.go(-1);
	};
	
	w.getUniqueId = function() {
		var d = new Date();
		return d.getTime();
	}
	
})(window,document);


$.fn.id = function(){
	return $(this).attr("id");
}

$.fn.errorObj = function(){
	var id = $(this).id();
	var errorObj = $("#" + id+"_error");
	return errorObj;
}


$.fn.tableclear = function() {
	$(this).find("tr:gt(0)").remove();
}

$.fn.compare = function() {
   $(this).find("tr:gt(0)").each(function(i,obj){
	   var a = $(this).find("td:eq(1)").html();
	   var b = $(this).find("td:eq(2)").html();
	   if(a!=b){
		   $(this).css("color","red");   
	   }
   });
}

function str_repeat(a,i) {
	if(i<0) i = 0;
	var b = "";
	while(i--) {
		b += a;
	}
	return b;
}

function isFunction(obj) {
   if( obj == undefined ) obj = null;
   return (typeof obj=='function') && obj.constructor == Function; 
} 

function isEmail(str) {
	if(str == undefined) str = ""; 
	var pattern = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
	return pattern.test(str);
}

function getExtentionName(filename) {
	if(filename == undefined || filename == null) filename = ""; 
	var i = filename.lastIndexOf(".");
	var m = filename.substring(i+1).toLowerCase();
	return m;
}

Array.prototype.indexOf=function(substr,start){
	 var ta,rt,d="/0";
	 if(start!=null){ta=this.slice(start);rt=start;}else{ta=this;rt=0;}
	 var str=d+ta.join(d)+d,t=str.indexOf(d+substr+d);
	 if(t==-1)return -1;rt+=str.slice(0,t).replace(/[^/0]/g,"").length;
	 return rt;
	}

Array.prototype.lastIndexOf=function(substr,start){
	 var ta,rt,d="/0";
	 if(start!=null){ta=this.slice(start);rt=start;}else{ta=this;rt=0;}
	 ta=ta.reverse();var str=d+ta.join(d)+d,t=str.indexOf(d+substr+d);
	 if(t==-1)return -1;rt+=str.slice(t).replace(/[^/0]/g,'').length-2;
	 return rt;
}

Array.prototype.replace=function(reg,rpby){
	 var ta=this.slice(0),d="/0";
	 var str=ta.join(d);str=str.replace(reg,rpby);
	 return str.split(d);
}

Array.prototype.contains=function(elemnent){
	 return this.indexOf(elemnent)!=-1?true:false;
}


function _$(fn) {
	if(!window.$){
		 var head = document.getElementsByTagName('head')[0];
		 var jquery = document.createElement("script");
		 jquery.type = "text/javascript";
		 jquery.src = "http://lib.sinaapp.com/js/jquery/1.7.2/jquery.min.js";
		 if (document.all) { //如果是IE
	           jquery.onreadystatechange = function () {
	               if (jquery.readyState == 'loaded' || jquery.readyState == 'complete') {
	                	fn();
	               }
	          }
	     }  else {	//火狐浏览器
	            jquery.onload = function () {
	                   fn();
	             }
	      }
		 head.appendChild(jquery);
	}else{
		fn();
	}
}


$.fn.limit_length=limit_length;

function limit_length(){
	$(this).find("td").each(function(i,obj){
		var str = $(obj).text();
		var m = $(obj).find("*").size();
		if(str.length >= 33 && m == 1) {
			var m = str.substr(0,30);
			m = m + "<a href='javascript:void(0)'>...</a>";
			$(obj).html(m).find("a").click(function(){
				alert(str);
			});
		}
	});
}

$.fn.a_width = function(t){
	var row = $(this).find("tr:first");
	var tds = row.find("td");
	if(tds.size() == 0) tds = row.find("th");
	$(tds).each(function(i,obj){
		if(t.length >i)
			$(obj).width(t[i]);
	});
}