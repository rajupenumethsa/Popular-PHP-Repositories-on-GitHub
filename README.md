# Popular-PHP-Repositories-on-GitHub
PHP application to interact with GitHub Rest API v3 and displaying most starred PHP projects on GitHub.

# Architecture
The Workflow of the application is
Index File (View) -> Load Data (Logic/Controller), The LoadData file interacts with 3rd party API, collects the data and saves to the database (Model). Once the data is saved to the database it is redirected to Display List (View) and then Display Item (View).

# Technologies Used
WAMP SERVER 3.0.6
-> PHP 5.6
-> Apache 2.4
-> MySQL 5.7,
HTML5, CSS and JS.

# Installation Steps
1. If your system has Wampserver installed before, move to step 3.
2. Download and Install WampServer 3.0.6
3. Start Wampserver.
4. Clone this repository to your computer and move the ApiProject folder to C:\wamp(64)\www
5. Add 127.0.0.1 localhost to your hosts file (located in windows generally at "C:\Windows\System32\drivers\etc").
6. Enable mod_rewrite in Apache.
7. Log into PhpMyAdmin using your username and password. (username"root" and password "" if wampserver is newly installed).
8. Find the SQL file (Query.sql) in the project folder. Import the sql file and run the queries.
9. Find "db_config" file and update your database settings.
10. Enter http://localhost/ApiProject in your browser window.

# References
https://developer.github.com/v3/
https://developer.github.com/v3/search/
http://www.orchidbox.com/post.php?title=How_to_enable_mod_rewrite_module_in_apache_in_xampp_wamp
