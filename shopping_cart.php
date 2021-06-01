<?php
	session_start();
	
?>





<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
	<link rel="stylesheet" type="text/css" href="pages/products/css/shopping_cart.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="pages/products/css/footer.css">
	<link rel="stylesheet" href="pages/products/css/header.css">
	<script src="pages/products/js/itemsDom.js"></script>
	<script src="pages/products/js/webStorage.js"></script>
	<script src="pages/products/js/cartTotalDom.js"></script>
</head>

<body>
        <!-- Set Index page title here -->
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
									<li class="nav-list-item"><a href="my_account/signup.php">Sign-up</a></li>
									<li class="nav-list-item"><a href="shopping_cart.html">Shopping Cart</a></li>
					
							</ul>
					</div>
					</header>
	
<div class="container" id="container">
	<h1>Shopping Cart</h1>
	<!--
	<div id="discountCodeField">
		<label>
			Discount code: <input type="text" id="discountCode">
		</label>
		<button type="button" onclick="checkDiscountCode()">Submit</button>
		<br><br>
		<p id="discountCodeCheckResult"></p>
	</div>
	-->
	<script>
		//If your cart is not empty and logged in, display the discount field
		let cartItemsCount = JSON.parse(localStorage.getItem("totalItemCount"));
		if (cartItemsCount) {
			const discountCodeInputFieldParent = document.getElementById("container");
			discountCodeInputFieldParent.appendChild(discountCodeFieldDomObjConstructor());
		}
	</script>
	<br>
	<div class="cart">
		<div class="items" id="itemList">
			<!-- Display items list -->
			<script>
				//Retrieve data from localStorage
				let retrievedItemsList = retrieveItemsList();
				let itemCount = JSON.parse(localStorage.getItem("totalItemCount"));
				if (!retrievedItemsList || itemCount === 0) {	//No items found in cart
					document.write("<p>Your cart is empty.</p>");
					console.log("No items found in Cart");
				} else { 			//Found items, print 'em
					console.log("Print items");
					let itemsListDiv = document.getElementById("itemList");

					//Displaying items in cart
					for (let item of retrievedItemsList.itemList) {
						if (item.count > 0) {
							let itemDomObj = itemDomObjectConstructor(item);
							itemsListDiv.appendChild(itemDomObj);
						}
					}
				}
			</script>
		</div>
		<div class="cart_total" id="cartTotal">
			<script>
				let cartTotalDiv = document.getElementById("cartTotal");
				//Retrieve Total Price and number of items
				let totalPrice = localStorage.getItem("totalPrice") ?
						localStorage.getItem("totalPrice") : 0;
				let totalItemCount = localStorage.getItem("totalItemCount") ?
						localStorage.getItem("totalItemCount") : 0;
				//Append Total Price
				cartTotalDiv.appendChild(cartTotalPriceDomObjConstructor(reformatPrice(totalPrice)));
				cartTotalDiv.appendChild(cartNumberOfItemsDomObjConstructor(totalItemCount));
			</script>
			<!--
				<p>
					<span>Total Price</span>
					<span>$ 200</span>
				</p>
				<p>
					<span>Number of Items</span>
					<span>2</span>
				</p>
				<p>
					<span>You Save</span>
					<span>$ 100</span>
				</p>
			-->
			<a href="order_placement_.php">Proceed to Checkout</a>
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
<!--//footer-->
</body>
<script src="pages/products/js/CartItems.js"></script>
<script>
	let submitButtonElement = document.getElementById("submitButton");
	let discountPercentage = 0;
	//Preventing calling method from a null object
	if (submitButtonElement) {
		submitButtonElement.addEventListener("click",function() {
			discountPercentage = checkDiscountCode();
		});
	}
	//Process discount code
	function checkDiscountCode() {
		let discountCodeStr = document.getElementById("discountCode").value;
		//Getting total price
		const totalPriceValue = localStorage.getItem("totalPrice");
		console.log(totalPriceValue);
		//Checking discount code and print display result to HTML
		let discountCodeCheckResult = document.getElementById("discountCodeCheckResult");
		let discountPercentage = 0;
		switch (discountCodeStr) {
			case "COSC2430-HD":
				discountCodeCheckResult.textContent = "Valid for 20% Discount";
				discountPercentage = 20;
				setDiscountedPrice(totalPriceValue * (100 - discountPercentage) / 100);
				break;
			case "COSC2430-DI":
				discountCodeCheckResult.textContent = "Valid for 10% Discount";
				discountPercentage = 10;
				setDiscountedPrice(totalPriceValue * (100 - discountPercentage) / 100);
				break;
			default:
				discountCodeCheckResult.textContent = "Invalid Discount code";
				unsetDiscountedPrice();
		}
		return discountPercentage;
	}

	//Add event listener to remove buttons
	let removeButtons = document.getElementsByClassName("item_remove");
	if (removeButtons) {
		console.log("rmbutton count: " + removeButtons.length);
		for (let rmButton of removeButtons) {
			rmButton.addEventListener("click",function() {
				removeItemFromScreen(this);
				updateCartTotal(discountPercentage);
		});
		}
	}
	//Remove item displaying
	function removeItemFromScreen(rmItem) {
		//Get item to remove
		let itemToRemoveDomObj = rmItem.parentNode.parentNode;
		let itemToRemoveId = itemToRemoveDomObj.id;
		//Remove item
		itemToRemoveDomObj.parentNode.removeChild(itemToRemoveDomObj);
		//Dealing with web storage stuff
		removeItemFromCart(itemToRemoveId);
	}

</script>

<script>
const cookieBanner = document.querySelector(".cookie-container");
const acceptButton = document.querySelector(".cookie-button");


acceptButton.addEventListener("click", () => {
  cookieBanner.classList.remove("active");
  localStorage.setItem("cookieBannerDisplayed", "true");
});

setTimeout(() => {
  if (!localStorage.getItem("cookieBannerDisplayed")) {
    cookieBanner.classList.add("active");
  }
}, 2000);



</script>
</html>