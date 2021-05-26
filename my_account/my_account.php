<?php
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header("Location: login.php");
	}

	require_once($_SERVER['DOCUMENT_ROOT'] . '/php/API/data_loader/file_parser.php');
	$user_info = read_file_match_value(USERS_INFO_FILE_PATH,$_SESSION['user_id'],'user_id');
	$user_info = is_array($user_info) ? $user_info[0] : [];
	var_dump($user_info);
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>My Account</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css">

  </head>

  <body>
            <!-- Set Index page title here -->
            <header id="header_main">
              <title>Foo Mall</title>
  
              <!-- Set page logo here -->
              <div class="logo">
                  <h1>Mall-site</h1>
              </div>
              <!-- Navigation bar -->
              <div class="nav">
                  <ul class="nav-list">
                    <li class="nav-list-item"><a href="../index.html">Home</a></li>
                    <li class="nav-list-item"><a href="../aboutus.html">About Us</a></li>
                    <li class="nav-list-item"><a href="../fees.html">Fees</a></li>
                    <li class="nav-list-item"><a href="#" id="my_account_button">My Account</a></li>
                    <li class="nav-list-item"><a href="#">Browse</a></li>
                    <li class="nav-list-item"><a href="../faq.html">FAQs</a></li>
                    <li class="nav-list-item"><a href="../contact.html">Contact</a></li>
                    <li class="nav-list-item"><a href="login.php">Login</a></li>
                    <li class="nav-list-item"><a href="signup.html">Sign-up</a></li>
                  </ul>
              </div>
          </header>
<?php
	if (empty($user_info)) {
		echo "<p>Error occurred: cannot retrieve your account info.";
	} else {
?>
		<div class="container">
			<div>
				<ul>
					<li id="my_account_first_name">Name: <?=$user_info['first_name'] . ' ' . $user_info['last_name']?></li>
					<li id="my_account_email">
						Email: <?=$user_info['email']?>
					</li>
					<li>
						Phone number: <?=$user_info['phone']?>
					</li>
					<li>
						Store owner: <?=$user_info['is_store_owner'] === 'TRUE' ? 'Yes' : 'No'?>
					</li>
				</ul>
			</div>
		</div>
<?php
	}
?>



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

    <!--footer-->
<footer id="footer">
  <div class="footer1">
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
  
  </div>
</footer>
<!--//footer-->

</body>


<!--<script type="text/javascript" src="../js/hien_nguyen_my_account.js"></script>-->
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