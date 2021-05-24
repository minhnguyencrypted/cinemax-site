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
            $featured_products[] = $product;
        }
    }
    //get the featured stores
    
    $featured_stores = [];
    foreach ($stores as $store) {
        if (match_object_by_value($store, 'TRUE', 'featured ') === true) {
            $featured_stores[] = $store;
        }
    }
    

    






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
        <li class="nav-list-item"><a href="my_account/my_account.html" id="my_account_button">My Account</a></li>
        <li class="nav-list-item"><a href="#">Browse</a></li>
        <li class="nav-list-item"><a href="faq.html">FAQs</a></li>
        <li class="nav-list-item"><a href="contact.html">Contact</a></li>
        <li class="nav-list-item"><a href="my_account/login.html">Login</a></li>
        <li class="nav-list-item"><a href="my_account/signup.html">Sign-up</a></li>
        <li class="nav-list-item"><a href="shopping_cart.html">Shopping Cart</a></li>

    </ul>
</div>
</header>

<body>
<div class="new-product-section">
    <h2 class="section-title">
        Featured Products
    </h2>

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
        </div>


    <?php

    }
    ?>

    

   
<!--THINH's STORE SECTION-->
    <div id="New_stores">

        <h1 class="h1_title fl_item">Featured Stores</h1>
        
        <?php
            foreach($featured_stores as $store) {
                
        ?>

        <div class="card">
            <img src="img_avatar.png" alt="Avatar" style="width:100%">
            <div class="card-info">
                <h4><b>
                    <?=$store['name']?>
                </b></h4>              
            </div>
        </div>

        <?php
            }
        ?>

        


    </div>

<div id="Featured_Stores">

    <h1 class="h1_title fl_item">New Stores</h1>

    <div class="Featured_Stores_Slider middle_imgs">

        <div class="slides">
            <input type="radio" id="ff1" name="ff" checked>
                <input type="radio" id="ff2" name="ff" >
                <input type="radio" id="ff3" name="ff" >
                <input type="radio" id="ff4" name="ff" >
            
                <div class="slide s1">
                    <div class="store_name store_name_fl_item">
                        <a href="pages/stores/store_dt.html" style="color:red">IKEA</a>
                    </div>
                    <picture>
                        <source srcset="pictures/store_img/ikea.jpg" media="(max-width: 400px" )>
                        <source srcset="pictures/store_img/ikea.jpg">
                        <a href="pages/stores/store_dt.html">
                            <img src="pictures/store_img/ikea.jpg" alt="First store">
                        </a>
                    </picture>    
                </div>


                <div class="slide">
                    <div class="store_name store_name_fl_item">
                        <a href="pages/stores/store_dt.html" style="color:red">Adidas</a>
                    </div>
                    <picture>
                        <source scrset="THE_MAIN_PAGE/Store/new_stores_images/image_7.png" media="(max-width: 400px")>
                        <source scrset="THE_MAIN_PAGE/Store/new_stores_images/image_7.png">
                        <a href="pages/stores/store_dt.html">
                            <img src="pictures/store_img/adidas.png" alt="Second store">
                        </a>
                    </picture>  
                </div>
                

                <div class="slide">
                    <div class="store_name store_name_fl_item">
                        <a href="pages/stores/store_dt.html" style="color:red">Nike</a>
                    </div>
                    <picture>
                        <source scrset="THE_MAIN_PAGE/Store/new_stores_images/image_8.png" media="(max-width: 400px")>
                        <source scrset="THE_MAIN_PAGE/Store/new_stores_images/image_8.png">
                        <a href="pages/stores/store_dt.html">
                            <img src="pictures/store_img/nike.png" alt="Third store">
                        </a>
                    </picture>    
                </div>


                <div class="slide">
                    <div class="store_name store_name_fl_item">
                        <a href="pages/stores/store_dt.html" style="color:red">Puma</a>
                    </div>
                    <picture>
                        <source scrset="THE_MAIN_PAGE/Store/new_stores_images/image_9.jpg" media="(max-width: 400px")>
                        <source scrset="THE_MAIN_PAGE/Store/new_stores_images/image_9.jpg">
                        <a href="pages/stores/store_dt.html">
                            <img src="pictures/store_img/puma.jpg" alt="Fourth store">
                        </a>
                    </picture>
                </div>

                <div class="navigation-auto">
                    <div class="auto-button1"></div>
                    <div class="auto-button1"></div>
                    <div class="auto-button1"></div>
                    <div class="auto-button1"></div>
                </div>

            </div>
        </div>

        <div class="navigation">

            <label for="ff1" class="bar"></label>
            <label for="ff2" class="bar"></label>
            <label for="ff3" class="bar"></label>
            <label for="ff4" class="bar"></label>
        
        </div>


    </div>
<div class="new-product-section">
    <h2 class="section-title">
        Featured Products
    </h2>

    <div class="new-items">
        <a href="pages/products/reclassic500.html">
            <div>
                <img src="pictures/product_img/foo.png" class="new-items-img" alt="Foo image">
                <h2 class="new-items-title">
                    Royal Enfield Classic 500
                </h2>
            </div>
        </a>
        <h3 class="new-items-price">VND 120,000,000</h3>
        <a href="pages/products/reclassic500.html">
            <div class="new-items-button">
                <p class="button-name">View product</p>
            </div>
        </a>
        <div class="items-details">
            <p>Store: Royal Enfield Vietnam</p>
        </div>
    </div>

    <div class="new-items">
        <a href="pages/products/trtiger900gtp.html">
            <img src="pictures/product_img/bar.png" class="new-items-img" alt="Bar image">
            <h2 class="new-items-title">
                Triumph Tiger 900 GT Pro
            </h2>
        </a>
        <h3 class="new-items-price">VND 469,000,000</h3>
        <a href="pages/products/trtiger900gtp.html">
            <div class="new-items-button">
                <p class="button-name">View product</p>
            </div>
        </a>
        <div class="items-details">
            <p>Store: Triumph Motorcycles Vietnam</p>
        </div>
    </div>

    <div class="new-items">
        <a href="pages/products/yamahatracer900gt2021.html">
            <img src="pictures/product_img/foobar.png" class="new-items-img" alt="Foobar image">
            <h2 class="new-items-title">
                Yamaha Tracer 900 GT (2021)
            </h2>
        </a>
        <h3 class="new-items-price">VND 349,000,000</h3>
        <a href="pages/products/yamahatracer900gt2021.html">
            <div class="new-items-button">
                <p class="button-name">View product</p>
            </div>
        </a>
        <div class="items-details">
            <p>Store: Yamaha Vietnam Racing</p>
        </div>
    </div>
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