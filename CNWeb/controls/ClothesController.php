<?php
include_once "../models/ClothesModel.php";
include_once "ListProductControl.php";
include_once "../views/ClothesView.php";

class ClothesController extends ListProductControl{
	
}


// ----main----
include_once "../serverconfig.php";
include_once "../lib/lib.php";

	
	$model = new ClothesModel(true);
	$view = new ClothesView($model,"clothes");
	$control = new ClothesController($model, $view);

?>