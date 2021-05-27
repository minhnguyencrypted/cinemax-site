<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . '/php/API/data_loader/file_parser.php');

    define('STORES_DATA_FILE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/data/stores.csv');
    define('PRODUCTS_DATA_FILE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/data/products.csv');
    define('CATEGORIES_DATA_FILE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/data/categories.csv');


    $products = read_all_file(PRODUCTS_DATA_FILE_PATH);
    $stores = read_all_file(STORES_DATA_FILE_PATH);
    $categories = read_all_file(CATEGORIES_DATA_FILE_PATH);


    //get the store id
    $store_id = $_GET['id'] ?? '';
    
    //Get featured products
    $featured_products = [];
    foreach($products as $product) {
        if($product['store_id'] == $store_id && $product['featured_in_store'] == TRUE && count($featured_products) < 5) {
            $featured_products[] = $product;
        }
    }

    //get the sorted by time products
    
    $filtered_products = [];
    foreach ($products as $product) {
        if (match_object_by_value($product,$store_id,'store_id')) {
            $filtered_products[] = $product;
        }
    }
    $sorted_by_date_products = sort_by_category($filtered_products, 'created_time', false);
    
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <link rel="stylesheet" href="store_dt_style.css">
    <link rel="stylesheet" href="Thinh_Cookies_Style/cookies_banner_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>


<body>

    <header id="header">
        
        <div class="home_store_header home_store_header_fl_item">
            <div class="wrapper">
                <nav>
                    <a href="store_dt.html">Home</a>
                    <a href="/aboutus.html">About Us</a>
                    <a href="/THE_MAIN_PAGE/productpage/index.html">Products</a>
                    <a href="/contact.html">Contacts</a>
                </nav>
                <div class="logo">
                    <picture>
                        <source srcset="../../pictures/store_img/nike.png" media="(max-width: 400px" )>
                        <source srcset="../../pictures/store_img/nike.png">
                        <a href="store_dt_style.html">
                            <img src="../../pictures/store_img/nike.png" alt="Logo store">
                        </a>
                    </picture>    
                </div>

            </div>
        </div>


    </header>

    <h1 class='store_name'>
        <?=$stores[$store_id - 1]['name']?>

    </h1>


    <main id="main_section">
        <article>
            <section>
                <div class="sub_title">
                    <h1>New Products</h1>
                </div>
                <div class="new-product-section">


                    <?php
                        for($i =0; $i < 5; $i++) {
                    ?>

                    <div class="new-items">

                        <a href="../../pictures/store_img/adidas.png">

                            <img src="product_img/foobar.png" class="new-items-img" alt="<?= $sorted_by_date_products[$i]['name']?> image">
                            <h2 class="new-items-title">
                                <?=$sorted_by_date_products[$i]['name']?>
                            </h2>

                        </a>

                        <h3 class="new-items-price">$ <?=$sorted_by_date_products[$i]['price']?></h3>

                        <a href="bmwr1250gsa.html">

                            <div class="new-items-button">

                                <p class="button-name">View product</p>

                            </div>

                        </a>

                        <div class="items-details">
                            <p>Store: <?=$stores[$sorted_by_date_products[$i]['store_id']-1] ['name'] ?></p>
                        </div>
                        <div class="">
                            <p>Created Time: <?=$sorted_by_date_products[$i]['created_time']?></p>
                        </div>
                        
                    </div>
                    <?php
                         }

                    ?>
                </div>   

                
                
                


                 
                <div class="sub_title">
                    <h1>Featured Products</h1>
                </div>

                <div class="new-product-section">
                    <?php
                        foreach($featured_products as $product) {

                    ?>

                    <div class="new-items">

                        <a href="../../pictures/store_img/adidas.png">

                            <img src="product_img/foobar.png" class="new-items-img" alt="Foobar image">
                            <h2 class="new-items-title">
                                <?=$product['name']?>
                            </h2>

                        </a>

                        <h3 class="new-items-price">$ <?=$product['price']?></h3>

                        <a href="bmwr1250gsa.html">

                            <div class="new-items-button">

                                <p class="button-name">View product</p>

                            </div>

                        </a>

                        <div class="items-details">
                            <p>Store: <?=$stores[$product['store_id'] - 1] ['name'] ?></p>
                        </div>
                        
                    </div>
                    <?php
                         }

                    ?>

                </div>


            </section>
        </article>
    </main>
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


    <footer id="footer">
        <div class="footer1">
            <ul>
            <div class="footer_content">
    
                <div class="footer_content_policies">
                    <li>
                    <p><a href="/term_of_service.html">Terms Of Services</a>
                    </p>
                    </li>
                    
                    <br><br>
                </div>
    
                <div class="footer_content_faq">
                    <li>
                    <p><a href="/faq.html">FAQ</a>
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





</body>
<script src="Thinh_JS_Files/cookies_banner.js" defer></script>

</html>