<?php
include_once "../models/BallsModel.php";
include_once "ListProductControl.php";
include_once "../views/BallsView.php";

class BallsController extends ListProductControl{
	
}


// ----main----
include_once "../serverconfig.php";
// include_once "../lib/lib.php";

	$TYPE = "ball";
	$model = new BallsModel(false);
	$view = new BallsView($model,"ball");
	$control = new BallsController($model, $view);

?>