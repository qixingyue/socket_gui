// JavaScript Document
$(function(){
		$('table tr').mouseover(function(){
			$(this).children('td').css('background-color','#ebf5fe');
		}).mouseout(function(){
			$(this).children('td').css('background-color','#fff');
		})
	})