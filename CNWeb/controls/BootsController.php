<?php
include_once "../models/BootsModel.php";
include_once "ListProductControl.php";
include_once "../views/BootsView.php";

class BootsControl extends ListProductControl{
	
}


// ----main----
include_once "../serverconfig.php";
include_once "../lib/lib.php";
	
	$model = new BootsModel(true);
	$view = new BootsView($model,"boot");
	$control = new BootsControl($model, $view);

?>