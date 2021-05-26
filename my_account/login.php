<?php
	session_start();
	if (isset($_SESSION['user_id'])) {
		header("Location: my_account.php");
	}
	require_once($_SERVER['DOCUMENT_ROOT'] . '/php/API/authentication/ShadowFile.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/php/API/data_loader/file_parser.php');
    use authentication\ShadowFile;

    $log_in_credentials_file = new ShadowFile('users');

	function get_user_id(string $email) {
        //Try to receive account info
        $account_info = read_file_match_value(USERS_INFO_FILE_PATH,$email,'email');
        //If not found, return false;
        if ($account_info === false) {
        	return false;
        }

		//Validate user's login credential
		$user_id = $account_info[0]['user_id'] ?? '';
        if ($user_id === '') {
        	return false;
        }
        return $user_id;
	}

	//Receive login credentials
	$email = $_POST['email'] ?? '';
	$plain_password = $_POST['password'] ?? '';

	$log_in_credentials_file = new ShadowFile('users');
	//Verify login credentials
	$is_credential_valid = password_verify($plain_password, $log_in_credentials_file->get_hash(get_user_id($email)));

	//Log user in
	if ($is_credential_valid) {
		session_regenerate_id();
		$_SESSION['user_id'] = get_user_id($email);
		header("Location: my_account.php");
	}
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Signup Page</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="css/css.css">
  <link rel="stylesheet" href="css/Thinh_footer_style.css">
  <link rel="stylesheet" href="css/header.css">
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
                    <li class="nav-list-item"><a href="../index.php">Home</a></li>
                    <li class="nav-list-item"><a href="../aboutus.html">About Us</a></li>
                    <li class="nav-list-item"><a href="../fees.html">Fees</a></li>
                    <li class="nav-list-item"><a href="#" id="my_account_button">My Account</a></li>
                    <li class="nav-list-item"><a href="../browse.php">Browse</a></li>
                    <li class="nav-list-item"><a href="../faq.html">FAQs</a></li>
                    <li class="nav-list-item"><a href="../contact.html">Contact</a></li>
                    <li class="nav-list-item"><a href="my_account.php">Login</a></li>
                    <li class="nav-list-item"><a href="signup.html">Sign-up</a></li>
                </ul>
            </div>
        </header>
    
	<div class='content'>
		<h2 class='header'>Login</h2>
		<div class="container">
			<form action="<?=$_SERVER['PHP_SELF']?>" method="POST" class="form" id="login_form">
				<div class="row form-control">
					<div class="col-25">
						<label for="fname">Email :</label>
					</div>
					<div class="col-75">
						<input required type="text" id="email" name="email" placeholder="Your email..">
					</div>
				</div>

				<div class="row form-control">
					<div class="col-25">
						<label for="fname">Password :</label>
					</div>
					<div class="col-75">
						<input required id="password" name="password" type="password" placeholder="Your password..">
					</div>
					<a class="f_password" href='forgot_password.html'>Forgot your password?</a>
				</div>

				<div class="row form-control">
					<button type="submit" name="submit" class='submit_button' id="login_submit_button">Submit</button>
				</div>
<?php
	if (isset($_POST['submit']) && $is_credential_valid === false) {
		echo "<p>Invalid login credentials, please try again.</p>";
	}
?>
			</form>
		</div>
	</div>

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

<!--//footer-->
<script type="text/javascript" src="../js/hien_nguyen.js"></script>
</body>

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