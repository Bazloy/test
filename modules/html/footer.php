	<div id="footer">
        <center><span>Инди разработчики игр</span></center>
    </div>
	
	<script>
	
		function slowScroll(id){
			$('html, body').animate({
				scrollTop: $(id).offset().top
			}, 500);
		}
	
		$(document).on("scroll", function(){
			if($(window).scrollTop() == 0){
				$("header").removeClass("fixed");
			}else{
				$("header").attr("class", "fixed");
			}
		})
	</script>
	
</body>
</html>