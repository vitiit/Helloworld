

<script src="lib/jquery-2.1.3.min.js"></script>
<script src="lib/jquery.js"></script>


<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->

<!-- 
<script language="javascript">
	/***************************************************************************************
	* Run when page load
	***************************************************************************************/
	$(document).ready(function()
	{
		// Sau khi page được load, gọi hàm initSlideShow
		initSlideShow();
		
	});

	/***************************************************************************************
	****************************************************************************************/
	function initSlideShow()
	{
		if($(".slideshow div").length > 1) //Only run slideshow if have the slideshow element and have more than one image.
		{
			var transationTime = 1000;//5000 mili seconds i.e 5 second
			$(".slideshow div:first").addClass('active'); //Thêm class cho thẻ div đầu tiên trong lớp slideshow
			setInterval(slideChangeImage, transationTime); //Cứ sau transation mili giây hàm slideChangeImage được gọi một lần
		}


	}

	/***************************************************************************************
	****************************************************************************************/
	
	function slideChangeImage()
	{
		var active = $(".slideshow div.active"); //Lấy thằng div đang active
		if(active.length == 0) // nếu không có thẻ nào active
		{
			active = $(".slideshow div:last"); //If do not see the active element is the last image.
		}
		
		var next = active.next().length ? active.next() : $(".slideshow div:first"); //get the next element to do the transition
		active.addClass('lastactive');
		next.css({opacity:0.0}) //do the fade in fade out transition
				.addClass('active')
				.animate({opacity:1.0}, 1500, function()
				{
					active.removeClass("active lastactive");	
				});
	}

</script>
 -->

<script type="text/javascript">
    $(document).ready(
        $(function() {
            $('.slideshow img:gt(0)').hide();
            setInterval(function(){
                $('.slideshow :first-child').fadeOut()
                         .next('img').fadeIn()
                         .end().appendTo('.slideshow');
            },
              3000);
        })
    );
</script>


<div class="slideshow">

	<img src="Images/slideshow/Slide_1.jpg" alt="Puma shoes" align="middle" width=100% margin: auto>
    <img src="Images/slideshow/Slide_2.jpg" alt="Puma shoes" align="middle" width=100% margin: auto>
    <img src="Images/slideshow/Slide_3.jpg" alt="Puma shoes" align="middle" width=100% margin: auto>
    <img src="Images/slideshow/Slide_4.jpg" alt="Puma shoes" align="middle" width=100% margin: auto>
    <img src="Images/slideshow/Slide_5.jpg" alt="Puma shoes" align="middle" width=100% margin: auto>
    <img src="Images/slideshow/Slide_6.jpg" alt="Puma shoes" align="middle" width=100% margin: auto>
    <img src="Images/slideshow/Slide_7.jpg" alt="Puma shoes" align="middle" width=100% margin: auto>
    <img src="Images/slideshow/Slide_8.jpg" alt="Puma shoes" align="middle" width=100% margin: auto>

<!-- 
	<img src="<?php echo SITE?>Images/slideshow/puma.jpg" onclick="window.location='<?php echo SITE?>controls/bootscontrol.php?brand=Puma'" />
	<img src="<?php echo SITE?>Images/slideshow/nike.jpg" onclick="window.location='<?php echo SITE?>controls/bootscontrol.php?brand=Nike'" />
	<img src="<?php echo SITE?>Images/slideshow/adidas.jpg" onclick="window.location='<?php echo SITE?>controls/bootscontrol.php?brand=adidas'" />
	<img src="<?php echo SITE?>Images/slideshow/gloves.jpg" onclick="window.location='<?php echo SITE; ?>controls/GlovesController.php'" />
	<img src="<?php echo SITE?>Images/slideshow/ball.jpg" onclick="window.location='<?php echo SITE; ?>controls/BallsController.php'" />
	<img src="<?php echo SITE?>Images/slideshow/teamwear.jpg" onclick="window.location='<?php echo SITE; ?>controls/ClothesController.php'" />
	<img src="<?php echo SITE?>Images/slideshow/sale.jpg" onclick="window.location=''" />
 -->
</div>





