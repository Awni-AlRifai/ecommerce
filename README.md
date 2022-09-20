## ecommerce project 

     to run the project follow this guide

- clone the project 
- **run** ```composer install```
- **run** ```yii php migrate```
- configuring pache on ubentu
    - **run** ``` sudo xdg-open /etc/apache2/sites-available/000-default.conf ```
    - change the files to the follwing 
```
<VirtualHost *:80>
	ServerName test.com
    	ServerAlias www.test.com
        DocumentRoot "/var/www/${project name}/frontend/web"
           
        <Directory "/var/www/${project name}/frontend/web">
            # use mod_rewrite for pretty URL support
            RewriteEngine on
            # If a directory or a file exists, use the request directly
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            # Otherwise forward the request to index.php
            RewriteRule . index.php

            # use index.php as index file
            DirectoryIndex index.php

            # ...other settings...
            # Apache 2.4
            Require all granted
               
            ## Apache 2.2
            # Order allow,deny
            # Allow from all
            </Directory>
</VirtualHost>

<VirtualHost *:80>
        ServerName backend.test
        DocumentRoot "/var/www/${project name}/backend/web"
           
        <Directory "/var/www/${project name}/backend/web">
            # use mod_rewrite for pretty URL support
            RewriteEngine on
            # If a directory or a file exists, use the request directly
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            # Otherwise forward the request to index.php
            RewriteRule . index.php

            # use index.php as index file
            DirectoryIndex index.php

            # ...other settings...
            # Apache 2.4
            Require all granted
               
            ## Apache 2.2
            # Order allow,deny
            # Allow from all
        </Directory>
 </VirtualHost>
```

- move your project inside var/www and make sure you give the write access
- the frontend will be run on ```frontend.test``` and the backed ```backend.test```


  