v# dockerize_laravel_todo_list
To build a simple application of the to-do list.

You need to build '.env' file for docker-compose (Note: mysql's user is root)
```
DB_NAME=laravel
MYSQL_DBUSER=root
DB_PWD=root_pwd
```

## To Build Steps：
1. `docker-compose build`
2. `docker-compose up -d`
3. `docker-compose exec laravel sh /init.sh`
4. `docker-compose exec laravel composer install -o`
5. `docker-compose exec laravel php artisan jwt:secret`
6. `docker-compose exec laravel php artisan migrate:refresh --seed`

## APIs (JWT):
Root: http://localhost:8008
* generate a new token(login) : [POST] /api/auth/login
    - Get user's token from API, default:
        + email: testtest@gmail.com
        + password: testtest
* refresh a new token : [POST] /api/auth/refresh
* get an information of the token : [GET] /api/auth/token
* get all to-do lists : [GET] /api/todolist/
* get one to-do list : [GET] /api/todolist/{id}
* create one to-do list : [POST] /api/todolist/
* update one to-do list : [PUT] /api/todolist/{id}
* delete one to-do list : [DELETE] /api/todolist/{id}
* delete all to-do list : [DELETE] /api/todolist/


### Note
>  All tasks(list) for any user can access, the app just shows how to build the to-do list(Only on backend).
>