JCliExtended: Joomla Framework & CMS Tool
PHP Cli app to help advanced administrators and developers run tasks from 
command line interface

----------------------------- Requeriments ----------------------------- 
Joomla Plataform 11.1 (CMS Joomla 1.6)
PHP 5.3

----------------------------- How to use ----------------------------- 
@todo
 
----------------------------- Changelog ----------------------------- 
2011-08-06: 0.3alpha

2011-08-06: 0.1alpha
- Start

----------------------------- Objetives -----------------------------
The news lines is now just for internal control, simplificated TDD proposes

***** General usage ***** 
 * Make one tool that run its commands, and also emulate common commands of
shell access
 * Create a few basic core functions of JCliX
 * Make it really extensible
    * 
 * Permit for user manual setup defalt params for each command

***** Interface *****
    [General]
jcli>

    [Inside of one Joomla CMS show one alias]
fititnt.org:jcli>
localhost/joomla18:jcli>

    [Inside of one group Joomla CMS show one alias, to help with batch process]
mygroupofsites:jcli>


    [Inside of one Joomla CMS, AND inside of one especific extension]
fititnt.org:com_content:jcli>
fititnt.org:tpl_beez5:jcli>

    [Inside of one 3rd plugin]
jcli>jts-post>
jcli>jupdate>
jcli>akeebabackup>

    [Inside of one Joomla CMS, AND inside of one especific extension]
fititnt.org:com_content:jcli>
fititnt.org:tpl_beez5:jcli>

    [Maybe...]
jcli>jcd -l ../public_html/fititnt.org

JChanging Directory to /home/fititnt/public_html/fititnt.org
Joomla CMS Site found. Automating loading to JCliX
Alias:              fititnt.org
CMS:                Joomla! CMS 1.7.0           updated
Joomla-platform     11.1                        updated

fititnt.org:jcli>jcli extensions -com

List of fititnt.org components
COMPONENT               | Type |   Status   | Version | Developer
com_admin                 Core     enabled       1.0      Joomla! Project
com_banners               Core     enabled       1.0      Joomla! Project
com_cache                 Core     enabled       1.0      Joomla! Project
com_categories            Core     enabled       1.0      Joomla! Project
com_checkin               Core     enabled       1.0      Joomla! Project
com_config                Core     enabled       1.0      Joomla! Project
com_contact               Core     enabled       1.0      Joomla! Project
com_content               Core     enabled       1.0      Joomla! Project
com_cpanel                Core     enabled       1.0      Joomla! Project
com_installer             Core     enabled       1.0      Joomla! Project
com_languages             Core     enabled       1.0      Joomla! Project
com_login                 Core     enabled       1.0      Joomla! Project
com_media                 Core     enabled       1.0      Joomla! Project
com_menus                 Core     enabled       1.0      Joomla! Project
com_messages              Core     enabled       1.0      Joomla! Project
com_modules               Core     enabled       1.0      Joomla! Project
com_newsfeeds             Core     enabled       1.0      Joomla! Project
com_plugins               Core     enabled       1.0      Joomla! Project
com_redirect              Core     enabled       1.0      Joomla! Project
com_search                Core     enabled       1.0      Joomla! Project
com_templates             Core     enabled       1.0      Joomla! Project
com_users                 Core     enabled       1.0      Joomla! Project
com_weblinks              Core     enabled       1.0      Joomla! Project
fititnt.org:jcli>jcd com_users

Loading com_users from fititnt.org
Name: Component users
Version: 1.7.0 - Unknow 
Author: Joomla! Project
Copyright: (C) 2005 - 2011 Open Source Matters. All rights reserved.
License: GNU General Public License version 2 or later; see	LICENSE.txt

Notices:
- CheckVersion: Unknow if is updated. Use jvc or jversioncheck for check
- CheckVersion: No update site configured
- CheckSecutity: missing index.html
    -> administrator/components/com_users/helpers
Warnings:
- CheckSecutity: missing index.html
    -> administrator/components/com_users/helpers

fititnt.org:com_users:jcli>jbackup -file -database -bkpsfx -sfxtest

jbackup: NOTICE: param -bkpsfx is null. Ignoring
jbackup: WARNING: param -sfxtest does not exist. jbackup aborted

fititnt.org:com_users:jcli>jbackup -file -database -bkpsfx "-sfxtest"

jbackup: adicional params loaded from jcli config.ini
jbackup: backuping files from com_users at fititnt.org
jbackup: packing /administrator/components/com_users/
        *
jbackup: packing /administrator/languages/en-GB/
        en-GB.com_users.ini
        en-GB.com_users.sys.ini
jbackup: packing /administrator/languages/pt-BR/
        pt-BR.com_users.ini
        pt-BR.com_users.sys.ini
jbackup: packing /administrator/languages/overrides/
        pt-BR.com_users.ini
jbackup: packing /components/com_users/
        *
jbackup: packing /languages/pt-BR/
        pt-BR.com_users.ini
        pt-BR.com_users.sys.ini
jbackup: packing /languages/overrides/
        pt-BR.com_users.ini
jbackup: files backup done. Stored at /home/fititnt/.backups/fititnt.org/2011-08
-07_19-24/files/com_users-sfxtest.tar.gz
jbackup: backuping database from com_users at fititnt.org
jbackup: NOTICE: /administrator/components/com_users/users.xml does not have inf
ormation about database tables
jbackup: Force table discover?[y/n]
fititnt.org:com_users:jcli>jbackup>y
jbackup: jcli jdb -seachtable "%users%"
jbackup:jdb: bkp_users
jbackup:jdb: xpto_users
jbackup: Aprove backup tables bkp_users xpto_users? [y/n]
fititnt.org:com_users:jcli>jbackup>n
jbackup: Manual Choose table (y) or exit jbackup [y/n]
fititnt.org:com_users:jcli>jbackup>y
jbackup: Please save array of vars to variable "tables" and return to jbackup.
TIP: You can use save tojcli command "jcli jvarset varvalue"
TIP: You can return jcli command "jcli jreturn jdatabase"
TIP: You can return direct "jreturn varvalue"
fititnt.org:com_users:jcli>jbackup>jcli jvarset -t jbackup:tables ["xpto_users",
 "xpto_usergroups"
jvarset: temporary set var "tables" at namespace jbackup with values
array{
    "xpto_users",
    "xpto_usergroups"
}
fititnt.org:com_users:jcli>jbackup>return tables;
jbackup: backuping database from com_users at fititnt.org
jbackup: packing xpto_users
jbackup: packing xpto_usergroups
jbackup: database backup done. Stored at /home/fititnt/.backups/fititnt.org/2011
-08-07_19-34/database/com_users-sfxtest.tar.gz
fititnt.org:com_users:jcli>jcd ..
fititnt.org:jcli>jcd com_admin

Loading com_admin from fititnt.org
Name: Component admin
Version: 1.7.0 - Unknow 
Author: Joomla! Project
Copyright: (C) 2005 - 2011 Open Source Matters. All rights reserved.
License: GNU General Public License version 2 or later; see	LICENSE.txt

Notices:
- CheckVersion: Unknow if is updated. Use jvc or jversioncheck for check
- CheckVersion: No update site configured
Warnings:
 None

fititnt.org:com_admin:jcli>uninstall
Are your sure that want uninstall com_admin?[y/n]
fititnt.org:com_admin:jcli>y
jcli: uninstall command fail. Result
    Sorry, you cannot unnistall a core component
fititnt.org:com_admin:jcli>sudo uninstall
jcli: jcli sudo unnistall fititnt.org:com_admin
jcli:unnistall: jrm -rf /administrator/components/com_admin
jcli:unnistall: jrm -rf /administrator/languages/en-GB/en-GB.com_admin.ini
jcli:unnistall: jrm -rf /administrator/languages/en-GB/en-GB.com_admin.sys.ini
jcli:unnistall: NOTICE: /administrator/components/com_admin/admin.xml does not h
ave information about database tables
jcli:unnistall: Force table discover?[y/n]
fititnt.org:com_admin:jcli>n
jcli:unnistall: unninstal complete.
jcli:unnistall: jcd ..
fititnt.org:jcli>clone com_banners
jcli:clone is not a jcli command
TIP:seach commands with "jcf name" or "jcommandfind name"
fititnt.org:jcli>jcf clone
jcli:jcf: Looking clone on jcli core
jcli:jcf: 1. -> jdev:clone
    Tool for clone joomla extensions
jcli:jcf: Looking fork on 3rd functions
jcli:jcf: None
fititnt.org:jcli>jdev
Loading
JDev - Tool for developers
Version: 1.0
Author: Joomla! Project
Copyright: (C) 2005 - 2011 Open Source Matters. All rights reserved.
License: GNU General Public License version 2 or later; see	LICENSE.txt
fititnt.org:jcli:jdev>clone com_banners -name "com_mybanners" -silent
fititnt.org:jcli:jdev>jcd ..
fititnt.org:jcli>jdb
fititnt.org:jcli:jdb>check
fititnt.org:jcli:jdb: Checking for mysql database errors
fititnt.org:jcli:jdb: MySQL tables OK
fititnt.org:jcli:jdb: Checking for Joomla CMS database consistency
fititnt.org:jcli:jdb: MySQL tables OK. [3 Notices hidden]
fititnt.org:jcli:jdb> backup -email "fititnt@gmail.com"
jbackup: backuping database from fititnt.org...
jbackup: database backup done. Stored at /home/fititnt/.backups/fititnt.org/2011
-08-07_19-52/database/fititnt.org-sfxtest.tar.gz
jmail: send -email "fititnt@gmail.com" -subject "Database backup of fititnt.org 
at" -atrachment "/home/fititnt/.backups/fititnt.org/2011-08-07_19-52/database/fi
titnt.org-sfxtest.tar.gz"
jrm: "/home/fititnt/.backups/fititnt.org/2011-08-07_19-52/database/fititnt.org-s
fxtest.tar.gz"
jbackup: backup via email done.
fititnt.org:jcli:jdb>exit


***** Splash Screen ***** 
(...)


***** List of commands ***** 