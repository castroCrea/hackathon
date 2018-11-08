# User Api platform With JWT token Skeleton
* User Api platform With JWT token Skeleton
* System using DDD architecture & Symfony 4
```
    git clone https://github.com/castroCrea/user-api-with-jwttoken.git
    cd user-api-with-jwttoken
    install docker
    docker-compose up
    docker-compose exec php-fpm bash
    composer update
    bin/console d:s:u --force
   ``` 
    
    Copy the .env.dist en .env in root path
    
    
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
        

