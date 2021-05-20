# file_parser header file
File name: [file_parser.php](../data_loader/file_parser.php)

The `file_parser` header provides utility functions for reading and filtering data from CSV file.  
This header includes the functionality to retrieve the pre-defined fields written on the very top of the file, and
automatically read and set the values to their corresponding fields.  
This eases the process of retrieving data and filter items according to categories, and perform more efficiently on
loading data from CSV file.

## Contents of the header:
- Constants:
    - `SEPARATOR = ','` : comma (`,`) is used in .CSV (**Comma**-Separated Values) files for separating values, this
    constant is used in function `explode()` for splitting CSV lines.
    - `READ_MODE = 'r'` : function `fopen()` takes `r` as the open file for reading mode.


- Functions
    - `parse_line()` : Parse CSV-formatted string and return the object as an associative/indexed array.
        - Arguments:
            - `$line` : The CSV string to be parsed.
            - `$categories` : (optional) The array of object's categories, object will be returned as an indexed array.
        - Return values: Return an indexed/associative array if string is parsable, otherwise, return `false`
        - Undefined behaviours/errors: This situation may happen when passing a non-string value to `$line` argument and
          passing non-array value to
            `$categories` argument.
 
    - `read_file()`: Read user-specified .CSV file and parse its contents (all contents or only those matches
      specified value of category) into an array of objects.
        - Arguments:
            - `$file_path`: The path to the CSV file to be parsed.
            - `$filter_category`: (optional) The category (aka attribute) of object to be considered when filtering.
            - `$filter_value`: (optional) The value of object's category to filter.
        - Return values: When passed with `$filter_category` and `$filter_value`, function only returns an array
        contains all objects matched the category value. Otherwise, the function will return every object it is able to
        parse from the CSV file. `false` may be returned when the CSV file was not open successfully or no objects could
        not be parsed.
        - Undefined behaviours/errors: This situation may happen when passing a non-string value to the last two
          arguments.
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
 