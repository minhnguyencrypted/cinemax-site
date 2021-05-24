<?php
    const SEPARATOR = ',';
    const READ_MODE = 'r';

    function fgets_clean($file_obj) {
        return preg_replace("/\r\n?|\n$/","",fgets($file_obj));
    }

    function parse_line(string $line, array $categories = []) {
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
                //If the number of fields parsed is less than the number categories, return false
                if (count($line_split) < count ($categories)) {
                    return false;
                }
                for ($i = 0; $i < count($categories); $i++) {
                    $parsed_object[$categories[$i]] = $line_split[$i];
                }
            }
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
    var_dump(parse_line("foo,bar,baz",['name','id','group']));
    var_dump(parse_line("foo,bar,baz",['name']));
    var_dump(parse_line("foo,barbaz",['name','id','group']));
    var_dump(parse_line("",['name','id','group']));
    var_dump(parse_line("    ",['name']));
    *
    */

    function get_categories($file_path) {
        //Prepare file for reading
        $file_obj = fopen($file_path,READ_MODE);
        if ($file_obj === false) {
            return false;
        }

        do {
            $categories = parse_line(fgets_clean($file_obj));
        } while (!feof($file_obj) && $categories === false);

        //Close file and return categories list
        fclose($file_obj);
       return $categories;
    }
    /*
     * get_categories() test cases, ignore these lines
        var_dump(get_categories("tests/foobar.csv"));
        var_dump(get_categories("tests/corge.csv"));
        var_dump(get_categories("tests/grault.csv"));
        var_dump(get_categories("tests/qux.csv"));
     *
     */

    function match_object_by_value(array $object, string $match_value, string $match_category = "") : bool {
        //If match_category is blank, try to match every objects that has any value of $match_value
        //Otherwise, match specified category with the specified value
        if ($match_category === "") {
            foreach ($object as $object_value) {
                if ($object_value === $match_value) {
                    return true;
                }
            }
            return false;
        } else {
            return isset($object[$match_category]) && $object[$match_category] === $match_value;
        }
    }

    /*
     * Test cases for filter_object(), ignore these lines
        $foo = ["name" => "foo", "id" => "bar", "group" => "123"];
        var_dump(match_object($foo,"name","foo"));
        var_dump(match_object($foo,"","foo"));
        var_dump(match_object($foo,"","123"));
        var_dump(match_object($foo,"",""));
        var_dump(match_object($foo,"id","foo"));
        var_dump(match_object($foo,"id"));
     *
     */

    function match_object_by_list(array $object,  array $match_values, array $match_categories = []) : bool {
        //If match_categories is blank, try to match every categories with every values of $match_values,
        //Otherwise, perform matching categories with their corresponding match value
        if (empty($match_categories)) {
            foreach ($object as $object_category) {
                foreach ($match_values as $value) {
                    if ($object_category === $value) {
                        return true;
                    }
                }
            }
            return false;
        } else {
            for ($i = 0; $i < count($match_categories); $i++) {
                if (!isset($object[$match_categories[$i]]) || $object[$match_categories[$i]] !== $match_values[$i]) {
                    return false;
                }
            }
            return true;
        }
    }

    /*
     * Test cases for match_objet_by_list(), ignore these lines
    $foo = ['name' => 'foo', 'id' => 'bar', 'group' => 'bar', 'number' => '0123'];
    $bar = ['name'=> 'baz', 'id' => 'qux', 'group' => 'quux', 'number' => '12'];
    var_dump(match_object_by_list($foo));
    var_dump(match_object_by_list($foo,['name','id']));
    var_dump(match_object_by_list($foo,['name','id'],['foo','bar']));
    var_dump(match_object_by_list($foo,[],['foo','bar']));
    var_dump(match_object_by_list($bar,[],['foo','bar']));
    var_dump(match_object_by_list($bar,['name'],['baz','bar']));
    var_dump(match_object_by_list($bar,['name'],['bar','baz']));
    var_dump(match_object_by_list($bar,['name','id','group','foo'],['baz','qux','quux']));
    var_dump(match_object_by_list($bar,['name','id','group'],['baz','qux','quux']));
    var_dump(match_object_by_list($bar,['name','bar'],['baz','bar']));
     *
     */

    function read_all_file(string $file_path) {
        //Prepare file for reading
        $file_obj = fopen($file_path,READ_MODE);
        if ($file_obj === false) {
            return false;
        }

        //Retrieve categories list
        do {
            $categories = parse_line(fgets_clean($file_obj));
        } while (!feof($file_obj) && $categories === false);

        $objects_array = [];
        while (!feof($file_obj)) {
            $current_obj = parse_line(fgets_clean($file_obj),$categories);
            if ($current_obj !== false) {
                $objects_array[] = $current_obj;
            }
        }

        //Close file and return objects list
        fclose($file_obj);
        return $objects_array;
    }

    /*
     * Test cases for read_all_file(), ignore these lines
    var_dump(read_all_file("tests/foo.csv"));
   $foo = read_all_file("tests/stores.csv");
   echo isset($foo[1]['featured']) . $foo[1]['featured'] . "\n";
    var_dump(match_object_by_value($foo[1],'FALSE', 'featured'));
     *
     */

    function read_file_match_value(string $file_path, string $match_value, string $match_category = "") {
        //Prepare file for reading
        $file_obj = fopen($file_path,READ_MODE);
        if ($file_obj === false) {
            return false;
        }

        //Retrieve categories list
        do {
            $categories = parse_line(fgets_clean($file_obj));
        } while (!feof($file_obj) && $categories === false);

        $objects_array = [];
        while (!feof($file_obj)) {
            $current_obj = parse_line(fgets_clean($file_obj),$categories);
            if ($current_obj !== false && match_object_by_value($current_obj, $match_value, $match_category)) {
                $objects_array[] = $current_obj;
            }
        }

        //Close file and return objects list
        fclose($file_obj);
        return $objects_array;
    }

    /*
     * Test cases for read_file_match_value(), ignore these lines
        var_dump(read_file_match_value("tests/foo.csv","name","foo"));
        var_dump(read_file_match_value("tests/bar.csv","name","foo"));
        var_dump(read_file_match_value("tests/bar.csv","foo","foo"));
        var_dump(read_file_match_value("tests/baz.csv","address","foo"));
        echo "qux ";
        var_dump(read_file_match_value("tests/qux.csv","address","foo"));
        var_dump(read_file_match_value("tests/quux.csv","address","foo"));
        var_dump(read_file_match_value("tests/quuz.csv","group","TRUE"));
        var_dump(read_file_match_value("tests/foo.csv"));
        var_dump(read_file_match_value("tests/foo.csv","name","foo"));
        var_dump(read_file_match_value("tests/foo.csv",["name"],["foo"]));
        var_dump(read_file_match_value("tests/foo.csv"));
        var_dump(read_file_match_value("tests/foo.csv","name","foo"));
     *
     */

    function read_file_match_list(string $file_path, array $match_values, array $match_categories = []) {
        //Prepare file for reading
        $file_obj = fopen($file_path,READ_MODE);
        if ($file_obj === false) {
            return false;
        }

        //Retrieve categories list
        do {
            $categories = parse_line(fgets_clean($file_obj));
        } while (!feof($file_obj) && $categories === false);

        //If category argument is blank
        $objects_array = [];
        while (!feof($file_obj)) {
            $current_obj = parse_line(fgets_clean($file_obj),$categories);
            if ($current_obj !== false && match_object_by_list($current_obj, $match_values, $match_categories)) {
                $objects_array[] = $current_obj;
            }
        }

        //Close file and return objects list
        fclose($file_obj);
        return $objects_array;
    }

    /*
     * Test cases for read_file_match_list(), ignore these lines
        var_dump(read_file_match_list("tests/foo.csv",['name','id'],['foo','qux']));
        var_dump(read_file_match_list("tests/foo.csv",[],['foo','qux']));
        var_dump(read_file_match_list("tests/foo.csv",[],['foo','qux']));
        var_dump(read_file_match_list("tests/foo.csv",[],[]));
     *
     */

    //Sorting functions
    function sort_by_category(array $objects, string $sort_category, bool $ascending = true) {
        if (empty($objects)) {
            return false;
        }

        //Get category values from $objects
        $sort_values = [];
        foreach ($objects as $object) {
            if (isset($object[$sort_category])) {
                $sort_values[] = $object[$sort_category];
            } else {
                return false;
            }
        }

        return array_multisort($sort_values,$ascending ? SORT_ASC : SORT_DESC,SORT_NATURAL,$objects) ? $objects : false;
    }
    /*Tested on separate file*/