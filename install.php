<!--
	The Installation HTML webpage

	This page is used for initiating an Administrator account, which is used to manipulate and change the entire website
	contents, images, information, etc.

	Once an Administrator account is initiated, there's no way to reset or change the password, even when accessing this
	page. The change password functionality could be added in the future but Mr. Tri doesn't request us in the
	assignment documentation, so, we'll add it when we have free time.

	The "Shadow" file appears many times below is actually the file the used to store the login credentials, for further
	information, refer to ShadowFile.php (PHP Class file).

	Initially written like an eye-rape by Minh Nguyen.
-->
<?php
	require_once ("php/API/authentication/ShadowFile.php");
	$shadow = new authentication\ShadowFile("shadow");

	$shadow_file_status = $shadow->get_file_validity();

	if ($shadow_file_status === true) {
		$shadow_file_contents = $shadow->get_all_credentials();

		$is_credential_valid = isset($_POST['submit']) && is_username_valid($_POST['username']);

		if ($shadow_file_contents === [] && $is_credential_valid) {
			$shadow->set_credential($_POST['username'], password_hash($_POST['passwd'],PASSWORD_BCRYPT));
			$shadow_file_contents = $shadow->get_all_credentials();
		}

	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	    <title>Installation page</title>
	    <meta charset="UTF-8">
	    <style>
		    body {
			    text-align: center;
		    }
		    form {
			    position: relative;
			    margin-left: 35%;
			    width: 30%;
			    text-align: left;
		    }
		    form label {
			    position: relative;
			    margin-left: 20%;
		    }
		    form button {
                position: relative;
                margin-left: 40%;
		    }
            form p {
                position: relative;
                margin-left: 15%;
            }
	    </style>
    </head>

	<body>
	<?php
		if ($shadow_file_status === false) {
	?>
		<p>Fatal error: cannot retrieve administrator credentials</p>
	<?php
		} else {
			if (!empty($shadow_file_contents)) {
	?>
		<h2>Administrator account has been registered</h2>
		<p>Use your registered credential to log in as Administrator</p>
	<?php
			} else {
	?>
		<h2>Create your administrator account</h2>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
			<label>
		  Username: <input type="text" name="username" value="<?=$_POST['username']?>" required>
		  </label>
			<br><br>
			<label>
				Password: <input type="password" name="passwd" value="<?=$_POST['passwd']?>" required>
			</label>
			<br><br>
			<button type="submit" name="submit">Submit</button>
	<?php
				if (isset($_POST['submit']) && !$is_credential_valid) {
	?>
		<p>Your previously submitted username is invalid</p>
	<?php
                }
	?>
		</form>
	<?php
            }
		}

        function is_username_valid($username) : bool {
        	//If username starts with a letter
	        $is_starts_with_letter = preg_match("/^[a-zA-Z]/",$username);
	        //If username doesn't contain any non-word characters (not letters, numbers or underscore)
	        $is_not_contains_non_word = !preg_match("/\W/",$username);

			//Return the result
	        return $is_starts_with_letter && $is_not_contains_non_word;
        }
	?>
	</body>
</html>
