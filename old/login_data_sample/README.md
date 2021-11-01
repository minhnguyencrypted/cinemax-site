# Login credentials files guidelines
## Location
The designated of the location for storing these credentials is under `mall_site_data/` directory.  
The `mall_site_data/` directory should be the sibling directory to the `mall-site/` (the project document root) 
directory. In other words, both mentioned directories should be placed inside the same directory.
## Directory structure
The `mall_site_data/` directory has two child directories: `authentication/` and `data/`.
### The `authentication/` directory
This directory stores only login credentials, includes:
- `shadow`: The text file for storing username and hashed password for Administrator.
- `users`: The text file for storing user ID's and hashed passwords for users.  

The format of these files is `<username>:<hashed_password>`.
### The `data/` directory
This directory stores users information and stores information, separated into two files.  
These files are CSV-formatted:
- `stores.csv`: Data file for stores information.
- `users.csv`: Data file for users information.

## Using the sample data
Copy the `mall_site_data/` directory to the described location in section `Location`