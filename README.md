# DreamocCMS

DreamocCMS is a content management system, that you can use to manage all your Dreamocs across the world from one place. In the CMS you have options to upload as many files as you want to your cloud. The files are automaticly pusched out to all of your Dreamocs at a specific time a day, that you choose. Now you can run big campaigns on many different location stores and update content in seconds.

---

## Requirements

1. Internet connection to all of your Dreamocs
2. Works only with these models:
*   Dreamoc HD3
*   Dreamoc POP 2+3
3. Internet server that runs Apache, PHP 5+ & MySql
4. If you need to use FTP-protocol (not standart. you need to use ProFTPd protocol.

---

## How to setup
1. Upload content of folder to your domain or subdomain.
2. Set permissions for the folder "users", to "CHMOD 755"
3. Create a MySql database called "DreamocCMS"
4. Edit "includes/psl-config.php" to match server-settings
5. Run the setup from “/setup.php”
6. Login with these informations: 
+ Username: test_user 
+ Email: test@example.com 
+ Password: 6ZaxN2Vzm9NUJT2y
7. Create a new user from the user menu and make the user admin.
8. Log out and in with the new user
9. Delete the "test_user" from the user menu
10. You are ready to go!

---

## Optional settings

1. Set a CRON JOB to: http://your-domain.com/path-to-DreamocCMS/cron.php
2. In ”includes/psl-config.php”, you can set “AutofindLocation” to on or off. This will find the location of the computer for you.
3. You can also fill in the default location “defaultLocation” in, where you are located. This is much faster. (Format: “Continent/Capital-name”.