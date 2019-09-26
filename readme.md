<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Inventrix

Inventrix is a web application that allows the recording and management of Inventory items, it is build on the laravel 5.6 framwwork,
it operates on two user role states and uses JWT toke for its authentication.

Various characteristic of inventrix and its mode of operation shall be highlighted further below.



Inventrix is accessible, simple, and easy to use web application.

## Authentication

Inventrix authenticates users with JWT token, as its application web guard's driver, set in /config/auth.php , has been set to use the jwt authentication library.

The JWT token saves an authenticated user's information as string of various characters, which can be authenticated and used to get user's information when needed. 



    'guards' => [
        'web' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
    ],



This functionality has been made possible with the integration of the Tymon JWT authentication library,into the application.
The application does all authentication with the Tymon JWT authentication library, it authenticates all requests made by a user/admin before aloowing access into the application.


## User - user role

The user user role,once authenticated, has the ability to  perform CRUD operations on inventory items he/she created, but has no ability to perform any operation on users.

All requests from a user is authenticated via the jwt token generated during login, any unauthenticated requests shall throw an exception.




## Admin - user role

The admin user role, once authenticated, has the ability to perform CRUD operations on all inventory items and all users,all requests from the admin user role is authenticated and certified to contain the JWT token before the application proceeds to process the request.

## Controllers

--- The Admin Controller
	It handles all methods that has to do with the special capabilities of the admin user role, it containns methods to create, Read, Update, and Delete as an admin user on the Inventrix appliccation


---	The User Controller
	It handles methods that registers a user, authenticates a user,handles all users operations on inventory items, it is used for both the admin user-role and the user user-role in the application

---The Inventory Controller
	It handles all functionalities to be performed on inventory items.	

## Database

Inventrix is connected to a Mysql database, it currently uses the users table, inventories table, and the reset_password table to perform all its funtions.

## Test Users

---admin user-role
Email - tunde@tunixsystems.com
password - 1234567

---user user-role
Email - morscino@gmail.com
password - 1234567

##  License

Inventrix is an open source application.
