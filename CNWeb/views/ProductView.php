
<!-- Ngo Huu Tuan -->
<!-- View hiển thị chi tiết sản phẩm -->

<?php 

include_once("../views/view.php");

class ProductView extends View{
	private $var;
	public $id;

	public function setVar($var =''){
		$this->var = $var;
	}

	public function display(){
		include_once ("../views/header.php");

		// Lấy tên và ID của sản phẩm
		$name  = $_GET['name']; 			// Gồm tên sp và id ở cuối
		$parts = explode("-", $name);		// Mảng chứa tên sp và id sp
		$id    = $parts[count($parts) - 1];	// Lấy phần tử cuối cùng trong mảng -> ID sp
		$this->id = $id;

		// Truy vấn thông tin sản phẩm theo ID
		$result = $this->model->getDetailProduct($id);
		if(!$result) die("ProductView không truy vấn được CSDL");
		$row = mysql_fetch_assoc($result);
		?>

		<div id="content"> <!-- ListProduct.css -->
			<div class="inner"> <!-- ListProduct.css -->

				<div id="left"> <!-- Product.css -->
					<ul id="slider"> <!-- Product.css -->
						<?php
						// Mặc định sẽ có 4 ảnh to và 4 ảnh nhỏ tương ứng.
							for($i = 0; $i < 4; $i++){
								echo "	<li id=".($i + 1)."><img src=".SITE."Images/product/Phu/".$row["id"]."_".($i+1).".jpg alt='Images'></li>";
							}
						?>
					</ul> <!-- End of slider -->
					
					<ul id="thumb">
						<?php
							for($i = 0; $i < 4; $i++){	// Ảnh nhỏ có kích thước là 50px
								echo "	<li id=".($i + 1)."><a href = '#".($i + 1)."'><img src=".SITE."Images/product/Phu/".$row["id"]."_".($i + 1).".jpg
										alt = 'Images'></a></li>";
							}
						?>
					</ul>

					<div class="product-descript">
						<h3 style="text-transform:uppercase; font-weight: 600; color: #FFF; display:inline-block; ">Item details</h3>
						<br>
						<p class="descript"><?php echo $row['description']?></p>;
					</div> <!-- End of Description -->
				</div> <!-- End of left -->


				<div id="right">
					<h2 style="padding:0px; color:#999; margin: 0px;"> <?php echo $row['name'] ?> </h2><br>
					<p class="descript"><?php  echo $row['shortdesc']?> </p><br>
					<h1>Price</h1>
					<?php
						$arrSize = mysql_fetch_array($this->model->getAllSizeProduct($id));
						$sale = $this->model->getSale($id, $arrSize[0]);
						$saving = $row['price']*((100 - $sale)/100);
					?>	
					<p class="price"><?php echo "&pound".($row['price']-$saving)?></p>
					<p class="old-price"><?php echo "&pound".$row['price']?></p>
					<p class="saving"><?php echo "Saving &pound".$saving?></p>
					<br><br>

					<!-- Hiển thị form chọn size và số lượng -->
					<form action = "" method = "post">
					<div style="float: left;" id="select_size">
						Size
						<br> 
						<select name="size" id = "selector"> <!-- Thẻ select -->
							<?php
								$sizeQuery = $this->model->getAllSizeProduct($id);
								if(!$sizeQuery) {
									echo mysql_error();
									die('Lỗi truy vấn database');
								} else {
									for($i = 0; $i < mysql_num_rows($sizeQuery); $i++) {
										$row = mysql_fetch_assoc($sizeQuery);
										//Thẻ option trong select, một bên là giá trị, một bên là nhưng gì sẽ đc hiển thị
										echo '<option value="'.$row['size'].'">'.$row['size'].'</option>'; 
									}
								}
							?>	
						</select>
					</div> <!-- End of select size -->

					<div style ="float:right;" id="select_quantity">	
						Quantity 
						<br> 
						<input type="number" name="quantity" class = "input" value="1" min = "1"> 
					</div><!-- End of select quantity -->

						<input type = "submit" name = "submit" class="button" value="ADD TO BASKET" onclick = "addToCart()" />			
						<p id="productID" style="display: none;">
							<?php echo $id; ?>
						</p>

					<script type="text/javascript">
						function addToCart(){
							alert("Đã thêm vào giỏ hàng");							
						}
					</script>	

					</form> <!-- End of form -->	

				</div> <!-- End of right -->

			</div> <!-- End of inner -->	
			
			<!-- Xử lý sự kiện thay đổi size -->
			<script type="text/javascript">
			function load_ajax(size, id){
                $.ajax({
                    url : 'http://localhost/cnweb/getSale.php',
                    type : "post",
                    dataType:"text", // kiểu dữ liệu trả về (json, xml, script, text)
                    data : {
                        size : size,
                        id: id
                    },
                    success : function (result){

                    	var old_price = $(".old-price").text().split("£")[1];
                    	var price = Math.ceil(old_price - old_price * result / 100);
                    	var saving = old_price - price;
                    	if(result != 0) {
                    		$(".price").text("£" + price);
							$(".old_price").text("£" + old_price);
                    		$(".saving").text("Saving £" + saving);
                    	} else {
                    		$(".price").text("£" + old_price);
                    		$(".old_price").text("");
                    		$(".saving").text("");
                    	}
                    }
                });
            }
            
			/*  Bắt sự kiện thay đổi giá trị size */
			$(document).ready(function(){
		      	$("#selector").change(function(){
		      		$("#selector option:selected").each(function(){
		      			var id = $("#productID").text();
		      			load_ajax($(this).text(), id);
		      		});
		      	});
		    });
				
		</script>

		<?php 
			include_once ("../views/footer.php");
	}
}

?>