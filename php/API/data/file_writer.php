<?php
    const SEPARATOR = ',';
    const APPEND_MODE = 'a';

    define('USERS_INFO_FILE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../mall_site_data/data/users.csv');
    define('USERS_STORES_INFO_FILE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../mall_site_data/data/stores.csv');

    const USERS_INFO_KEYS = ['user_id', 'email', 'phone', 'first_name', 'last_name', 'is_store_owner',
                            'address', 'city', 'zip_code'];

    const STORES_INFO_KEYS = ['owner_id', 'business_name', 'store_name', 'category'];

    function verify_directories() {
        //Check if required directories exist
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/../mall_site_data/')) {
            $first_dir = mkdir($_SERVER['DOCUMENT_ROOT'] . '/../mall_site_data/');
            if (!$first_dir) {
                return false;
            }
        }

        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/../mall_site_data/data/')) {
            $second_dir = mkdir($_SERVER['DOCUMENT_ROOT'] . '/../mall_site_data/data/');
            if (!$second_dir) {
                return false;
            }
        }
        return true;
    }

    function user_info_to_string(array $user_info) {
        $user_info_string = '';
        foreach (USERS_INFO_KEYS as $key) {
            if (isset($user_info[$key])) {
                $user_info_string .= SEPARATOR . $user_info[$key];
            } else {
                return false;
            }
        }
        return $user_info_string;
    }

    function store_info_to_string(array $store_info) {
        $store_info_string = '';
        foreach (STORES_INFO_KEYS as $key) {
            if (isset($store_info[$key])) {
                $store_info_string .= SEPARATOR . $store_info[$key];
            } else {
                return false;
            }
        }
        return $store_info_string;
    }

    function append_user_data(array $user_info, string $file_path = USERS_INFO_FILE_PATH) {
        //Try to open file for writing
        $file = fopen($file_path,APPEND_MODE);
        //If file cannot be opened successfully or $user_info is empty, return false
        if ($file === false || empty($user_info)) {
            return false;
        }

        //Convert user_info to CSV-formatted string
        $user_info_string = user_info_to_string($user_info);
        if ($user_info_string === false) {
            return false;
        }

        return (bool)fwrite($file,$user_info_string);
    }

    function append_store_data(array $store_info, string $file_path = STORES_DATA_FILE_PATH) {
        //Try to open file for writing
        $file = fopen($file_path,APPEND_MODE);
        //If file cannot be opened successfully or $user_info is empty, return false
        if ($file === false || empty($store_info)) {
            return false;
        }

        //Convert user_info to CSV-formatted string
        $store_info_string = store_info_to_string($store_info);
        if ($store_info_string === false) {
            return false;
        }

        return (bool)fwrite($file,$store_info_string);
    }
