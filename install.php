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
    //Constants
    define("SHADOW_FILE_PATH", $_SERVER['DOCUMENT_ROOT'] . "/../mall_site_data/shadow");

    //Require files
    require_once("php/Classes/ShadowFile.php");

    //Check if shadow file exists, if not, create a new one
    if (!file_exists(SHADOW_FILE_PATH)) {
    	//Create a new sibling directory "mall_site_data" of the DOCUMENT_ROOT
    	mkdir($_SERVER['DOCUMENT_ROOT'] . "/../mall_site_data",0777,true);
    	//Create a new empty shadow file
        fclose(fopen(SHADOW_FILE_PATH,ShadowFile::WRITE));
    }

    //Create shadow file object
    $shadow_file = new ShadowFile(SHADOW_FILE_PATH);
    //Check whether there are any valid login credentials inside the shadow file
    $shadow_file_contents = $shadow_file->get_all_lines();

    //Check if credentials are submitted and its username is valid
	$is_credentials_valid = isset($_POST['submit']) && is_username_valid($_POST['username']);

    //If the shadow file is still empty (or no valid credentials) and the user previously tried to submit,
	//then if the username is valid, write the login info the file.
    if($shadow_file_contents === false && $is_credentials_valid) {
        $username = $_POST['username'];
        $passwd_hash = password_hash($_POST['passwd'],PASSWORD_BCRYPT);
        $shadow_file->set_line($username,$passwd_hash);
    }
    //Check the shadow file again in case of any errors during file writing process
    $shadow_file_contents = $shadow_file->get_all_lines();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	    <title>Installation page</title>
	    <meta charset="UTF-8">
    </head>

	<body>
	<?php
        if ($shadow_file_contents !== false) {
	?>
		<h2>Administrator account has been registered</h2>
        <p>Use your registered credential to log in as Administrator</p>
	<?php
		} else {
        	//If user previously tried to submit an invalid username, prompt the message
	        if (isset($_POST['submit']) && !$is_credentials_valid) {
    ?>
				<p>Your previously submitted username is invalid, try again below</p>
    <?php
	        }
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

		</form>
	<?php
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
