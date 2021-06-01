<?php
    require_once('php/API/data/file_parser.php');

    //Get data, sorted
    $sorted_stores = read_all_file(STORES_DATA_FILE_PATH);
    $sorted_products = read_all_file(PRODUCTS_DATA_FILE_PATH);
    $categories = read_all_file(CATEGORIES_DATA_FILE_PATH);

    //Filter functions
    function filter_stores_by_ini_char(array $stores, string $filter_char) {
        if ($filter_char === 'all') {
        	return $stores;
        }

        $filtered_stores = [];
        if ($filter_char === 'other') {
            foreach ($stores as $store) {
                if (!ctype_alpha(substr($store['name'],0,1))) {
                    $filtered_stores[] = $store;
                }
            }
        } else {
            foreach ($stores as $store) {
                if (strtoupper(substr($store['name'],0,1)) === $filter_char) {
                    $filtered_stores[] = $store;
                }
            }
        }
        return $filtered_stores;
    }

    function filter_stores_by_category_id(array $stores, string $filter_id) {
        if ($filter_id === 'all') {
            return $stores;
        }

        $filtered_stores = [];
        foreach ($stores as $store) {
            if ($store['category_id'] === $filter_id) {
                $filtered_stores[] = $store;
            }
        }
        return $filtered_stores;
    }

	function check_name_param(string $option) : bool {
    	if ($option === 'all' || $option === 'other') {
    		return true;
	    }
    	if (strlen($option) === 1 && ctype_alpha($option)) {
    		return true;
	    } else {
    		return false;
	    }
	}

    //Process http parameters
    $selected_name_option = isset($_GET['name']) && check_name_param($_GET['name']) ? $_GET['name'] : 'all';
    $selected_category_option = isset($_GET['category']) && $_GET['category'] <= count($categories) ? $_GET['category'] : 'all';

    //Filter stores
	$filtered_stores_by_name = filter_stores_by_ini_char($sorted_stores,$selected_name_option);
	$totally_filtered_stores =filter_stores_by_category_id($filtered_stores_by_name,$selected_category_option);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Browse stores</title>
	    <meta charset="UTF-8">
	    <link rel="stylesheet" href="index.css">
	    <link rel="stylesheet" href="css/cookies_banner_style.css">
	    <link href="css/products.css" rel="stylesheet">
	    <link href="css/footer.css" rel="stylesheet">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

	<body>
	<header id="header_main">
		<div class="logo">
			<h1>Mall-site</h1>
		</div>
		<!-- Navigation bar -->
		<div class="nav">
			<ul class="nav-list">
				<li class="nav-list-item"><a href="index.php">Home</a></li>
				<li class="nav-list-item"><a href="aboutus.html">About Us</a></li>
				<li class="nav-list-item"><a href="fees.html">Fees</a></li>
				<li class="nav-list-item"><a href="my_account/my_account.php" id="my_account_button">My Account</a></li>
				<li class="nav-list-item"><a href="#">Browse</a></li>
				<li class="nav-list-item"><a href="faq.html">FAQs</a></li>
				<li class="nav-list-item"><a href="contact.html">Contact</a></li>
				<li class="nav-list-item"><a href="my_account/login.php">Login</a></li>
				<li class="nav-list-item"><a href="my_account/signup.php">Sign-up</a></li>
				<li class="nav-list-item"><a href="shopping_cart.html">Shopping Cart</a></li>

			</ul>
		</div>
	</header>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
			<label>
				Browse stores by name:
				<select name="name">
					<option value="all">All</option>
<?php
	foreach (range ('A', 'Z') as $char) {
		if ($char === $selected_name_option) {
			echo "<option value=\"" . $char . "\" selected=\"selected\">" . $char . "</option>";
		} else {
            echo "<option value=\"" . $char . "\">" . $char . "</option>";
		}
	}
	$foo = "selected=\"selected\"";
?>
					<option value="other" <?=$selected_name_option === 'other' ? $foo : ''?>>Other</option>
				</select>
			</label>

			<label>
				Browse stores by category:
				<select name="category">
					<option value="all">All</option>
<?php
	for ($i = 0; $i < count($categories); $i++) {
		if ($categories[$i]['id'] === $selected_category_option) {
            echo "<option value=\"" . $categories[$i]['id'] . "\" selected=\"selected\">" . $categories[$i]['name'] . "</option>";
		} else {
            echo "<option value=\"" . $categories[$i]['id'] . "\">" . $categories[$i]['name'] . "</option>";
		}
	}
?>
				</select>
			</label>
			<button type="submit">Submit filter</button>
		</form>
	<h2>Total: <?=count($totally_filtered_stores)?> store(s)</h2>
<?php
	foreach ($totally_filtered_stores as $store) {
?>
	<a href="pages/stores/store_dt.php<?='?id=' . $store['id']?>"><p><?=$store['name']?></p></a>
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

		</ul>
		<div class="copyright">
			<small>Copyright &copy; 2021, Nhat Dang Nguyen, Hien Cong Gia Nguyen, Minh Nhat Nguyen and Thinh Hung Huynh</small>

		</div>


	</div>
	</body>
</html>
