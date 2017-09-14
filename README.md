# Popular-PHP-Repositories-on-GitHub
PHP application to interact with GitHub Rest API v3 and displaying most starred PHP projects on GitHub.

# Architecture
The Workflow of the application is
Index File (View) -> Load Data (Logic/Controller), The LoadData file interacts with 3rd party API, collects the data and saves to the database (Model). Once the data is saved to the database it is redirected to Display List (View) and then Display Item (View).

# Technologies Used
WAMP SERVER 3.0.6
-> PHP 5.6
-> Apache 2.4
-> MySQL 5.7
HTML5, CSS and JS.

# Installation Steps
1. Download and Install WampServer 3.0.6
2. Clone this repository to your computer and move the ApiProject folder to C:\wamp(64)\www
3. Add 127.0.0.1 localhost to your hosts file.
4. Enable mod_rewrite in Apache.
5. Log into PhpMyAdmin using URL "http://localhost/phpmyadmin/index.php" with username "root" and passowrd "".
6. Find the SQL file (Query.sql) in the project folder. Import the sql file and run the queries.
7. Enter http://localhost/ApiProject in your browser window.
