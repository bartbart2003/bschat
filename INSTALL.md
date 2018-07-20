# Installation guide
## Requirements
- web server
- PHP with gettext support
- MySQL
## Installation
1. Create a new table using chattable.sql (I recommend using the "Import" feature in PhpMyAdmin for this).
2. Go to server/main.php and edit the values in the "SERVER CONFIG" section (point to the table that you've created in step 1). Also type the correct table name in line 36 (replace "yourtable").
3. Enjoy.
