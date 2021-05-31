<?php
	//Retrieve products from file
	require_once($_SERVER['DOCUMENT_ROOT'] . '/php/API/data_loader/file_parser.php');
	$sorted_products_by_date = sort_by_category(read_all_file(PRODUCTS_DATA_FILE_PATH),'created_time',false);

	//Get current page number
	if (is_numeric($_GET['page'])
			&& (int)$_GET['page'] > 0
			&& (int)$_GET['page'] <= count($sorted_products_by_date) / 2) {
		$page = (int)$_GET['page'];
	} else {
		$page = 1;
	}

	//Get two products to display
	$first_product = $sorted_products_by_date[$page * 2 - 2] ?? null;
    $second_product = $sorted_products_by_date[$page * 2 - 1] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="pages/products/css/shopping_cart.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="pages/products/css/footer.css">
    <link rel="stylesheet" href="pages/products/css/header.css">
    <meta charset="UTF-8">
    <!-- Change the web page title -->
    <title>BMW R 1250 GS Adventure</title>
    <link href="css/productpage.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
		.products_list {
            white-space: nowrap;
        }
		.products_list > li {
            display: inline-block;
            height: 100%;
		}
		.pagination {
            list-style: none;
		}
		.pagination > li {
            display: inline-block;
            width: 50%;
            height: 100%;
		}
	</style>
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
                <li class="nav-list-item"><a href="#">Home</a></li>
                <li class="nav-list-item"><a href="#">About Us</a></li>
                <li class="nav-list-item"><a href="#">Fees</a></li>
                <li class="nav-list-item"><a href="#">My Account</a></li>
                <li class="nav-list-item"><a href="#">Browse</a></li>
                <li class="nav-list-item"><a href="#">FAQs</a></li>
                <li class="nav-list-item"><a href="#">Contact</a></li>
            </ul>
        </div>
    </header>
    <h2>New Products</h2>
	<ul class="products_list">
<?php
	if (!is_null($first_product)) {
?>
		<li>
			<div>
				<p><?=$first_product['name']?></p>
				<p>$ <?=$first_product['price']?></p>
			</div>
		</li>
<?php
	}
    if (!is_null($second_product)) {
?>
	    <li>
		    <div>
			    <p><?=$second_product['name']?></p>
			    <p>$ <?=$second_product['price']?></p>
		    </div>
	    </li>
<?php
    }
?>
	</ul>
	<br>
    <ul class="products_list">
<?php
	//If current page is neither first page nor last page
	if ($page > 1 && $page < count($sorted_products_by_date) / 2) {
?>
		<li>
			<p><a href="<?=$_SERVER['PHP_SELF']?>?page=<?=$page - 1?>">Previous</a></p>
		</li>
		<li>
			<p><a href="<?=$_SERVER['PHP_SELF']?>?page=<?=$page + 1?>">Next</a></p>
		</li>
<?php
	} else {
		//If current page is the first page
		if ($page === 1) {
?>
		<li>
			<p><a href="<?=$_SERVER['PHP_SELF']?>?page=<?=$page + 1?>">Next</a></p>
		</li>
<?php
		} else {
			//If current page is the last page
?>
		<li>
			<p><a href="<?=$_SERVER['PHP_SELF']?>?page=<?=$page - 1?>">Previous</a></p>
		</li>
<?php
        }
	}
?>
    </ul>
    <br>
    <p>Page: <?=$page?>/<?=count($sorted_products_by_date) / 2?></p>
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

<script src="js/CartItems.js"></script>
<script src="js/webStorage.js"></script>
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