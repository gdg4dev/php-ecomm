<?php
include_once 'functions/functions.php';
?>
<!-- header -->
<?php include_once 'includes/header.php'; ?>
<!-- Page Content Holder -->
<?php include_once 'includes/main-content.php'; ?>
<div class='container-fluid p-0'>
    <form action="" method="post">
 
        <table class='table' border="1">
            <thead class='thead-dark'>
                <tr align="center">
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                
                <?php $notRequired = 0; cartItemList($notRequired); ?>

            </tbody>
        </table>
        <div class="d-flex btnList">
        <a href="index.php"><button class="btn btn-primary">Continue Shopping</button></a>
        <a><input type='submit' name="update" class="btn btn-info p-b-0" value="Update Cart"></a>
        <a href="checkout.php"><button class="btn btn-success">Chekout</button></a>
    </div>
 
    </form>

 

    <?php
  onUpdateRemoveItemFromCart();
  onUpdateCalculatePrice();
    ?>
</div>
<br>
<br>

<!-- footer -->
<?php include_once 'includes/footer.php' ?>