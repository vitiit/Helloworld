<?php
include_once "../views/View.php";

class ListProductView extends View{

    private $TYPE;
    private $totalItem;
    private $totalPage;
    private $currentView;
    private $currentPage;
    private $query;

    public function __construct($model,$TYPE=""){
        parent::__construct($model);
        $this->TYPE = $TYPE;
       
    }

    public function setTotalItem($totalItem)
    {
        $this->totalItem = $totalItem;
    }

    public function setTotalPage($totalPage)
    {
        $this->totalPage = $totalPage;
    }    

    public function setCurrentView($currentView)
    {
        $this->currentView = $currentView;
    }   

    public function setQuery($query)
    {
        $this->query = $query;
    }     

    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
    }
    
    public function getTYPE(){
        return $this->TYPE;
    }


    public function createFilter(){
        //Tạo bộ lọc brand
        $brandFilter = $this->model->getAttributeByFilter($this->TYPE,"brand");
        if($brandFilter) {
            //Nếu có > 1 sự lựa chọn thì hiển thị bộ lọc hoặc bộ lọc đã được chọn
            if(mysql_num_rows($brandFilter) > 1 || mysql_num_rows($brandFilter) == 1 && isset($_GET['brand'])) {           
                echo '<div class = "is-close">
                        <h4>Brands:</h4>
                        <div class = "holder">
                            <ul>';
                while($row = mysql_fetch_assoc($brandFilter))
                {
                    if(!empty($row['brand']))
                        echo '<li>'.$row['brand'].'</li>';
                }

                echo '          </ul>
                            </div>
                        </div>';
            }
        }

        //Tạo bộ lọc collection
        $collectionFilter = $this->model->getAttributeByFilter($this->TYPE,"collection");
        if($collectionFilter) {
            //Nếu có > 1 sự lựa chọn thì hiển thị bộ lọc hoặc bộ lọc đã được chọn
            if(mysql_num_rows($collectionFilter) > 1 || mysql_num_rows($collectionFilter) == 1 && isset($_GET['silo'])) {           
                echo '<div class = "is-close">
                        <h4>Collection:</h4>
                        <div class = "holder">
                            <ul>';
                while($row = mysql_fetch_assoc($collectionFilter))
                {
                    if(!empty($row['collection']))
                        echo '<li>'.$row['collection'].'</li>';
                }

                echo '          </ul>
                            </div>
                        </div>';
            }
        }

        //Tạo bộ lọc model
        $modelFilter = $this->model->getAttributeByFilter($this->TYPE,"model");
        if($modelFilter) {
            //Nếu có > 1 sự lựa chọn thì hiển thị bộ lọc hoặc bộ lọc đã được chọn
            if(mysql_num_rows($modelFilter) > 1 || mysql_num_rows($modelFilter) == 1 && isset($_GET['subsilo'])) {           
                echo '<div class = "is-close">
                        <h4>Model:</h4>
                        <div class = "holder">
                            <ul>';
                while($row = mysql_fetch_assoc($modelFilter))
                {
                    if(!empty($row['model']))
                        echo '<li>'.$row['model'].'</li>';
                }

                echo '          </ul>
                            </div>
                        </div>';
            }
        }

        //Tạo bộ lọc team
        $teamFilter = $this->model->getAttributeByFilter($this->TYPE,"team");
        if($teamFilter) {
            
            //Nếu có > 1 sự lựa chọn thì hiển thị bộ lọc hoặc bộ lọc đã được chọn
            if(mysql_num_rows($teamFilter) > 1 || mysql_num_rows($teamFilter) == 1 && isset($_GET['reptm'])) {           
                echo '<div class = "is-close">
                        <h4>Team:</h4>
                        <div class = "holder">
                            <ul>';
                while($row = mysql_fetch_assoc($teamFilter))
                {
                    if(!empty($row['team']))
                        echo '<li>'.$row['team'].'</li>';
                        
                }

                echo '          </ul>
                            </div>
                        </div>';
            }
        }


        //Tạo bộ lọc league
        $leagueFilter = $this->model->getAttributeByFilter($this->TYPE,"league");
        if($leagueFilter) {
            //Nếu có > 1 sự lựa chọn thì hiển thị bộ lọc hoặc bộ lọc đã được chọn
            if(mysql_num_rows($leagueFilter) > 1 || mysql_num_rows($leagueFilter) == 1 && isset($_GET['replg'])) {           
                echo '<div class = "is-close">
                        <h4>League:</h4>
                        <div class = "holder">
                            <ul>';
                while($row = mysql_fetch_assoc($leagueFilter))
                {
                    if(!empty($row['league']))
                        echo '<li>'.$row['league'].'</li>';
                }

                echo '          </ul>
                            </div>
                        </div>';
            }
        }


        //Tạo bộ lọc size
        $sizeFilter = $this->model->getAttributeByFilter($this->TYPE,"size");
        if($sizeFilter) {
            //Nếu có > 1 sự lựa chọn thì hiển thị bộ lọc hoặc bộ lọc đã được chọn
            if(mysql_num_rows($sizeFilter) > 1 || mysql_num_rows($sizeFilter) == 1 && isset($_GET['s'])) {           
                echo '<div class = "is-close">
                        <h4>Size:</h4>
                        <div class = "holder">
                            <ul>';
                while($row = mysql_fetch_assoc($sizeFilter))
                {
                    if(!empty($row['size']))
                        echo '<li>'.$row['size'].'</li>';
                }

                echo '          </ul>
                            </div>
                        </div>';
            }
        }

        //Tạo bộ lọc color
        $colorFilter = $this->model->getAttributeByFilter($this->TYPE,"basecolor");
        if($colorFilter) {
            //Nếu có > 1 sự lựa chọn thì hiển thị bộ lọc hoặc bộ lọc đã được chọn
            if(mysql_num_rows($colorFilter) > 1 || mysql_num_rows($colorFilter) == 1 && isset($_GET['clr'])) {
                echo '<div class = "is-close">
                        <h4>Color:</h4>
                        <div class = "holder">
                            <ul>';
                while($row = mysql_fetch_assoc($colorFilter))
                {
                    if(!empty($row['basecolor']))
                        echo '<li>'.$row['basecolor'].'</li>';
                }

                echo '          </ul>
                            </div>
                        </div>';
            }
        }

        //Tạo bộ lọc type
        $typeFilter = $this->model->getAttributeByFilter($this->TYPE,"type");
        if($typeFilter) {
            //Nếu có > 1 sự lựa chọn thì hiển thị bộ lọc hoặc bộ lọc đã được chọn
            if(mysql_num_rows($typeFilter) > 1 || mysql_num_rows($typeFilter) == 1 && isset($_GET['t'])) {
                echo '<div class = "is-close">
                        <h4>Types:</h4>
                        <div class = "holder">
                            <ul>';
                while($row = mysql_fetch_assoc($typeFilter))
                {
                    if(!empty($row['type']))
                        echo '<li>'.$row['type'].'</li>';
                }

                echo '          </ul>
                            </div>
                        </div>';
            }
        }


        //Tạo bộc lọc price
        $maxPriceQuery = $this->model->getMaxMinPriceByFilter($this->TYPE, 'max');
        $minPriceQuery = $this->model->getMaxMinPriceByFilter($this->TYPE, 'min');

        if(!$maxPriceQuery || !$minPriceQuery) {
            die('Truy vấn lỗi');
        } else {
            $maxPrice = 0;
            $minPrice = 0;
            $split = 0;
            $max = 0;
            $min = 0;

            $row = mysql_fetch_assoc($maxPriceQuery);
            $maxPrice = $row['price'];
            $row = mysql_fetch_assoc($minPriceQuery);
            $minPrice = $row['price'];

            if($maxPrice >= 100)
                $split = 100;
            else
                $split = 10;

            $max = floor($maxPrice / $split);
            $min = floor($minPrice / $split);
            
            if($min !== $max || $min === $max && isset($_GET['pb'])) {
                echo '<div class = "is-close">
                    <h4>Price:</h4>
                    <div class = "holder">
                        <ul>';
                for($i = $min; $i <= $max; $i++) {
                    echo '<li>&pound'.($i * $split).'-&pound'.(($i + 1) * $split - 1).'</li>';
                }

                echo '          </ul>
                            </div>
                        </div>';
            }
        }
    }// end fucntion

    public function display()
    {
        include '../views/header.php';
        ?>
        <div id="content">
        <div class = "inner">
        <div class = "leftbar">
            <div class = "total-product">
                
            </div><!-- End of abc total-product -->
            <a href = "" class = "resetfilter" onclick = "return resetFilter()">RESET FILTERS</a>
            <div class = "filter">
                <?php
                   $this->createFilter();                                      
                    //-----------------------------------------                    
                ?>
            </div><!-- End of filter -->
        </div><!-- End of leftbar -->

        <div class = "rightbar">
            <div class = "order">
                <div class = "sort-by">
                    <label>Order By:</label>
                    <!-- <div class = "selecter"> -->
                        <select onChange="" value="GO">
                            <option value="<?php echo $lib->removeVarInURL('o');?>">Recommended</option>
                            <option value = "<?php echo $lib->addVarToURL('o=discount');?>"
                                <?php if(isset($_GET['o']) && $_GET['o'] == "discount") echo 'selected'?>>Biggest Saving</option>
                            <option value = "<?php echo $lib->addVarToURL('o=lth');?>" 
                                <?php if(isset($_GET['o']) && $_GET['o'] == "lth") echo 'selected'?>>Price Low - Hight</option>
                            <option value = "<?php echo $lib->addVarToURL('o=htl');?>"
                                <?php if(isset($_GET['o']) && $_GET['o'] == "htl") echo 'selected'?>>Price Hight - Low</option>
                            <option value = "<?php echo $lib->addVarToURL('o=latest');?>"
                                <?php if(isset($_GET['o']) && $_GET['o'] == "latest") echo 'selected'?>>Release Dates</option>
                        </select>
                    <!-- </div> -->
                </div>

                <div class = "view">
                    <ul>
                        <span>View:</span>
                        <li><a href = "<?php echo $lib->addVarToURL('pp=24');?>" class = "current-view">24</a><li>
                        <li><a href = "<?php echo $lib->addVarToURL('pp=48');?>" class = "current-view">48</a></li>
                        <li><a href = "<?php echo $lib->addVarToURL('pp=72');?>" class = "current-view">72</a></li>
                    </ul>
                </div>

                <div class = "next-page">
                    <a href = "<?php
                                    if(isset($_GET['p']))
                                    {
                                        $temp = 'p='.$_GET['p'];
                                        if(($_GET['p'] + 1) <= $this->totalPage)
                                            $temp = 'p='.($_GET['p'] + 1);
                                    }
                                        else $temp = 'p=2';
                                    echo $lib->addVarToURL($temp);
                                ?>">
                                <img src = "../Images/next-page.png"></a>
                </div>

                <div class = "page">
                    <?php
                        //set biến this->currentPage và totalpage cho javascript để tạo hiệu ứng khi next hoặc pre trang
                        echo "
                                <script>
                                    var currentPage = ".$this->currentPage."
                                    var totalPage = ".$this->totalPage."
                                </script>
                             ";
                        if($this->currentPage > $this->totalPage)
                        {
                            $this->currentPage = $this->totalPage;
                            $temp = 'p='.$this->currentPage;
                            echo "<script>
                                    window.location.href = '".$lib->addVarToURL($temp)."'
                                    </script>";
                        }
                        echo "Page ".$this->currentPage." / ".$this->totalPage;
                    ?>
                </div>

                <div class = "pre-page">
                    <a href = "<?php
                                if(isset($_GET['p']))
                                {
                                    $temp = 'p='.($_GET['p'] - 1);
                                }
                                    else $temp = 'p=2';

                                echo $lib->addVarToURL($temp) ?>"><img src = '../Images/pre-page.png'></a>
                </div>
            </div><!-- End of order -->


            <div class = "list-text-holder">
                <div class = "list">
                    <?php

                        if(!$this->query)
                            echo mysql_error();
                        else{
                            if($this->totalItem != 0)               //t/h có mặt hàng
                            {
                                $start = $this->currentView * ($this->currentPage - 1);
                                if($this->currentPage == $this->totalPage && ($this->currentView * $this->currentPage > $this->totalItem))
                                    $end = $start + $this->totalItem - $this->currentView * ($this->currentPage - 1);
                                else
                                    $end = $start + $this->currentView;


                                for($i = $start; $i < $end; $i++)
                                {
                                    $name = mysql_result($this->query, $i, "name");
                                    $price = mysql_result($this->query, $i, "price");
                                    $id = mysql_result($this->query, $i, "id");
                                    $sale = mysql_result($this->query, $i, "sale");
                                    $this->displayItem($name, $price, $id, $sale);
                                }
                            }
                            else{
                                echo "No item found";
                            }
                        }
                    ?>
                </div><!-- End of list -->
            </div><!-- End of list-text-hoder -->


        </div><!-- End of rightbar -->
        </div><!-- End of inner -->
    <?php
        include_once "../views/footer.php";
    ?>

    
    <script scr = "lib.js" type="text/javascript">

        //-------------Sét màu cho vùng chọn hiển thị số sp/trang------
        var varInURL = getUrlVars()["pp"];
        var k1 = document.getElementsByClassName("current-view");

        if(varInURL === undefined) {
            k1[0].style.color = "red";
        } else {
            for(var i = 0; i < k1.length; i++) {
                if(varInURL == k1[i].innerHTML) {
                    k1[i].style.color = "red";
                }
            }
        }

        //hiên thị nút pre-page
        var prePage = document.getElementsByClassName("pre-page");
        var nextPage = document.getElementsByClassName("next-page");

        if(currentPage == 1)
            prePage[0].style.display = "none";
        else
            prePage[0].style.display = "block";

        if(currentPage == totalPage)
            nextPage[0].style.display = "none";
        else
            nextPage[0].style.display = "block";
        //----------------------------DONE---------------------------------


        initFilter();

        //------------------------reset filter---------------------------
        function resetFilter()
        {
            var url = document.URL;             //Lấy uri
            var parts = url.split("?");         //chia theo ký tự ?
            window.location.href = parts[0];   
            return false;
        }
        
        //--------------------------------------------------------------
    </script>
    <?php

    }




    private function displayItem($name = '', $price = '', $id = '', $sale = '')
    {
        echo "<div class = 'list-item'>";
        echo "  <div class = 'detail-item'>";
        echo "      <div class = 'icon'>";
        echo "          <img src = '../Images/concave.png'>";
        echo "      </div><!--End of icon-->";
        echo "      <div class = 'name'>";
        echo "          PRO BOOT";
        echo "      </div><!--End of name-->";
        echo "      <div class = 'image-product'>";
                            $temp = $this->clean($name);
                            $temp .= "-".$id;
        echo "          <a href = '".SITE."controls/productcontrol.php?name=".$temp."'><img src = ".SITE.'Images/product/Chinh/'.$id.'.jpg'." alt = 'Images' width = '100%' height = '150px'></a>";
        if($sale != 0) {
            echo "          <div class = 'sale'>".'-'.$sale.'%'."</div>";
        }
        echo "      </div>";
        echo "      <div class = 'detail-product'>";
        echo "          <a href = '#'>" . $name . "</a>";
        echo "      </div>";
        echo "      <div class = 'price'>";
        echo "          PRO Online Price<br>";
        echo "          <span>&pound;" . $price . ".00</span>";
        echo "      </div>";

        echo "  </div><!--End of detail item-->";
        echo "</div><!--End of item--> ";
    }

    private function clean($string) {
        $string =  preg_replace('/\//', ' ', $string); // Thay dấu / bằng space
        $string =  preg_replace('/-/', ' ', $string); // Thay dấu - bằng space
        $string = preg_replace('/\s\s+/', ' ', $string); //xóa space thừa
        $string =  preg_replace('/ /', '-', $string);       //Thay thế space bằng dấu -
        return $string;
    }
}
?>