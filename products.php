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
    <div class="pInfo-frame">
        <div class="product-info">
            <h2 class="pTitle">BMW R 1250 GS Adventure</h2>
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
            <p class="pPrice">Price: VND 699,000,000</p>
            <div class="buy-button"><p class="button-name">Buy Now</p></div>
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