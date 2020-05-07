<?php
if (isset($_GET['search'])) {
    include_once 'functions/functions.php';
    ?>
    <!-- header -->
    <?php include_once 'includes/header.php'; ?>
    <!-- Sidebar Holder -->
    <?php include_once 'includes/sidebar.php'; ?>
    <!-- Page Content Holder -->
    <?php include_once 'includes/main-content.php';

    $user_search_query = $_GET['user_query'];
    $searchProductsTrue = 'searchProductsTrue';
    getMainContent($searchProductsTrue, $user_search_query);

    ?>
    <!-- footer -->
    <?php include_once 'includes/footer.php';
} else if (!isset($_GET['user_query'])) {
    header('location: index.php');
} else {
    header('location: index.php');
}
?>