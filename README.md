![PhpMyNewsLetter 2.0](https://github.com/dineshkummarc/phpmynewsletter-2.0/blob/master/screenshot/phpmynewsletter_v2.png)
phpmynewsletter 2.0
===================
# CURRENT VERSION:
v2.0.5

# INSTALLATION
Download the zip file from this repository. Unzip in a directory or at the root of a subdomain dedicated to newsletter, call the install.php script from your browser, fill in the fields, and follow the procedure.

# SYNOPSIS
Send emails, add attachments, manage bounces, track clicks, openings, geolocation, etc ...

# MINIMUM REQUIRED CONFIGURATION:
 - PHP 5.3 min with: imap, curl, openssl, php exec module
 - Mysql 5.x min
 - VPS / linux or dedicated server / linux for access to crontab and management of bounces
 - emails from your correspondents
 - And your little hands to write pretty emails and run great campaigns!

# CHANGELOG:
## GENERAL:
- Full PHP 7 compatibility

## CORRECTIONS:
- Fixed bugs from previous versions
- Improvement of the installation script and correction of the database creation bug
- Improved the quality of opening statistics calculations (browsers, OS, ...)
- Correction of the Geoloc code table (https://www.iso.org/obp/ui/)
- Fixed the bug which altered the css in the messages
- Added "sql_mode = ''" for dedicated servers (tolerance to undefined fields with default values)
- Improvement of the unique_id process, there was a risk of duplicate hash calculations
- Global adaptation for a sub-domain installation
- Improvement of the inventory of emails in error when sending (via phpmailer) as a scheduled task (were not counted)
- Correction of the attachment of DKIM keys
- Correction of the processing of bounce mails
- Addition of the calculation of the table prefix (ex: "pmnl2_") in the config for finer table management
## NEWS:
- Subject fields passed in utf8mb4 to allow use of Emojis
- Pre-Header management
- Menu choice: horizontal with drop-down menus or traditional vertical (global configuration> various settings). Prefer the horizontal menu!
- Choice to display or not display the loader (global configuration> various settings)
- Geolocation of openings (amcharts)
- Creation of templates by a Wysiwyg editor (What You See Is What You Get)
- Creation of rights management (one or more user rights created by an admin) and actions log
- Test of DKIM, SPF and DMARC records of the sending domain
- Backup of the database on demand and download (configurable number of backups)
- Regeneration of a password sent by email if lost
- Possibility for "free mobile" subscribers to receive end of task sending text messages, subscriptions and unsubscriptions
- Use of CDNs for importing JS and CSS libraries (maximum)
- Mandatory verification of the links contained in a message before preview

## BUILT-IN TOOLS:
- Phpmailer 5.2.26
## IMPROVEMENTS:
- Better management of the comparison of versions for possible updates of minor versions
- Display of emails in error by list
- Subscription html code switched in the newsletters settings
## TRACKING MANAGEMENT:
- Geolocation of openings (amcharts)
- Display of clicked links in modal
## MANAGEMENT OF SENT MESSAGES:
- Removal of the phpmynewsletter 2.0 mention at the bottom of sent emails
- Addition of REPLY and BOUNCE emails
## MANAGEMENT OF PLANNED TASKS:
- Fixed the deletion bug of the scheduled task
## LOGS MANAGEMENT:
- Correction of the offset in the columns when there is no log file present
- Display of logs in modal
## SUBSCRIBER MANAGEMENT:
- Calculation of subscriber profile (Subscriber profiles section)
- Pagination of the list of subscribers in error in ajax
## SMTP MANAGEMENT:
- Possible modification of a declared smtp
- Reset counters to 0 (load balancing smtp) during the preview
## EDITORIAL MANAGEMENT:
- Addition of responsive templates (from TinyMCE)
- "pmnl" theme of TinyMCE writing tools
## BOUNCES MANAGEMENT:
- Fixed the bug that prevented the correct deletion of erroneous emails
- Addition of the possibility of a different bounce email from the sender (alias of a Return Path)
- Addition of the array parameter ('DISABLE_AUTHENTICATOR' => 'GSSAPI') to the imap connection to access them to Exchange type mail servers
- Improvement of REGEXP for retrieving bounce mails on Exchange type mail servers

# SCREENSHOT, PREVIEW
## Presentation in vertical menu
! [Vertical menu] (https://www.phpmynewsletter.com/images/2.0.5/vertical_menu.png)
## The new editor in Wysiwyg mode: drag and drop blocks, then customize them
! [Editor in WysiWyg mode] (https://www.phpmynewsletter.com/images/2.0.5/wysiwyg.png)
## Presentation in vertical menu and view of user management
! [Horizontal menu and user management of Phpmynewsletter] (https://www.phpmynewsletter.com/images/2.0.5/account_manager.png)
## The new management of user accounts from PhpMyNewsLetter
! [Management of sender accounts] (https://www.phpmynewsletter.com/images/2.0.5/account_manager.png)
## Detailed management of user accounts
! [Phpmynewsletter user management, details of rights management] (https://www.phpmynewsletter.com/images/2.0.5/account_manager_detail.png)
## Management of SMTPs for load balancing (several smtps = faster distribution of mails)
! [Management of SMTPs for SMTP load balancing] (https://www.phpmynewsletter.com/images/2.0.5/1.jpg)
## Global statistics
! [Statistics] (https://www.phpmynewsletter.com/images/2.0.5/full_stats.png)
## Access to user profiles
! [User profiles] (https://www.phpmynewsletter.com/images/2.0.5/users_profils.png)

# SUPPORT
Support on forum: https://www.phpmynewsletter.com/forum/.

# Roadmap for next version, TODO 2.0.6
- Independent management of templates
- Integration of a form for adding DKIM keys
- Email personalization fields
- Wallpaper customization fields
- Compatibility with Postgresql and MsSQL
- Update with a single click
- PHPMailer 6.x
- Complete English translation
- If you think of something that can improve the product, ask!
 
# LICENSE
GNU GPL

Put a star if you like ;-)
