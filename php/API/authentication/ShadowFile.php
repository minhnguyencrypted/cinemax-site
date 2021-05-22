<?php
    namespace authentication;

    class ShadowFile {
        //Constants
        private const READ_MODE = 'r';
        private const APPEND_MODE = 'a';
        private const SEPARATOR = ':';

        //Attributes
        private string $default_containing_dir;
        private string $file_name;
        private bool $is_file_valid;

        //Constructor
        public function __construct(string $file_name) {
            //Set default containing directory
            $this->default_containing_dir = $_SERVER['DOCUMENT_ROOT'] . '/../mall_site_data/';
            //Set file name
            $this->file_name = $file_name;

            $file_path = $this->default_containing_dir . $this->file_name;
            //verify the file and store the status
            $this->is_file_valid = file_exists($file_path) ? is_writable($file_path) &&
                    is_readable($file_path) : $this->create($file_name);
        }

        //File verifiers and creators
        public function verify() : bool {
            $file_path = $this->default_containing_dir . $this->file_name;
            $this->is_file_valid = file_exists($file_path) && is_writable($file_path) &&
                    is_readable($file_path);
            return $this->is_file_valid;
        }

        public function create(string $file_name) : bool {
            //Create directory
            if (!file_exists($this->default_containing_dir)) {
                mkdir($this->default_containing_dir,0777,true);
            }

            //Create file
            $file_path = $this->default_containing_dir . $file_name;
            $file_obj = fopen($file_path,self::APPEND_MODE);
            if ($file_obj === false) {
                $this->is_file_valid = false;
                return false;
            }

            //Verify
            fclose($file_obj);
            return $this->verify();
        }

        //File readers/getters
        private function get_path() : string {
            return $this->default_containing_dir . $this->file_name;
        }

        public function get_all_credentials() {
            $file = fopen($this->get_path(),self::READ_MODE);
            if ($file === false) {
                return false;
            }

            $parsed_credentials = [];
            while (!feof($file)) {
                $current_credential = self::parse_line(self::fgets_clean($file));
                if ($current_credential !== false) {
                    $parsed_credentials[] = $current_credential;
                }
            }

            fclose($file);
            return $parsed_credentials;
        }

        public function get_hash(string $username) {
            $file = fopen($this->get_path(),self::READ_MODE);
            if ($file === false) {
                return false;
            }

            while (!feof($file)) {
                $current_credential = self::parse_line(self::fgets_clean($file));
                if (is_array($current_credential) && $current_credential['username'] === $username) {
                    return $current_credential['hash'];
                }
            }

            fclose($file);
            return false;
        }

        public function get_file_validity() : bool {
            return $this->is_file_valid;
        }

        public function is_registered(string $username) : bool {
            $file = fopen($this->get_path(),self::READ_MODE);
            if ($file === false) {
                return false;
            }

            while (!feof($file)) {
                $current_credential = self::parse_line(self::fgets_clean($file));
                if (is_array($current_credential) && $current_credential['username'] === $username) {
                    return true;
                }
            }

            fclose($file);
            return false;
        }

        //File writers/Setters
        public function set_credential(string $username, string $hash) : bool {
            if ($this->is_registered($username) === true) {
                return false;
            }

            $file = fopen($this->get_path(),self::APPEND_MODE);
            if ($file === false) {
                return false;
            } else {
                if (fwrite($file,$username . ':' . $hash) === false) {
                    return false;
                } else {
                    fclose($file);
                    return true;
                }
            }
        }

        //Parsing methods
        public static function parse_line(string $line) {
            //If line is invalid, return false
            if (preg_match("/:/",$line) === 0 || preg_match("/^#/",$line)) {
                return false;
            }

            $exploded_line = explode(self::SEPARATOR,$line);
            if ($exploded_line !== false) {
                $parsed_credential['username'] = $exploded_line[0];
                $parsed_credential['hash'] = $exploded_line[1];
            } else {
                $parsed_credential = false;
            }
            return $parsed_credential;
        }

        private static function fgets_clean($file_obj) : string {
            return preg_replace("/[\n]$/","",fgets($file_obj));
        }

        /*
        //Debug getters
        public function get_file_name() : string{
            return $this->file_name;
        }
        public function get_validity() : bool {
            return $this->is_file_valid;
        }
        public function get_dir() : string {
            return $this->default_containing_dir;
        }
        */
    }