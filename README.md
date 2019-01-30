# contact form extension 

example implementation for a talk: https://speakerdeck.com/moveelevator/architektur-in-php-applikationen

## build js and css files with gulp
1. install npm
    ```
    npm install
    ```
2. install gulp for cli
    ```
    npm install -g gulp-cli
    ```
3. run gulp
    ```
    gulp
    ``` 
    * if gulp is installed from another user, please use [npx](https://www.npmjs.com/package/npx) and run:
        ```
        npx gulp
        ``` 

# checks

* phpunit
    ```
    php vendor/bin/phpunit.phar -c phpunit.xml --debug --verbose
    ```
