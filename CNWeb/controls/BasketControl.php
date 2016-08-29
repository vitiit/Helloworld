<!-- Ngo Huu Tuan -->
<!-- Xử lý giỏ hàng -->


<?php
include "../controls/Controller.php";
include "../models/BasketModel.php";
include "../views/BasketView.php";

class Basket_Controller extends Controller{
	public function __construct($model, $view)
	{
		parent::__construct($model, $view);

		//Thêm sản phẩm vào giỏ hàng
		$var; // kiểu mảng liên kết chứa : số lượng sp và tổng số tiền
		$var['numberItem'] = 0; // Số lượng sản phẩm bằng 0
		
		//Tính tổng số mặt hàng có trong giỏ hàng, cart là giỏ hàng chứa nhiều mặt hàng
		if(isset($_SESSION['cart']))
		{
			$cart = $_SESSION['cart'];
			foreach ($cart as $id => $a) { 					// chỉ  mục 0, 1, 2
				foreach ($cart[$id] as $key => $value) {    // liên kết key và value
					$var['numberItem'] += count($cart[$id][$key]);
				}
			}
		}
		
		//xử lý sửa số lượng 
		if(isset($_POST['change_quantity']))				//khi ấn phím change ở popup
		{
			$id = "";
			$size = "";
			$newQuantity = "";

			//form gủi gồm name của input và name của text, vòng for dưới đây tìm name của text để lấy dữ liệu
			foreach($_POST as $key=>$value)
			{
				if($key !== 'change_quantity')
				{
					$parts = explode("-", $key);
					$id = $parts[0];
					$size = $parts[1];
					$newQuantity = $value;
					break;
				}
			}

			$_SESSION['cart'][$id][$size] = $newQuantity;
		}

		//Xóa item khỏi giỏ hàng
		if(isset($_POST['remove']))
		{
			$parts = explode("-", $_POST['remove']);
			$id = $parts[0];
			$size = $parts[1];
			unset($_SESSION['cart'][$id][$size]);
			$var['numberItem']--;
		}

		$error = "";
		$totalmoney = 0;
						
		if(isset($_SESSION['cart'])) {
			$cart = $_SESSION['cart'];
			foreach ($cart as $id => $a) {
				foreach ($cart[$id] as $size => $quantity) {
					$row = $model->getDetailProductBySize($id, $size);
					//Tính tổng tiền
					$totalmoney += $quantity * ceil($row['price'] * (100 - $row['sale']) / 100);
				}
			}
			$var['totalmoney'] = $totalmoney;
		}
		

		//Xử lý checkout
		if(isset($_POST['checkout'])) {
			date_default_timezone_set('Asia/Bangkok');
			$time = date('Y-m-d H:i:s');	
			$name = $_POST['name'];								/*Tên người dùng*/
			$address = $_POST['address'];						/*Địa chỉ*/
			$phone = $_POST['phone'];							/*sdt*/

			if(isset($_SESSION['cart']))
			{
				$flag = true;			//Biến xác định xem có sản phẩm nào đặt hàng lỗi không
				$cart = $_SESSION['cart'];
				$totalmoney = $var['totalmoney']; //

				foreach ($cart as $id => $a) {
					foreach ($cart[$id] as $size => $quantity) {
						$row = $model->getDetailProductBySize($id, $size);

						//Set trạng thái cho từng sản phẩm
						if($row['numbers'] < $quantity) {
							$error[$id][$size] = "OUT OF STOCK";
							$flag = false;
						}
						else 
							$error[$id][$size] = "successfull";
					}
				}

				//Nếu có tất cả sp đều thành công thì cập nhật vào csdl
				if($flag === false) {
					$error["error"] = "some items out of stock, please chose another quantity and checkout again";
				} else {
					$error['error'] = "check out successfull !!!";
					//Cập nhật hóa đơn vào csdl
					$result = $this->model->updateOrderInfo($time, $name, $address, $phone, $totalmoney);

					if($result !== false) {
						$cart = $_SESSION['cart'];

						foreach ($cart as $id => $a) {
							foreach ($cart[$id] as $size => $quantity) {
								$row = $model->getDetailProductBySize($id, $size);
								$price = ceil($row['price'] * (100 - $row['sale']) / 100);
								$this->model->updateOrder($id, $size, $quantity, $price);
							}
						}
					}
					// session_destroy();
					if(isset($_SESSION['cart'])){
						unset($_SESSION['cart']);
					}
				}
			}
		}

		$view->setError($error);
		$view->setVar($var);
		$view->display();
	}
}

// ----main----
include_once "../serverconfig.php";
include_once "../lib/lib.php";

session_start();
$model = new  Basket_Model;
$view = new Basket_View($model);
$control = new Basket_Controller($model, $view);
?>