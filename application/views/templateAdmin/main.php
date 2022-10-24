<!DOCTYPE html>
<html>
<?php echo $head;?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php echo $nav;?>
<?php //echo $header;?>
<?php echo $sidebar;?>
<?php echo $content;?>
<?php echo $footer;?>
<?php echo $js;?>
</div>
<div class="loading" style="position: fixed; bottom: 10px; right: 10px; z-index: 1000; display: none">
  <i class="fa fa-spinner fa-spin"></i>
</div>
<script type="text/javascript">
$(document).ready(function(){
  /*$( document ).ajaxStart(function() {
   $(".loading").fadeIn();
  }).ajaxStop(function(){
   $(".loading").fadeOut();
  });*/


});

$("li.main-menu").click(function() {
  $("li.main-menu").removeClass("active");
  $(this).addClass("active");
});

$('li.main-menu a').click(function(e){
	e.preventDefault();

	var href=$(this).attr('href');
	if(href!="#"){
		$.get(href,function(Res){
   		$('.content').html(Res);
   	});
	}
	
});
</script>
</body>
</html>