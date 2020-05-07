<!-- // if(isset($_GET['product_id'])){

//     include_once 'includes/header.php';
   
//     include_once 'includes/sidebar.php';

//     include_once 'includes/main-content.php';


//     include_once 'includes/footer.php';

    

// } else {
//     header('location index.php');
// }
 -->

<?php include_once 'functions/functions.php' ?>
<?php include_once 'includes/header.php' ?>


<style>
    .proimages {
        display: flex;
        flex-direction: column;
    }

    .imageX {
        margin: 5px;
        height: 152px;
        width: 152px;
    }

    .middleImg {
        height: 481px;
        width: auto;
        max-width: 481px;
        padding-top: 5px;

    }

    .centerMainWAuto{
        min-width: 481px;
        max-width: 481px;
        margin-left: 30px;
        display: flex;
        justify-content: space-around;
    }

    .cfx {
        padding-top: 2%;
    }

    .main-d-area {
        padding-bottom: 2%;
    }

    .details-pro {
        margin: 1%;
        margin-left: 4%;
        flex-direction: column;
    }

</style>
<?php $allProducts = "detailsNeed";
$product_id = $_GET['product_id'];
if ($product_id === "searchProductsTrue") {
    echo "<script>window.location = index.php</script>";
} else {
    getPro($allProducts, $product_id);
}
?>

<script>
    var imgsrc1 = $('#img1').attr('src')
    var imgsrc2 = $('#img2').attr('src')
    var imgsrc3 = $('#img3').attr('src')

    $("#img1").click(function() {

        $("#mainimg").attr('src', imgsrc1)
    })
    $("#img2").click(function() {

        $("#mainimg").attr('src', imgsrc2)
    })
    $("#img3").click(function() {

        $("#mainimg").attr('src', imgsrc3)
    })
</script>
<?php include_once 'includes/footer.php' ?>