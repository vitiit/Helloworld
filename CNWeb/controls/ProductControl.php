<?php
	include_once "../controls/Controller.php";
	include_once "../models/ProductModel.php";
	include_once "../views/ProductView.php";
	class ProductController extends Controller{
		
		public function __construct($model, $view)
		{
			parent::__construct($model, $view);

			$name = $_GET['name'];
			$parts = explode("-", $name);
			$id =  $parts[count($parts) - 1];			//lấy id

			//Chuyển về trang chủ nếu có lỗi
			if(!is_numeric($id))
				echo "<script>window.location.href = '". SITE . "index.php" . "'</script>";

			$id = intval($id);
			if($id == 0)
				echo "<script>window.location.href = '". SITE . "index.php" . "'</script>";

			//Xử lý sự kiện nút addToBasket được click -> thì lúc đó $_POST['submit'] được gọi
			if(isset($_POST['submit']))				//Nếu đã submit thêm vào giỏ hàng
			{
				if($_POST['size'] !== 'None')		//Nếu đã chọn size
				{
					$size = $_POST['size'];						//Lấy size
					$quantity = $_POST['quantity'];				//Lấy số lượng

					if(!isset($_SESSION['cart'][$id][$size]))	//Nếu chưa tồn tại thì tạo mới với giá trị bằng giá trị của $quantity
					{	
						$_SESSION['cart'][$id][$size] = $quantity;
					}
					else 										//Nếu session của sản phẩm này đã tồn tại thì cộng thêm giá trị của $quantity
						$_SESSION['cart'][$id][$size] += $quantity;
					
					// $var = "";
					// $var['notice'] = true;
					// $this->view->setVar($var);
				}
			}

			if(isset($_POST['getsale'])) {
				$sale = $model->getSale($id, $_POST['getsale']);
				echo $sale;
				return false;
			}

			$this->view->display();
		}
	}

// ----main----
	include_once "../serverconfig.php";
	include_once "../lib/lib.php";
	
	session_start();
	$model = new ProductModel;
	$view = new ProductView($model);
	$controller = new ProductController($model, $view);
?>	