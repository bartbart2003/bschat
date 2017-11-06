# Installation guide
## Requirements
- web server
- PHP with gettext support
- MySQL
## Installation
1. Create tables using 2 sql files.
2. Download and extract zip.
3. Go to server/main.php and edit values in "SERVER CONFIG" section. Also type correct table name on line 62.
5. Upload files to server.
6. Change your server title/announcement using the guide below.
## How to use admin panel
1. Go to <chat url>/server/admin.php.
2. In password field enter the password set in step 3 of installation guide.
3. In action field type:
   - "changeanno" to change announcement
   - "changetitle" to change server title
   - "changedebug" to toggle debug mode
   - "remove" to remove message
   - "clearall" to clear chat
4. In value field type:
   - if action is "changeanno" or "changetitle" then your announcement/title
   - if action is "changedebug" then "true" or "false"
   - if action is "remove" then type message ID (you can get it from the table)
   - if action is "clearall" then leave this field empty
5. Click OK.
