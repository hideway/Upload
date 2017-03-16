### Apache config with .htaccess in file public
    Options -MultiViews
    RewriteEngine On
    
    RewriteBase /
    
    RewriteCond %{REQUEST_FILENAME} -!d
    RewriteCond %{REQUEST_FILENAME} -!f
    
    RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]


### Nginx config uplaod

    worker_processes  4;
    events {
        worker_connections  1024;
    }

    http {
        include       mime.types;
        default_type  application/octet-stream;

        sendfile        on;
        keepalive_timeout  65;

        #gzip  on;

        server {
            listen       80;
            server_name  www.upload.dev upload.dev;
	            root 	     /srv/http/Upload/public;

            location / {
                index index.php index.html;
	            try_files    $uri $uri/ /index.php?url=$uri;
            }

            location ~* ^.+.(jpg|jpeg|gif|css|png|js|ico|xml)$ {
                expires           0; #No cache for dev config
            }

            #error_page  404              /404.html;

            error_page   500 502 503 504  /50x.html;
            location = /50x.html {
                root   /usr/share/nginx/html;
            }

            location ~ \.php$ {
                fastcgi_pass   unix:/var/run/php-fpm/php-fpm.sock;	
                fastcgi_index  index.php;
                fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
                include        fastcgi_params;
            }

        }

    }
