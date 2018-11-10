# User Api platform With JWT token Skeleton
* User Api platform With JWT token Skeleton
* System using DDD architecture & Symfony 4
```
    git clone https://github.com/castroCrea/hackathon.git
    cd hackathon
    install docker
    docker-compose up
    docker-compose exec php-fpm bash
    composer update
    bin/console d:s:u --force
    curl -sL https://deb.nodesource.com/setup_8.x — Node.js 8 LTS "Carbon" | bash -
    apt-get install -y nodejs
    npm install
    ./node_modules/.bin/encore dev
   ``` 
    
    Copy the .env.dist en .env in root path
    
## KEY SSH FOR USER


Generate the SSH keys :

``` bash
 mkdir -p config/jwt # For Symfony3+, no need of the -p option
 openssl genrsa -out config/jwt/private.pem -aes256 4096
 openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

In case first ```openssl``` command forces you to input password use following to get the private key decrypted
``` bash
 openssl rsa -in config/jwt/private.pem -out config/jwt/private2.pem
 mv config/jwt/private.pem config/jwt/private.pem-back
 mv config/jwt/private2.pem config/jwt/private.pem
```


    
##URL

   ### Main url : http://localhost:8000/api
   
   ### create User : http://localhost:8000/api/users
   ####HEADER
        Content-Type : application/json
   ####Body   
   ```
        {
          "fullname": "strings",
          "username": "strings",
          "usernameCanonical": "strings",
          "email": "strings",
          "emailCanonical": "strings",
          "plainPassword": "strings",
          "lastLogin": "2018-06-12T14:37:31.902Z",
          "confirmationToken": "stringz",
          "enabled": true,
          "superAdmin": true,
          "passwordRequestedAt": "2018-06-12T14:37:31.902Z"
        }
   ```
   
   ### Login User : http://localhost:8000/login_check
   ####Body    
        form-data
        
        _username: string
        _password: string
        

