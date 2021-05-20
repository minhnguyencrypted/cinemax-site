<?php
    const SEPARATOR = ',';
    const READ_MODE = 'r';

    function fgets_clean($file_obj) {
        return preg_replace("/[\n]$/","",fgets($file_obj));
    }

    function parse_line($line, $categories = []) {
        //Split line into array
        $line_split = explode(SEPARATOR,$line);
        if (!$line_split || empty($line)) {
            return false;
        }

        $parsed_object = [];
        if (is_array($categories)) {
            if (empty($categories)) {
                $i = 0;
                foreach ($line_split as $line_value) {
                    $parsed_object[$i++] = $line_value;
                }
            } else {
                $i = 0;
                foreach ($line_split as $line_value) {
                    $parsed_object[$categories[$i++]] = $line_value;
                }
            }
        } else {
            $parsed_object[$categories] = $line_split;
        }
        return $parsed_object;
    }
    /*
        Test cases for line_parser(), ignore these lines
        var_dump(line_parser("foo","name"));
        var_dump(line_parser("","name"));
        var_dump(line_parser("foo,bar,baz",["name","id","group","number"]));
        var_dump(line_parser("foo",""));
        var_dump(line_parser("foo",null));
        var_dump(line_parser("foo,bar,baz,qux"));
    *
    */

    function select_line($line, $categories, $select_category, $select_value) : bool {
        $parsed_object = parse_line($line,$categories);
        if (!$parsed_object) {
            return false;
        } else {
            return $parsed_object[$select_category] === $select_value;
        }
    }

    /*
     * Test cases for line_selector(), ignore these lines
        var_dump(line_selector("foo,bar,baz",["name","id","group"],"name","foo"));
        var_dump(line_selector("qux,bar,baz",["name","id","group"],"name","foo"));
        var_dump(line_selector("qux,foo,baz",["name","id","group"],"id","foo"));
        var_dump(line_selector("qux,bar,foo",["name","id","group"],"foo","foo"));
        var_dump(line_selector("qux,foo,baz",["name","id","group"],"foo",["foo","bar"]));
     *
     */

    function read_file($file_path, $select_category = "", $select_value = "") {
        //Prepare file for reading
        $file_obj = fopen($file_path,READ_MODE);
        if ($file_obj === false) {
            return false;
        }
        //Perform file reading
        //Retrieve categories list
        $categories = parse_line(fgets_clean($file_obj));

        $objects_array = [];
        //Dealing with optional arguments
        if ($select_category !== "" || $select_value !== "") {
            //Arguments: ($file_path,<string>,<string>)
            while (!feof($file_obj)) {
                $current_obj = parse_line(fgets_clean($file_obj), $categories);
                if ($current_obj !== false && isset($current_obj[$select_category]) &&
                    $current_obj[$select_category] === $select_value) {
                    $objects_array[] = $current_obj;
                }
            }
        } else {
            //Arguments: ($file_path,"","")
            while (!feof($file_obj)) {
                $current_obj = parse_line(fgets_clean($file_obj), $categories);
                if ($current_obj !== false) {
                    $objects_array[] = $current_obj;
                }
            }
        }

        return empty($objects_array) ? false : $objects_array;
    }

    /*
     * Test cases for read_file(), ignore these lines
        var_dump(read_file("tests/foo.csv","name","foo"));
        var_dump(read_file("tests/bar.csv","name","foo"));
        var_dump(read_file("tests/bar.csv","foo","foo"));
        var_dump(read_file("tests/baz.csv","address","foo"));
        echo "qux ";
        var_dump(read_file("tests/qux.csv","address","foo"));
        var_dump(read_file("tests/quux.csv","address","foo"));
        var_dump(read_file("tests/quuz.csv","group","TRUE"));
        var_dump(read_file("tests/foo.csv"));
        var_dump(read_file("tests/foo.csv","name","foo"));
        var_dump(read_file("tests/foo.csv",["name"],["foo"]));
        var_dump(read_file("tests/foo.csv"));
        var_dump(read_file("tests/foo.csv","name","foo"));
     *
     */
