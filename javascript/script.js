$(window).load(function(){


	subpage=window.location.hash.substring(1);
	if(subpage!=""){
		$("#"+subpage+"_sec").slideDown();
	}else{
		$("#home_sec").slideDown();
	}





	$("#nav a, #logo a,#button a").click(function(){
		target=$(this).attr("href");
		$("#main>div").slideUp();
		$(target+"_sec").slideDown();
	
	});

	$("#classes_sec a").click(function(){
		
		$("#classwrapper>div").slideUp();
		target=$(this).attr("id");
		
		$(target).slideDown();


	});

	$("div.asdf").bind("mousemove",function(event){
		targ=$(this).attr("id");
		$("#mouseover"+targ).css({	top:event.pageY +5 +"px",left:event.pageX+5+"px"}).show();
		}).bind("mouseout",function(){$("#mouseover"+targ).hide();
	});




});