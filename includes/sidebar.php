<div class="container-fluid container-middle-cnt p-0 ">
    <div class="col-md-12 p-0">
        <div class="wrapper d-flex">
            <nav id="sidebar">
                <ul class="list-unstyled components " id="test">
                    <div class="head-side-bar-x">
                        <p><b style="letter-spacing: 1px; font-size: 1.2em">Categories &nbsp;
                            </b></p>
                        <span id="dismiss" class=" float-right">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                    </div>
                    <?php
                    fetchCategories();
                    ?>
                    <div class="head-side-bar-x head-sidebar-brand">
                        <p><b style="letter-spacing: 1px; font-size: 1.2em">Brands &nbsp;
                            </b></p>
                    </div>
                    <?php
                    fetchBrands();
                    ?>
                </ul>
            </nav>