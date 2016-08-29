<?php
include_once "../models/GlovesModel.php";
include_once "ListProductControl.php";
include_once "../views/GlovesView.php";

class GlovesController extends ListProductControl{
	
}


// ----main----
include_once "../serverconfig.php";
include_once "../lib/lib.php";

	
	$model = new GlovesModel(false);
	$view = new GlovesView($model,"gloves");
	$control = new GlovesController($model, $view);

?>