<!-- Ngo Huu Tuan -->

<?php
include "../views/View.php";
class Basket_View extends View
{
	private $var; 	// chứa số lượng item và tổng số tiền
	private $error;

	public function setError($error) {
		$this->error = $error;
	}

	public function setVar($var)
	{
		$this->var = $var;
	}

	public function display()
	{
		$id = 1;
		$name = "";

		$sql = "SELECT *
				FROM product
				WHERE id=".$id;
		$query = mysql_query($sql);
		$row = mysql_fetch_assoc($query);
		$name = $row['name'];
		$price = $row['price'];
		
		include "../views/header.php";
		?>
		<!-- html code -->
		<div id="content">
			<div class = "inner">
				<?php
					if(isset($this->error['error'])) {
						echo "<div class = 'checkout_error'>". $this->error['error'] ."</div>";

						if($this->error['error'] === "check out successfull !!!")
							echo "<script>var notice = 'successful'</script>";
					}

					if($this->var['numberItem'] != 0)
					{
						echo '<div class = "checkout">';
						echo	'<div class = "countBasket">';
						echo		'<h2>YOUR BASKET<span>('.$this->var["numberItem"].' item)</span></h2>';
						echo	'</div><br><!-- End of countBasket -->';
						echo '</div><!-- End of checkout -->';

						echo '<div class = "basket">';
						
						echo	'<div class = "basket_label">';
					/*	echo		'<div class = "basket_item_label">';
						echo			'ITEM';
						echo		'</div><!-- End of basket_item -->';

						echo		'<div class = "basket_option_label">';
						echo			'OPTIONS';
						echo		'</div><!-- End of basket_item -->';

						echo		'<div class = "basket_price_label">';
						echo			'PRICE';
						echo		'</div><!-- End of basket_item -->';
					*/	echo	'</div><!-- End of basket_label -->';
					

						echo 	'<div class = "basket_layout">';
						//Hiển thị từng item
						if(isset($_SESSION['cart'])) {
							$cart = $_SESSION['cart'];
							foreach ($cart as $id => $a) {
								//truy vấn theo id để lấy sản phẩm.
								foreach ($cart[$id] as $size => $quantity) {
									$sql = "SELECT name, price, sale
										FROM product, size
										WHERE product.id = size.id AND product.id=".$id ." AND size = '". $size . "'";
									$query = mysql_query($sql);
									if(!$query)
										die("query error");

									$row = mysql_fetch_assoc($query);
									$price = ceil($row['price'] - $row['price'] * $row['sale'] / 100);
									$this->displayItem($id, $row['name'], $price, $quantity, $size);
								}
							}
						}
						echo "</div><!--End of basket_layout-->";

						echo "<div class = 'totalmoney'>TOTAL MONEY: &pound". $this->var['totalmoney'] ."</div>";

						echo "<div class = 'checkout_popup_content'>";
						echo 	"<form action = '' method='post'>";
						echo 		"<div class = 'checkout_popup_input'>";
						echo 			"<label>Name: </label>";
						echo 			"<input type = 'text' name = 'name' placeholder = 'Your Name' required><br>";
						echo 		"</div>";

						echo 		"<div class = 'checkout_popup_input'>";
						echo 			"<label>Address: </label>";
						echo 			"<input type = 'text' name = 'address' placeholder = 'Your Address' required><br>";
						echo 		"</div>";

						echo 		"<div class = 'checkout_popup_input'>";
						echo 			"<label>Phone: </label>";
						echo 			"<input type = 'number' name = 'phone' placeholder = 'Your Phone' required min = '1'><br>";
						echo 		"</div>";

						echo 		"<div class = 'checkout_popup_input'>";
						echo 			"<input type = 'submit' name = 'checkout' value = 'CHECKOUT' class = 'checkout_popup_input_checkout'>";
						echo 		"</div>";
						echo 	"</form>";
						echo "</div><!-- End of checkout_popup_content -->";
					}
					else{
						echo '<div class = "countBasket">';
						echo	'<h2>YOUR BASKET IS EMPTY</h2>';
						echo '</div><!-- End of countBasket -->';
					}
				?>

				</div><!-- End of basket -->
			</div><!-- End of inner -->
			<div class = "checkout_layout">
			</div>
		<!-- </div> -->
		<!-- End of HTML code -->

		<div class = "basket_popup">
			<div class = "layout">
				<div class = "basket_content">
					<form action = "" method="post" class = "input_form">
						<div class = "popup_old_quantity_class">
							<p class = "popup_old_quatity_label">Old quantity: </p>
							<p class = "popup_old_quatity">Old value in here</p>
						</div>

						<div class = "popup_new_quantity_class">
							<p class = "popup_new_quantity_label">New quantity:</p>
							<input type = "number" name = "popup_newvalue" class = "popup_new_quantity" required min = "1">
						</div>

						<div class = "popup_button">
							<input type = "submit" name = "change_quantity" value = "CHANGE" class = "popup_change_button">
							<input type = "submit" name = "cancel" value = "CANCEL" class = "popup_cancel_button" >
						</div>
					</form>
				</div><!-- End of basket_content -->
			</div><!-- End of layout -->
		</div><!-- End of basket_popup -->


		<div class = "basket_notice">
			<span>checkout successfull !!!<br></span>
			<button class = "basket_notice_continue">Continue Shoping</button>
			<button class = "basket_notice_cancel">Cancel</button>
		</div>

		<?php
		include "../views/footer.php";
		?>

		<script>
			$(document).ready(function(){
				$(".popup_cancel_button").click(function(){
					$(".basket_popup").fadeOut(300);
					$(".checkout_layout").fadeOut(300);
					return false;
				});		

				$(".checkout_layout").click(function(){
					$(this).fadeOut(300);
					$(".basket_popup").fadeOut(300);
					$(".basket_notice").fadeOut(300);
				});

				//-------------Set sự kiện cho từng change button---------------
				$(".basket_item").each(
					function(){
						var change_button = $(this).find(".change_button");
						var sizeValue = $(this).find(".quantity_value");
						change_button.click({name : change_button.attr("name"), oldSize : sizeValue.text()}, changeButtonCallback);
					}
				);

				//Hàm callback xử lý sự kiện
				function changeButtonCallback(event){
					$(".popup_new_quantity").attr("name", event.data.name);
					$(".popup_old_quatity").text(event.data.oldSize);
					$(".basket_popup").fadeIn(300);
					$(".checkout_layout").fadeIn(300);
					$(".popup_new_quantity").val("1");
				}
				//--------------------------------------------------------------

				//Sự kiện khi ấn phím checkout thì hiển thi popup checkout
				$('.checkout_view').click(function(){
					$('.checkout_popup').fadeIn(300);
					$('.checkout_layout').css("display", "block");
					return false;
				});


				//Xử lý sự kiện khi ấn X ở popup checkout
				$('.checkout_popup_close').click(function(){
					$('.checkout_popup').fadeOut(300);
					$('.checkout_layout').css("display", "none");
					return false;
				});

				//Xử lý sự kiện khi ấn cancel ở popup checkout
				$('.checkout_popup_input_cancel').click(function(){
					$('.checkout_popup').fadeOut(300);
					$('.checkout_layout').css("display", "none");
					return false;
				});

				//Pop up thông báo đạt hàng thành công
				$(".basket_notice_cancel").click(function(){
					$(".basket_notice").fadeOut(300);
					$('.checkout_layout').fadeOut(300);
				});

				$(".basket_notice_continue").click(function(){
					window.location.href = <?php echo "'".SITE."'"?> + 'index.php';
				});

				$(".basket_notice_cancel").click(function(){
					window.location.href = <?php echo "'".SITE."'"?> + 'controls/basket.php';
				});

				// if(notice === "successful") {
				// 	$(".basket_notice").fadeIn(300);
				// 	$('.checkout_layout').css("display", "block");
				// }

			});

		</script>
		<?php
	}

	public function displayItem($id = "", $name = "", $price = "", $quantity, $size)
	{

		$viewError = "";
		if(isset($this->error[$id][$size]))
			$viewError = $this->error[$id][$size];

		echo'
		<div class = "basket_item">
			<div class = "basket_info">
				<img src = "'.SITE.'Images/product/Chinh/'.$id.'.jpg" alt = "image">
				<div class = "basket_text">
					<a href = '.SITE.'controls/product.php?name='.$this->clean($name).'-'.$id.' target="_blank">'.$name.'</a>
				</div>
				<form action = "" method = "post">
					<button type = "submit" name = "remove" value = "'.$id."-".$size.'" class = "remove_button">REMOVE</button>
				</form>
			</div><!-- End of basket_item -->

			<div class = "basket_option">
				<p class = "size_label">Size:</p>
				<p class = "size_value">'.$size.'</p>
				<p class = "quantity_label">Quantity:</p>
				<p class = "quantity_value">'.$quantity.'</p>
				<input type = "submit" name = "'.$id.'-'.$size.'" value = "CHANGE" class = "change_button">
				<div class = "errorlog">'. $viewError .'</div>
			</div><!-- End of basket_item -->

			<div class = "basket_price">
				&pound'.$quantity * $price.'
			</div><!-- End of basket_item -->
		</div><!-- End of basket_item -->';
	}

	 private function clean($string) {
        $string =  preg_replace('/\//', ' ', $string); 		// Thay dấu / bằng space
        $string =  preg_replace('/-/', ' ', $string); 		// Thay dấu - bằng space
        $string = preg_replace('/\s\s+/', ' ', $string);    //xóa space thừa
        $string =  preg_replace('/ /', '-', $string);       //Thay thế space bằng dấu -
        return $string;
    }
}
?>