<!--
	ShadowFile Class

	The ShadowFile class is particularly used for users' login credentials manipulations, which are stored in
	a so-called "Shadow" file, as inherited from GNU/Linux's shadow file used for storing user account name and password
	hash string.

	Our shadow file has a quite similar format to the original one on GNU/Linux.
	Here's the format itself:
					<username>:<password_hash>
	and an example of itself:
					foo:$2y$10$VxKXYaB./dcnQW/1eA0VBu6CKdy.dC2RUyN5/34byZ1HSgOMs7fzq

	There are three types of methods in this class:
		+ File contents getters (get_*): getting the shadow contents
		+ File contents parser (parse_*): parsing the line of login credential stored in the shadow file
		+ File contents setters (set_*): setting (or writing) lines of login credentials to the shadow file
		+ Object constructor (that one __construct): constructing an object of ShadowFile class

	Initially written like an eye-rape by Minh Nguyen.
-->

<?php
    class ShadowFile {
        //Define Shadow file constants
        const SEPARATOR_SIGN = ":";
        const READ = "r";
        const WRITE = "w";

        public $file_name;

        public function __construct($file_name) {
            $this->file_name = $file_name;
        }

        //Parsing raw string from file
        //Parsing formatted line for getting username and password hash
        public static function parse_line($string_line) {
            //If the string argument:
            //  + is Not a String
            //  + doesn't contain any ":" characters
            //  + starts with "#"
	        //then return false, otherwise parse it.
            if (!is_string($string_line) ||
                    preg_match("/:/",$string_line) === 0 ||
                    preg_match("/^#/",$string_line))
            {
                return false;
            } else {
                //Split original string by separators
                $parsed_values = explode(self::SEPARATOR_SIGN,$string_line);
                //Store login data into associative array
                $parsed_info['username'] = $parsed_values[0];
                $parsed_info['passwd_hash'] = $parsed_values[1];
                //Return login data array
                return $parsed_info;
            }
        }

        //Parse username from line
        public static function parse_line_username($string_line) {
            $parsed_info = self::parse_line($string_line);
            return $parsed_info ? $parsed_info['username'] : false;
        }

        //Parse password hash from line
        public static function parse_line_passwd($string_line) {
            $parsed_info = self::parse_line($string_line);
            return $parsed_info ? $parsed_info['passwd_hash'] : false;
        }

        //Reading file
        //Get the raw line associated with specific $username
        public function get_line($username) {
            //Open file for reading
            $file = fopen($this->file_name,self::READ);
            //If file not found, return false
            if ($file === false) {
                return false;
            }

            //Get first line
            $line = preg_replace("/\n$/","",fgets($file));
            $parsed_username = self::parse_line_username($line);
            while (!feof($file) && $parsed_username !== $username) {
                $line = fgets($file);
                $parsed_username = self::parse_line_username($line);
            }
            fclose($file);
            return $line;
        }

        //Get all the raw lines in shadow file
        public function get_all_lines() {
            //Open file1
            $file = fopen($this->file_name,self::READ);
            //If file not found, return false
            if ($file === false) {
                return false;
            }

            $lines = [];
            $i = 0;
            while (!feof($file)) {
                //Get one line from file
                $current_line = preg_replace("/\n$/","",fgets($file));
                //If current line is able to be parsed, add it to the array
                if (ShadowFile::parse_line($current_line) !== false) {
                    $lines[$i] = $current_line;
                    $i++;
                }
            }

            //If the number of elements is not zero, return the array
            //Otherwise, return false;
            fclose($file);
            return ($i > 0) ? $lines : false;
        }

        //Writing file
        public function set_line($username, $passwd_hash) {
            //Open file for writing
            $file = fopen($this->file_name,self::WRITE);
            //File is opened successfully, write the login info the file and return
            if ($file !== false) {
                //Create formatted string of username and password hash
                $line_to_write = $username . ":" . $passwd_hash;
                //Write to file
                fwrite($file,$line_to_write);

                //Close file and return
                fclose($file);
                return true;
            } else {
                return false;
            }
        }
    }