<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . '/php/API/data_loader/file_parser.php');

    // define the const
    define('STORES_DATA_FILE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/data/stores.csv');
    define('PRODUCTS_DATA_FILE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/data/products.csv');
    define('CATEGORIES_DATA_FILE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/data/categories.csv');


    $products = read_all_file(PRODUCTS_DATA_FILE_PATH);
    $stores = read_all_file(STORES_DATA_FILE_PATH);
    $categories = read_all_file(CATEGORIES_DATA_FILE_PATH);


    //get the featured products
    $featured_products = [];
    foreach ($products as $product) {
        if (match_object_by_value($product,'TRUE','featured_in_mall')) {
            if(count($featured_products) < 10) {
                $featured_products[] = $product;
            }
            
        }
    }
    //get the featured stores
    
    $featured_stores = [];
    foreach ($stores as $store) {
        if (match_object_by_value($store, 'TRUE', 'featured') === true) {
            if(count($featured_stores) < 10) {
                $featured_stores[] = $store;
            }
        }
    }
    

    //get the sorted by time stores
    $sorted_by_date_stores = sort_by_category($stores, 'created_time', false);

    //get the sorted by time products
    $sorted_by_date_products = sort_by_category($products, 'created_time', false);

   


    
    

?>


<!DOCTYPE html>
<html lang="en-US">
<head>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/cookies_banner_style.css">
    <link href="css/products.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="mainjs.js"></script>
</head>

<title>Foo Mall</title>

<!-- Set page logo here -->
<header id="header_main">
<div class="logo">
    <h1>Mall-site</h1>
</div>
<!-- Navigation bar -->
<div class="nav">
    <ul class="nav-list">
        <li class="nav-list-item"><a href="index.html">Home</a></li>
        <li class="nav-list-item"><a href="aboutus.html">About Us</a></li>
        <li class="nav-list-item"><a href="fees.html">Fees</a></li>
        <li class="nav-list-item"><a href="my_account/my_account.php" id="my_account_button">My Account</a></li>
        <li class="nav-list-item"><a href="#">Browse</a></li>
        <li class="nav-list-item"><a href="faq.html">FAQs</a></li>
        <li class="nav-list-item"><a href="contact.html">Contact</a></li>
        <li class="nav-list-item"><a href="my_account/login.php">Login</a></li>
        <li class="nav-list-item"><a href="my_account/signup.html">Sign-up</a></li>
        <li class="nav-list-item"><a href="shopping_cart.html">Shopping Cart</a></li>

    </ul>
</div>
</header>

<body>
<div class="new-product-section">
    <h1 class="h1_title fl_item">
        Featured Products
    </h1>

    <?php

    foreach($featured_products as $product) {

    ?>

        <div class="new-items">
            <a href="pages/products/rehimalayan.html">
                <div>
                    <img src="pictures/product_img/foo.png" class="new-items-img" alt="Foo image">
                    <h2 class="new-items-title">
                        <?=$product['name']?>
                    </h2>
                </div>
            </a>
            <h3 class="new-items-price">$ <?=$product['price']?></h3>
            <a href="pages/products/rehimalayan.html">
                <div class="new-items-button">
                    <p class="button-name">View product</p>
                </div>
            </a>
            <div class="items-details">
                <p>Store: <?=$stores[$product['store_id']]['name']?></p>
            </div>
            <div class="">
                 Created Time: <?=$product['created_time']?>
            </div>
        </div>


    <?php

    }
    ?>

    

   
<!--THINH's STORE SECTION-->
    <div id="New_stores">

        

        


    </div>

    <div id="Featured_Stores">

        <h1 class="h1_title fl_item">Featured Stores</h1>

        <?php
            foreach($featured_stores as $store) {
                
        ?>

        <div class="card">
        <img src="pictures/product_img/foo.png" alt="Avatar" style="width:100%">
        <div class="container">
            <h4><b><?=$store['name']?></b></h4>
            <p>Created since: <?=$store['created_time']?></p>
        </div>
        </div>

        <?php
            }
        ?>


    </div>

    <div id="Featured_Stores">

        <h1 class="h1_title fl_item">New Store</h1>

        <?php
            for($i = 0; $i < 10; $i++) {
                
        ?>

        <div class="card">
        <img src="pictures/product_img/foo.png" alt="Avatar" style="width:100%">
        <div class="container">
            <h4><b><?=$sorted_by_date_stores[$i]['name']?></b></h4>
            <p><?=$sorted_by_date_stores[$i]['created_time']?></p>
        </div>
        </div>

        <?php
            }
        ?>


    </div>


<div class="new-product-section">
    <h1 class="h1_title fl_item">New Products</h1>
    <?php

    for($i = 0; $i < 10; $i++) {

    ?>

        <div class="new-items">
            <a href="pages/products/rehimalayan.html">
                <div>
                    <img src="pictures/product_img/foo.png" class="new-items-img" alt="Foo image">
                    <h2 class="new-items-title">
                        <?=$sorted_by_date_products[$i]['name']?>
                        
                        
                    </h2>
                </div>
            </a>
            <h3 class="new-items-price">$ <?=$sorted_by_date_products[$i]['price']?></h3>
            <a href="pages/products/rehimalayan.html">
                <div class="new-items-button">
                    <p class="button-name">View product</p>
                </div>
            </a>
            <div class="items-details">
                <p>Store: <?=$stores[$sorted_by_date_products[$i]['store_id'] - 1]['name']?></p>
            </div>
            <div class="">
                 Created Time: <?=$sorted_by_date_products[$i]['created_time']?>
            </div>
        </div>


    <?php

    }
    ?>

    
</div>
<!--//THINH's STORE SECTION-->


<!--THINH'S COOKIES BANNER-->

<div id="cookie">
    <div class="cookie-container">
        <p>My website uses cookies necessary for its basic functioning. By continuing browsing, you consent to my use of cookies and other technologies.</p>
        

        <button class="cookie-button">
            Okay
        </button>

        <a href="https://gdpr-info.eu/">Learn more</a>
    </div>
</div>

<!--//THINH'S COOKIES BANNER-->


</body>



<!--footer-->
<footer id="footer">
    <div class="footer1">
        <ul>
            <div class="footer_content">

                <div class="footer_content_policies">
                    <li>
                        <p><a href="term_of_service.html">Terms Of Service</a>
                </p>
                </li>
                
                <br><br>
            </div>

            <div class="footer_content_faq">
                <li>
                <p><a href="faq.html">FAQ</a>
                </p>
                </li> 
                <br></br>
            </div>
     
        </ul>
            <div class="copyright">
                <small>Copyright &copy; 2021, Nhat Dang Nguyen, Hien Cong Gia Nguyen, Minh Nhat Nguyen and Thinh Hung Huynh</small>

            </div>
        </div>
    
    </div>
</footer>
<!--//footer-->


<!--JS Scripts HERE-->
<script src="js/cookies_banner.js" defer></script>
<script src="js/new2.js" defer></script>
<script src="js/hien_nguyen.js"></script>

<!--JS Scripts END HERE-->
</html>