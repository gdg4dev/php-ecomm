<?php
include_once 'functions/functions.php';
?>
                <!-- header -->
                <?php include_once 'includes/header.php'; cart(); ?>
                <!-- Sidebar Holder -->
               <?php include_once 'includes/sidebar.php'; ?>
                <!-- Page Content Holder -->
                <?php include_once 'includes/main-content.php'; 
                 getMainContent(false,false);
                ?>
               
                <!-- footer -->
                <br>
                <?php include_once 'includes/footer.php'?>