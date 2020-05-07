<?php

include_once 'includes/db.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .form-group {
            margin-bottom: 15px;
        }

        .custom-file {
            margin-bottom: 15px;
        }

        .tox-statusbar {
            visibility: hidden !important;
            display: none !important;
        }
    </style>
    <script src="https://cdn.tiny.cloud/1/5sfr2cd9t4nz1h9sofeclu17k6cgule1enk9x2isgg6r6f1q/tinymce/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea'
        });
    </script>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="container">
            <h2>INSERT PRODUCT</h2>
            <hr>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="formGroupExampleInput">Product Name</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" name="product_title" placeholder="Product Name">
                </div>
                <div class="form-group">
                    <label for="product_cat">Product Category</label>
                    <select name="product_cat" id="product_cat" class="form-control">
                        <option>Select a Category</option>
                        <?php

                        $get_cats = "select * from categories";

                        $run_cats = mysqli_query($conn, $get_cats);

                        while ($row_cats = mysqli_fetch_array($run_cats)) {
                            $cat_id = $row_cats['cat_id'];
                            $cat_title = $row_cats['cat_title'];
                            echo "<option value='$cat_id'>$cat_title</option>";
                        }

                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_brand">Product Brand</label>
                    <select name="product_brand" id="product_brand" class="form-control">
                        <option>Select a Brand</option>
                        <?php

                        $get_brands = "select * from brands";

                        $run_brands = mysqli_query($conn, $get_brands);

                        while ($row_brands = mysqli_fetch_array($run_brands)) {
                            $brand_id = $row_brands['brand_id'];
                            $brand_title = $row_brands['brand_title'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }

                        ?>
                    </select>
                </div>
                <div class="image_upload">
                    <label for="product_image_upload">Upload Pictures of Product</label>
                    <div class="form-group" id="product_image_upload">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img1" id="customFile">
                            <label class="custom-file-label" id="custom-file-label" for="customFile">Choose Product Image 1</label>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img2" id="customFile1">
                            <label class="custom-file-label" id="custom-file-label1" for="customFile1">Choose Product Image 2</label>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img3" id="customFile2">
                            <label class="custom-file-label" id="custom-file-label2" for="customFile2">Choose Product Image 3</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput4">Product Price</label>
                    <input type="number" class="form-control" name="product_price" id="formGroupExampleInput4" placeholder="Product Price">
                </div>
                <div class="form-group">
                    <label for="product_desc">Product Description</label>
                    <textarea class="form-control" id="product_desc" name="product_desc" rows="3" placeholder="Product Description Here.."></textarea>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput6">Product Keywords</label>
                    <input type="text" class="form-control" name="product_keywords" id="formGroupExampleInput6" placeholder="Product Keywords">
                </div>
                <button type="submit" class="btn btn-primary" name="insert_product">Add Product</button>

            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $('#customFile').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('#custom-file-label').html(fileName);
        })
        $('#customFile1').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('#custom-file-label1').html(fileName);
        })
        $('#customFile2').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('#custom-file-label2').html(fileName);
        })
    </script>
</body>

</html>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['insert_product'])) {



        if (isset($_POST['product_title']) && file_exists($_FILES['img1']['tmp_name']) &&  file_exists($_FILES['img2']['tmp_name']) &&  file_exists($_FILES['img3']['tmp_name']) && isset($_POST['product_cat']) && isset($_POST['product_brand']) && isset($_POST['product_price']) && isset($_POST['product_desc']) && isset($_POST['product_keywords'])) {
            //text data
            $product_title = $conn->real_escape_string($_POST['product_title']);
            $product_cat = $conn->real_escape_string($_POST['product_cat']);
            $product_brand = $conn->real_escape_string($_POST['product_brand']);
            $product_price = $conn->real_escape_string($_POST['product_price']);
            $product_desc = $conn->real_escape_string($_POST['product_desc']);
            $status = 'on';
            $product_keywords = $conn->real_escape_string($_POST['product_keywords']);

            //images
            $product_img1 = $_FILES['img1']['name'];
            $product_img2 = $_FILES['img2']['name'];
            $product_img3 = $_FILES['img3']['name'];

            //images temp name
            $temp_img_name1 = $_FILES['img1']['tmp_name'];
            $temp_img_name2 = $_FILES['img2']['tmp_name'];
            $temp_img_name3 = $_FILES['img3']['tmp_name'];

            move_uploaded_file($temp_img_name1, "product_images/$product_img1");
            move_uploaded_file($temp_img_name2, "product_images/$product_img2");
            move_uploaded_file($temp_img_name3, "product_images/$product_img3");
            $insert_product = "insert into products (cat_id,brand_id,date,product_title,product_img1,product_img2,product_img3,product_price,product_desc,product_keywords,status) values ('$product_cat','$product_brand',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','$product_keywords','$status')";
            $run_product = mysqli_query($conn, $insert_product);

            if ($run_product) {
                echo "<script>alert('product added successfully')</script>";
                die();
            } else {
                 echo "<script>alert('something went wrong!')</script>";
                $errror = mysqli_error($conn);
                if (!$run_product) {
                    echo $errror;
                    die();
                }
               
              
            }
        } else {
            echo "<script>alert('All Fields Are Required!')</script>";
            die();
        }
    }
}

?>