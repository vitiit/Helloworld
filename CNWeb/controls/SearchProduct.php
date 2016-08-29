<?php
/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 05/05/2016
 * Time: 23:04
 */
require_once "../models/Model.php";
require_once "../serverconfig.php";
require_once ('../entity/Product.php');
class SearchProduct extends Model{

    public function __construct()
    {
        parent::__construct();
        if(isset($_GET["keyword"])){
            $key = $_GET["keyword"];
            $this->searchProduct($key);
        }
    }

    public function searchProduct($key){
        $sql = "SELECT *
					FROM product
					WHERE LOWER(product.name) LIKE LOWER('%".$key."%') ";
        $query = mysql_query($sql);
        if(!$query){
            return mysql_error();
        }
        $count = mysql_num_rows($query);
        $response = "[";
        if($count != 0){
            for($i = 0; $i < $count; $i++){
                $product = new Product();
                $product->id = mysql_result($query, $i, "id");
                $product->name = mysql_result($query, $i, "name");
                $product->price = mysql_result($query, $i, "price");
                $product->sale = mysql_result($query, $i, "sale");
                $json = json_encode($product);
                $response .= $json;
                if($i < ($count -1)){
                    $response .= ",";
                }
            }
        }
        $response .= "]";
        header('Content-type: application/json');
        echo "helo";
    }
}

$search = new SearchProduct();