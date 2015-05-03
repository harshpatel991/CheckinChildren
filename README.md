# Checkin Children
A daycare facility management application that allows companies to manage their facilities, employees and their customers. Parents can check the status of thier child, notify the facility of late arrival, and receive time-sensitive updates.

## Installation
Prerequisites: PHP 5.4+
MySQL 5.6+
Apache 2.2.29+
Windows/Mac/Linux
Config file (see below)

1. Clone repository in local apache installation directory.
2. Create checkin_children database using MySQL command-line tools or MySQLWorkbench.
    Default DB settings are:
        Name: "checkin_children"
        User: "root"
        Password: ""
    You can change these settings in `CheckinChildren/scripts/models/db/dbCredentials.php` if desired
3. Create `CheckinChildren/config.php` file by following instructions below.
4. Run `CheckinChildren/sql/createDatabase.sql` using MySQL command-line tools or MySQLWorkbench.
5. Run `CheckinChildren/sql/generateTestData.sql` using MySQL command-line tools or MySQLWorkbench.
6. Point browser at location of local apache installation. (ex. `http://localhost/CheckinChildren`)

## Configuration File
You must create a `config.php` file in the root directory with machine-specific settings.
This allows for test environement-dependent variables to be set, and configures the site with personal settings.
Simply copy/paste the following code into `CheckinChildren/config.php`, and replace each field with your personal settings.

    <?php
        class Config
        {
            //Set your personal configurations here.
            static $config = array(
                // Location of your MySql database
                'dbhost' => 'localhost',

                // Name of your MySql database
                'dbname' => 'checkin_children',

                // Local path to your public apache site
                'sitepath' => 'http://localhost:63342/CheckinChildren/public/',

                // Are you using Windows?
                'isWindows' => false,

                // Time to use for testing purposes.  Should be set to '03/04/2015 15:00' for proper testing.
                // Remove this field to use realtime instead.
                'test_time' => '03/04/2015 15:00',

                // IMPORTANT!! Only set to 'false' for production, since this will actually send emails!
                // Should be set to 'true' for any context other than final production.
                'suppress_messages' => true
            );
        }
    ?>

## Full Documentation
CheckinChildren/project_documentation.pdf
## HTTP Tests
CheckinChildren/tests/httptests/tests/
## Unit Test
CheckinChildren/tests/unittests/

## Contributors
Harsh Patel
Alex Dahlquist
Matt Wallick
Nick Samata
Olzhas Alipov
Elzbad Kennedy
