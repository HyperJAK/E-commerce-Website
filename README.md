# <span style="color:purple">E-Commerce website</span>  
This is a university Web development 2 class final project. Our objective is to make an e-commerce website using laravel as backend and a random template for frontend.  

### To Install Dependencies  

For vendor package (Anything Backend): 
```bash
composer install
```  
For node_modules (Anything Frontend): 
```bash
npm install
```

<span style="color:red">(Important, read!)</span>  
First of all there might not be a need to run xampp terminal or anything related.  
Just make sure you have the mysql80 service running and your mysql app open and it should automatically create the database.  


--Then change .env files in base project dir accordingly, specifically change the database mysql section to match your database configuration. 



### To Start
<details>
<summary>MySQL Script for Db:</summary>
<br>  

```bash
php artisan migrate
```

</details>  

<details>
<summary>MySQL Insert test data:</summary>
<br>  

```bash
php artisan db:seed
```

</details>

<details>
<summary>Commands to run scripts testing from ide using ORM syntax:</summary>
<br>
-Open terminal and run:

```bash
php artisan tinker
```


-Then run script like: 

```bash
$user = User::where('username', 'john_doe')->first();
$cart = $user->cart; 
```

</details>  

### To run laravel  
```bash
(This doesnt work now because of an unknown bug :( ))
php artisan serve
```
#
# Overview  

