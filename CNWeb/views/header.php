
<?php
    $lib = new Library;
    // if (session_status() == PHP_SESSION_NONE) {
    //     session_start();
    // }
    // if(isset($_GET['signout']))
    // {
    //     session_unset('name');
    //     $lib->redirect($lib->removeVarInURL('signout'));
    // }

?>


<!DOCTYPE html>

<html lang="vi">
<head>
	<title>Pro:Direct Soccer</title>
	<meta name="description" content="BLT mon Cong nghe Web"/>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="<?php echo SITE; ?>styles/normalize.css"/>
	<link rel="stylesheet" href="<?php echo SITE; ?>styles/homepage.css"/>
	<link rel="stylesheet" href="<?php echo SITE; ?>styles/product.css"/>
	<link rel="stylesheet" href="<?php echo SITE; ?>styles/listproduct.css"/>
	<link rel="stylesheet" href="<?php echo SITE; ?>styles/basket.css"/>

	<script src="<?php echo SITE; ?>lib/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE; ?>lib/lib.js" type="text/javascript"></script>
    <script src="<?php echo SITE; ?>lib/rest-api.js" type="text/javascript"></script>

</head>

<body style="background-color:black">

    <div class="header" style="background:black">
    	<!-- Chua co gi -->
    	<img src="<?php echo SITE;?>Images/logo_pro.png" width="200" height="100">
    </div>

   <?php include("menu.php"); ?>



