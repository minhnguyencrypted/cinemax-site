<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . '/php/API/data_loader/file_parser.php');

//    define('STORES_DATA_FILE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/data/stores.csv');
//    define('PRODUCTS_DATA_FILE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/data/products.csv');
//    define('CATEGORIES_DATA_FILE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/data/categories.csv');


//    $products = read_all_file(PRODUCTS_DATA_FILE_PATH);
//    $stores = read_all_file(STORES_DATA_FILE_PATH);
//    $categories = read_all_file(CATEGORIES_DATA_FILE_PATH);


    //get the product id
    $product_id = $_GET['id'] ?? '';
	$product = read_file_match_value(PRODUCTS_DATA_FILE_PATH,$product_id,'id');
	$product = $product[0] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="product_dt_style.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <meta charset="UTF-8">
    <!-- Change the web page title -->
    <title>Product Details</title>
    <link href="../products/css/productpage.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <header id="header_main">
        <title>Foo Mall</title>

        <!-- Set page logo here -->
        <div class="logo">
            <h1>Mall-site</h1>
        </div>
        <!-- Navigation bar -->
        <div class="nav">
            <ul class="nav-list">
                <li class="nav-list-item"><a href="/index.php">Home</a></li>
                <li class="nav-list-item"><a href="/aboutus.html">About Us</a></li>
                <li class="nav-list-item"><a href="/fees.html">Fees</a></li>
                <li class="nav-list-item"><a href="/my_account/my_account.php">My Account</a></li>
                <li class="nav-list-item"><a href="#">Browse</a></li>
                <li class="nav-list-item"><a href="/faq.html">FAQs</a></li>
                <li class="nav-list-item"><a href="/">Contact</a></li>
            </ul>
        </div>
    </header>
<?php
	if (empty($product)) {
		echo "<p>Product not found</p>";
	} else {
?>
		<div class="pInfo-frame">
			<div class="product-info">

				<h2 class="pTitle">
                    <?=$product['name']?>
				</h2>

				<div class="product-description">
					<p>
						A Boxer engine powered Adventure motorcycle<br>
						distributed by BMW Motorrad Vietnam<br> <br>
					</p>
					<ul>
						<li>Engine: 4-stroke, DOHC, 1258cc Twin Boxer with BMW ShiftCam technology</li>
						<li>Max Torque: 142.36Nm @ 6250RPM</li>
						<li>Max Power: 136HP @ 7750RPM</li>
						<li>Fuel capacity: 30 litres</li>
					</ul>

				</div>
				<p class="pPrice">$<?=$product['price']?></p>
				<div class="buy-button" >
                    <?php if(!isset($_SESSION['user_id']) == true) { ?> 
                        <a href="proceed to checkout"><p class="button-name">Buy Now</p></a>
                    <?php } else { ?>
                        <a href="proceed to register page"><p class="button-name">Buy Now</p></a>
                    <?php } ?>
                </div>
				<div class="add-button" onclick="buttonAddProduct()"><p class="button-name">Add</p></div>
			</div>
			<div>
				<img src="../../pictures/product_img/foobar.png" alt="Foobar product picture" class="product-img">
			</div>

			<div class="recommended-products">
				<h3 class="recommended-title">Recommended products</h3>
				<div class="recommended-items">
					<a href="trtiger850sport.html">
						<div class="item">
							<img src="../../pictures/product_img/bar.png" alt="Bar" style="object-fit: scale-down; height: 200px; width: auto;">
							<p class="item-name">Triumph Tiger 850 Sport</p>
						</div>
					</a>
					<a href="rehimalayan.html">
						<div class="item">
							<img src="../../pictures/product_img/foo.png" alt="Foo" style="object-fit: scale-down; height: 200px; width: auto;">
							<p class="item-name">Royal Enfield Himalayan</p>
						</div>
					</a>
				</div>
			</div>


		</div>
<?php
	}
?>

    <div class="footer">
        <ul>
            <div class="footer_content">

                <div class="footer_content_policies">
                    <li>
                        <p><a href="Thinh_policies.htmnl">Policies</a>
                        </p>
                    </li>

                    <br><br>
                </div>

                <div class="footer_content_faq">
                    <li>
                        <p><a href="Thinh_faq.html">FAQ</a>
                        </p>
                    </li>
                    <br></br>
                </div>
            </div>

        </ul>
        <div class="copyright">
            <small>Copyright &copy; 2021, Nhat Dang Nguyen, Hien Cong Gia Nguyen, Minh Nhat Nguyen and Thinh Hung Huynh</small>
        </div>
    </div>
</body>

<script src="../../js/CartItems.js"></script>
<script src="../../js/webStorage.js"></script>
<script>
    //As all items are stored in "items" array, a member of CartItems class (refer to js/CartItems.js)
    //Assign productIndex corresponding to such array's element
    let productIndex = 0;
    //onclick Function
    function buttonAddProduct() {
        let addedItemName = addItemToCart(productIndex);
        alert("Added " + addedItemName + " to cart.");
    }
</script>
</html>