<?php


$actual_link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";


checkQueryContainsScriptTag($actual_link);


function getUserIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

if (substr($actual_link, -3) === "%27" || substr($actual_link, -1) === "'") {
    $user_ip = getUserIP();
    echo "<script>alert('Hacking Attempt! Your IP Address $user_ip is now being traced!')</script>";
    die();
}

function checkQueryContainsScriptTag($queryForChecking)
{
    if (strpos($queryForChecking, 'script%3E') == true || strpos($queryForChecking, '%3E') ||  strpos($queryForChecking, '%3C') || strpos($queryForChecking, '%3C%2F')) {
        $user_ip = getUserIP();
        echo "<script>alert('Wooah, Hacking Attempt Detected from IP $user_ip ')</script>";
        die();
    }
}

$conn =  mysqli_connect('localhost', 'root', '', '132002_easy_commerce');

function getPro($allProducts, $user_search_query)
{

    if ($allProducts === false) {
        $get_products = "select * from products order by rand() limit 6";
    } else if ($allProducts === 'searchProductsTrue') {
        $get_products = "select * from products where product_keywords like '%" . $user_search_query . "%' or product_title like '%" . $user_search_query . "%';";
    } else if ($allProducts === 'detailsNeed') {
        $get_products = "select * from products where product_id = $user_search_query";
    } else {
        $get_products = "select * from products";
    }

    global $conn;
    if (!isset($_GET['cat'])) {
        if (!isset($_GET['brand'])) {

            $get_pro = mysqli_prepare($conn, $get_products);

            $get_pro->execute();
            $result = $get_pro->get_result();
            $count_row_pro = 0;
            if ($result)
                $count_row_pro = mysqli_num_rows($result);

            if ($count_row_pro === 0) {
                echo "No Products Found For Search \"$user_search_query\" ";
            } else
                while ($row_product = mysqli_fetch_assoc($result)) {
                    $pro_id = $row_product['product_id'];
                    $pro_title = $row_product['product_title'];
                    $pro_price = $row_product['product_price'];
                    $pro_desc = $row_product['product_desc'];
                    $pro_image = $row_product['product_img1'];
                    if ($allProducts === 'detailsNeed') {
                        $pro_image1 = $row_product['product_img1'];
                        $pro_image2 = $row_product['product_img2'];
                        $pro_image3 = $row_product['product_img3'];
                        proDetails($pro_id, $pro_title, $pro_price, $pro_desc, $pro_image1, $pro_image2, $pro_image3);
                    } else {
                        echoProducts($pro_id, $pro_title, $pro_price, $pro_desc, $pro_image);
                    }
                }
        } else {
            getBrandPro();
        }
    } else {
        getCatPro();
    }
}

function proDetails($pro_id, $pro_title, $pro_price, $pro_desc, $pro_image1, $pro_image2, $pro_image3)
{
    echo "    <div class='container-fluid cfx'>
    <div class='col-md-12 d-flex main-d-area'>
        <div class='proimages d-flex'>
            <img src='admin_area/product_images/$pro_image1' id='img1' class='imageX'>
            <img src='admin_area/product_images/$pro_image2' id='img2' class='imageX'>
            <img src='admin_area/product_images/$pro_image3' id='img3' class='imageX'>
        </div>
        <div class='centerMainWAuto'>
        <img src='admin_area/product_images/$pro_image1' id='mainimg' class='middleImg'>
        </div>
        <div class='details-pro d-flex'>
            <h2>$pro_title</h2>
            <p>Price &#36;$pro_price</p>
         <div>   <a href='index.php'><div class='btn btn-outline-info'>GO BACK</div></a>
         <a href='index.php?add_cart=$pro_id'><div class='btn btn-success'> ADD TO CART</div></a></div>
            <p>$pro_desc</p>
        </div>
    </div> </div>";
}

function  echoProducts($pro_id, $pro_title, $pro_price, $pro_desc, $pro_image)
{
    echo "<div class='col-sm-4'>
    <a href='details.php?product_id=$pro_id'>
               <div class='product-card'>
                   <div class='card-thumbnail'>
                       <img class='card-img-top' align='middle' src='admin_area/product_images/$pro_image'>
                   </div>
                   
                   <div class='card-content'>
                   <a href='index.php?add_cart=$pro_id' class='send' style='position:absolute !important;'><i class='fa fa-cart-plus' style='color:white' id='addcart' aria-hidden='true'></i></a></a>
                   <a href='details.php?product_id=$pro_id'>
        
                       <h1 class='card-title'>
                           $pro_title
                       </h1>
                       <h2 class='card-sub-title'>
                           Vijaya Comnet Private
                       </h2>
                       <p class='description'>
                    
                       </p>
                       
                       <p>Price &#36;$pro_price</p>
                       <ul class='list-inline post-meta'>
                           <li class='time-stamp'>
                               <i class='fa fa-clock-o'></i> 60 mins left on this price
                           </li>
                           <li class='card-comment'>
                               <i class='fa fa-comments'></i><a href='#'> 39 reviews
                           </li>
                       </ul>
                   </div>
               </div>
           </div></a>";
}

function  getBrandPro()
{
    global $conn;
    if (isset($_GET['brand'])) {
        $brand_pro_id = $_GET['brand'];
        $get_brand_pro = mysqli_prepare($conn, "select * from products where brand_id = ?");
        $get_brand_pro->bind_param('s', $brand_pro_id);
        $get_brand_pro->execute();
        $result = $get_brand_pro->get_result();
        $count_row_brand_pro = mysqli_num_rows($result);

        if ($count_row_brand_pro === 0) {
            echo "No Products Found";
        } else {
            while ($row_brand_pro = mysqli_fetch_array($result)) {
                $pro_id = $row_brand_pro['product_id'];
                $pro_title = $row_brand_pro['product_title'];

                $pro_desc = $row_brand_pro['product_desc'];
                $pro_price = $row_brand_pro['product_price'];
                $pro_image = $row_brand_pro['product_img1'];
                echoProducts($pro_id, $pro_title, $pro_price, $pro_desc, $pro_image);
            }
        }
    }
}

function getCatPro()
{
    global $conn;
    if (isset($_GET['cat'])) {
        $cat_pro_id = $_GET['cat'];
        $get_cat_pro = mysqli_prepare($conn, "select * from products where cat_id = ?");
        $get_cat_pro->bind_param('s', $cat_pro_id);
        $get_cat_pro->execute();
        $result = $get_cat_pro->get_result();
        // $run_cat_pro = mysqli_query($conn, $get_cat_pro);
        // $errror = mysqli_error($conn);
        // echo "$errror";

        $count_row_cat_pro = mysqli_num_rows($result);

        if ($count_row_cat_pro === 0) {
            echo "No Products Found";
        } else {
            while ($row_cat_pro = $result->fetch_assoc()) {
                $pro_id = $row_cat_pro['product_id'];
                $pro_title = $row_cat_pro['product_title'];
                $pro_desc = $row_cat_pro['product_desc'];
                $pro_price = $row_cat_pro['product_price'];
                $pro_image = $row_cat_pro['product_img1'];
                $pro_desc_first_few_letters = substr($pro_desc, 0, 10);

                echoProducts($pro_id, $pro_title, $pro_price, $pro_desc, $pro_image);
            }
        }
    }
}

function fetchCategories()
{
    global $conn;

    $get_cats = "select * from categories ORDER by cat_title ASC";
    $run_cats = mysqli_query($conn, $get_cats);

    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];
        echo "   <li>
       <a href ='index.php?cat=$cat_id' class='center-text'>$cat_title</a>
         </i>";
    }
}

function fetchBrands()
{
    global $conn;
    $get_brands = "SELECT * FROM brands ORDER by brand_title ASC";

    $run_brands = mysqli_query($conn, $get_brands);

    while ($row_brands = mysqli_fetch_array($run_brands)) {
        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];
        echo "<li> <a href='index.php?brand=$brand_id' class='center-text'>$brand_title</a> </li>";
    }
}


function cart()
{
    global $conn;
    $ip_add = getUserIP();
    if (isset($_GET['add_cart'])) {
        $p_id = $_GET['add_cart'];

        $CHECK_pro = mysqli_prepare($conn, "SELECT * FROM cart WHERE ip_add= ? AND p_id= ?");
        $CHECK_pro->bind_param('ss', $ip_add, $p_id);
        $CHECK_pro->execute();
        $result = $CHECK_pro->get_result();

        // $check_pro = "SELECT * FROM cart WHERE ip_add='$ip_add' AND p_id='$p_id'";
        // $run_check = mysqli_query($conn, $check_pro);

        if (mysqli_num_rows($result) > 0) {
            echo "";
        } else {
            $q = "INSERT INTO cart(p_id,ip_add) VALUES('$p_id','$ip_add')";
            $run_q = mysqli_query($conn, $q);
            if ($run_q) {
                echo "<script>window.open('index.php','_self')</script>";
            }
        }
    }
}


function cartItems()
{
    global $conn;
    $ip_add = getUserIP();
    $cart_items_pro = mysqli_prepare($conn, "select * from cart where ip_add= ?");
    $cart_items_pro->bind_param('s', $ip_add);
    $cart_items_pro->execute();
    $result = $cart_items_pro->get_result();
    // $get_items = "select * from cart where ip_add='$ip_add'";
    // $run_items = mysqli_query($conn, $get_items);
    $count_items = mysqli_num_rows($result);
    echo $count_items;
}

function cart_pro_price()
{
    global $conn;
    $ip_add = getUserIP();
    $total = 0;
    // $get_record_p = "select * from cart where ip_add = '$ip_add'";
    // $run_record_p = mysqli_query($conn,$get_record_p);
    $get_record_p = mysqli_prepare($conn, "select * from cart where ip_add= ?");
    $get_record_p->bind_param('s', $ip_add);
    $get_record_p->execute();
    $result_records_p = $get_record_p->get_result();
    while ($records = mysqli_fetch_assoc($result_records_p)) {
        $pro_id = $records['p_id'];
        // $get_cart_price = "select product_price from products where product_id='$pro_id'";
        // $run_cart_price = mysqli_query($conn,$get_cart_price);
        $get_cart_price = mysqli_prepare($conn, "select product_price from products where product_id= ?");
        $get_cart_price->bind_param('s', $pro_id);
        $get_cart_price->execute();
        $result_cart_price = $get_cart_price->get_result();
        while ($price = mysqli_fetch_assoc($result_cart_price)) {
            $product_cartTotalPrice = array($price['product_price']);
            $values = array_sum($product_cartTotalPrice);
            $total += $values;
        }
    }
$finalprice= "finalprice";
$cartFinalPrice = cartItemList($finalprice);
if($cartFinalPrice === null){
    echo "0";
} else
echo $cartFinalPrice;   
}

function cartItemList($required)
{
    global $conn;
    $ip_add = getUserIP();
    $total = 0;
    // $get_record_p = "select * from cart where ip_add = '$ip_add'";
    // $run_record_p = mysqli_query($conn,$get_record_p);
    $get_record_p = mysqli_prepare($conn, "select * from cart where ip_add= ?");
    $get_record_p->bind_param('s', $ip_add);
    $get_record_p->execute();
    $result_records_p = $get_record_p->get_result();
    while ($records = mysqli_fetch_assoc($result_records_p)) {
        $pro_id = $records['p_id'];
        // $get_cart_price = "select product_price from products where product_id='$pro_id'";
        // $run_cart_price = mysqli_query($conn,$get_cart_price);
        $get_cart_price = mysqli_prepare($conn, "SELECT * from products where product_id = ? order by product_title asc");
        $get_cart_price->bind_param('s', $pro_id);
        $get_cart_price->execute();
        $result_cart_price = $get_cart_price->get_result();
        while ($recordList = mysqli_fetch_assoc($result_cart_price)) {
            $productItemPrice = $recordList['product_price'];
            $pro_title = $recordList['product_title'];
            $pro_img = $recordList['product_img1'];
            if($required === 0){
            echo "<tr align='center'>
                        <th>$pro_title<br><br><img height='100' src='admin_area/product_images/$pro_img'></th>";
            }

            $get_cart_main_price = mysqli_prepare($conn, "select * from cart where p_id = ? and ip_add = ?");
            $get_cart_main_price->bind_param('ss', $pro_id, $ip_add);
            $get_cart_main_price->execute();
            $result_cart_main_price = $get_cart_main_price->get_result();
            while ($res = mysqli_fetch_assoc($result_cart_main_price)) {
                $qtyCart = $res['qty'];
                $mainPrice = $productItemPrice * $qtyCart;
                $i = 0;
                for($i;$i<=0;$i++){
                    $resx[] = $mainPrice;
                }
              if($required === 0){
                echo "<th> $$productItemPrice </th><th><input type='number' value='$qtyCart' name='qty' class='input' min='1'><input name='idPro' value='$pro_id' hidden></th>";
              }
            }
          if ($required === 0) {
            echo "<th><input type='checkbox' class='checkbox input' name='remove[]'value='$pro_id'></th>
            </tr>";
          }
        }
    }
  
if(isset($resx)){
    if($required === "finalprice"){
        $ax = array_sum($resx); 
        return $ax;
      } else {
          return "0";
      }
}}



function onUpdateRemoveItemFromCart()
{
    global $conn;
    if (isset($_POST['update'])  && isset($_POST['remove'])) {
        foreach ($_POST['remove'] as $remove_id) {
            $delete_products = "delete from cart where p_id='$remove_id'";
            $run_delete = mysqli_query($conn, $delete_products);
            echo mysqli_error($conn);

            if ($run_delete) {
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    }
}

function onUpdateCalculatePrice()
{
    global $conn;
    $user_ip = getUserIP();
    if (isset($_POST['update'])) {
        $qty = $_POST['qty'];
        $p_id = $_POST['idPro'];
        $insert_qty =  mysqli_prepare($conn, 'update cart set qty = ? where ip_add = ? and p_id = ?');
        $insert_qty->bind_param('sss', $qty, $user_ip, $p_id);
        $insert_qty->execute();
        // if ($insert_qty) {
        //     echo "<script>window.open('cart.php','_self')</script>";
        // }
    }
}
