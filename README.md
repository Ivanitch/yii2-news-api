News Feed API Application
===============================================

Api application news feed on php framework Yii2

Install
-------
Clone a project
```
git clone https://github.com/Ivanitch/yii2-news-api.git 
```
Init project
```
php init
```
Install dependencies
```
composer install
```
Run migrations
```
php yii migrate
```
After registration and confirmation by email, you need to set a role for the user
```
php yii role/assign
Username: admin
Role: [admin,user,?]: admin
Done!
```
Configuring a virtual host in Apache
----------------------
```
<VirtualHost *:80>
ServerName api.example.com
DocumentRoot /var/www/html/example.com/api/
</VirtualHost>
```
Usage in REST Client
----------------------
Get the token and timestamp when it expires
```
{
  "username":"username",
  "password":"password"
}
```
Profile info. Method POST
```
http://api.example.com/profile

// Body is empty
```
Add category. Method POST
```
http://api.example.com/category

// Body
{
  "name":"Category name",
  "parentId":1
}
```
Edit category. Methods PUT or PATCH
```
http://api.example.com/category/2

// Body
{
  "name":"Category name update",
  "parentId":1
}
```
Delete category. Method DELETE
```
http://api.example.com/category/2

// Body is empty
```
All categories. Method GET
```
http://api.example.com/category

// Body is empty
```
One category. Method GET
```
http://api.example.com/category/2

// Body is empty
```
Add news. Method POST
```
http://api.example.com/news

// Body
{
  "categories":{
    "main":2,
    "others":{
      "0":4,
      "1":6
    }
  },
  "name":"News name"
}
```
The rest of the news manipulation is similar.