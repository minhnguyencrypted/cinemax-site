# file_parser header file
File name: [file_parser.php](../data_loader/file_parser.php)

The `file_parser` header provides utility functions for reading and filtering data from CSV file.  
This header includes the functionality to retrieve the pre-defined fields written on the very top of the file, and
automatically read and set the values to their corresponding fields.  
This eases the process of retrieving data and filter items according to categories, and perform more efficiently on
loading data from CSV file.

## Contents of the header:
### Constants:
- `SEPARATOR = ','` : comma (`,`) is used in .CSV (**Comma**-Separated Values) files for separating values, this
constant is used in function `explode()` for splitting CSV lines.
- `READ_MODE = 'r'` : function `fopen()` takes `r` as the open file for reading mode.


### Functions:
- `parse_line()` : Parse CSV-formatted string and return the object as an associative/indexed array.
    - Arguments:
        - `$line` : The CSV string to be parsed.
        - `$categories` : (optional) The array of object's categories, object will be returned as an indexed array.
    - Return values: Return an indexed/associative array if string is parsable, otherwise, return `false`
    - Undefined behaviours/errors: This situation may happen when passing a non-string value to `$line` argument and
      passing non-array value to
        `$categories` argument.

- `read_all_file()`: Read user-specified .CSV file and parse its contents into an array of objects.
    - Arguments:
        - `$file_path`: The path to the CSV file to be parsed.
    - Return values: Return an array of objects (objects' attributes and values stored as an associative array),
      return an empty array when no objects can be parsed. If file cannot be opened successfully, return `false`
    - Undefined behaviours/errors: No undefined behaviours/errors found yet.
  
- `read_file_match_value()`: Read user-specified CSV file and parse its contents, only ones which matches a specified
  value of specified category will be added to the return array.
    - Arguments:
        - `$file_path`: The path to the CSV file to be parsed.
        - `$match_value`: The matching value for an specified object's category (if `$match_category` is passed) or
          any categories.
        - `$match_category`: (optional) The category to match the value with, if not passed, any categories has the
          same value to `$match_value`, object will be considered matched.
    - Return values: Return non-empty an indexed array of matched objects, if find any, otherwise, an 
      empty one will be returned. If the CSV file cannot be opened, return `false`.
    - Undefined behaviours/errors: No undefined behaviour/errors found yet.

- `read_file_match_list()`: Read user-specified CSV file and parse its contents, only ones which matches a number of
  specified values of categories will be added to the return array.
    - Arguments:
        - `$file_path`: The path to the CSV file to be parsed.
        - `$match_values`: The matching values for the certain object's category stored in `$match_categories` (if it is passed) or
        any categories otherwise.
        - `$match_categories`: (optional) The list of categories of the object need to be matched with respectively indexed values in `$match_values`
    - Return values: Return a non-empty indexed array of matched objects, if find any, otherwise, an empty one will be
      returned. If the CSV file cannot be opened, return `false`.
    - Undefined behaviours/errors: No undefined behaviour/errors found yet.

- `match_object_by_value()`: Decide whether the object has a certain category matches a specified value.
    - Arguments:
        - `$object`: The associative array of object.
        - `$match_value`: The string of category value to check for matching, if `$match_category` is not passed, try to
          match such value with every object's categories.
        - `$match_category`: (optional) The name of the category to be checked if it's value matches the `$match_value`.
    - Return values: Return a non-empty indexed array of matched objects, if find any, otherwise, an empty one will be
    returned. If the CSV file cannot be opened, return `false`.
    - Undefined behaviours/errors: No undefined behaviour/errors found yet.

- `match_object_by_list()`: Decide whether the object has a number of specified categories matches several values.
    - Arguments:
        - `$object`: The associative array of object.
        - `$match_values`: The array of strings as a value of same-index category stored in `$match_categories` to be checked, if it is not passed, try to
          match such value with every object's categories.
        - `$match_categories`: (optional) The list of object categories to be checked if the values matches the corresponding on in `$match_values`.
    - Return values: Return a non-empty indexed array of matched objects, if find any, otherwise, an empty one will be
      returned. If the CSV file cannot be opened, return `false`.
    - Undefined behaviours/errors: No undefined behaviour/errors found yet.
    
- `get_categories()`: Retrieve CSV file categories
    - Arguments:
        - `$file_path`: The path to the CSV file to be retrieved.
    - Return values: If it's successful, the functions returns an array of categories defined in the CSV file.
    Otherwise, `false` may be returned in case of no categories can be found or file could not open successfully.
    - Undefined behaviours/errors: No Undefined behaviours/errors found yet.

- `fgets_clean()`: It behaves the same to `fgets()`, but returns the string without the newline character at the end
of the string. Arguments and Return values are the same to `fgets()`.
  
## Information about this header
Initially written by Minh Nguyen

Path (from repository root): `php/API/data_loader/file_parser.php`  

Use `require_once()` to include this header into your code, specify the relative path corresponding to your current
file's location.  
Preferably passing `$_SERVER['DOCUMENT_ROOT'] . '/php/API/data_loader/file_parser.php'` to `require_once()` function.
 