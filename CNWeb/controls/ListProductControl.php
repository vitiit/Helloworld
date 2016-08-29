<?php
include_once "../lib/lib.php";
include_once "../controls/Controller.php";

class ListProductControl extends Controller{
	public function __construct($model, $view)
	{
		parent::__construct($model, $view);
		$lib = new Library();
		
		$query = $this->model->getProductByFilter($view->getTYPE());
		if(!$query)
		{
			exit("stop");
		}
		
        //t/h this->currentPage > totalPage thì set this->currentPage = totalPage và load lại trang
	    $totalItem = mysql_num_rows($query);
	    $currentView = 24;						//biến lưu số sản phẩm sẽ hiển thị trong 1 trang
	    $totalPage = 1;							//biến lưu trữ tổng số trang
	    $currentPage = 1;						//biến lưu trữ trang hiện tại

        if(isset($_GET['p'])){					
            $currentPage = $_GET['p'];					//Lấy trang hiện tại
			if(!is_numeric($currentPage)){
				$lib->redirect($lib->addVarToURL("p=1"));
			}
			else{
				if(intval($currentPage) < 1)
					$lib->redirect($lib->addVarToURL("p=1"));
			}
		}
	                        
	    if(isset($_GET['pp']))								
	    {
	        $currentView = $_GET['pp'];							//Lấy số sản phẩm sẽ hiển thị trong 1 trang
			if(!is_numeric($currentView)){						//Nếu không phải là số => set giá trị mặc định
				$lib->redirect($lib->addVarToURL("pp=24"));
			}
			else{
				if($currentView != 24 && $currentView != 48 && $currentView != 72)					//Nếu là số nhưng < 0 => set giá trị mặc định
					$lib->redirect($lib->addVarToURL("pp=24"));
			}
	    }
	    $totalPage =  ceil($totalItem / $currentView);
		if($totalPage < 1)
			$totalPage = 1;
		
		$this->view->setTotalItem($totalItem);
		$this->view->setTotalPage($totalPage);
		$this->view->setCurrentView($currentView);
		$this->view->setCurrentPage($currentPage);
		$this->view->setQuery($query);
 
		$this->view->display();
	}



}



?>