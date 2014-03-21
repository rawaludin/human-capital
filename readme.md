Sample CRUD app for Laravel
===========================
This app demonstrate how I build crud app using laravel. 


## Database Structure
This app has 3 tables:

jobprefixes :

 Field      | Type             | Null | Key | Default             | Extra          
----------- | ---------------- | ---- | --- | ------------------- | ---------------
 id         | int(10) unsigned | NO   | PRI | NULL                | auto_increment 
 code       | varchar(255)     | NO   | UNI | NULL                |                
 title      | varchar(255)     | NO   | UNI | NULL                |                
 created_at | timestamp        | NO   |     | 0000-00-00 00:00:00 |               
 updated_at | timestamp        | NO   |     | 0000-00-00 00:00:00 |                


functionalscopes :

 Field      | Type             | Null | Key | Default             | Extra          
----------- | ---------------- | ---- | --- | ------------------- | ---------------
 id         | int(10) unsigned | NO   | PRI | NULL                | auto_increment 
 code       | varchar(255)     | NO   | UNI | NULL                |                
 title      | varchar(255)     | NO   | UNI | NULL                |                
 created_at | timestamp        | NO   |     | 0000-00-00 00:00:00 |                
 updated_at | timestamp        | NO   |     | 0000-00-00 00:00:00 |               


jobtitles :

 Field              | Type             | Null | Key | Default             | Extra          
------------------- | ---------------- | ---- | --- | ------------------- | ---------------
 id                 | int(10) unsigned | NO   | PRI | NULL                | auto_increment 
 code               | varchar(255)     | NO   | UNI | NULL                |                
 title              | varchar(255)     | NO   | UNI | NULL                |                
 jobprefix_id       | int(10) unsigned | NO   | MUL | NULL                |                
 functionalscope_id | int(10) unsigned | NO   | MUL | NULL                |                
 status             | tinyint(1)       | NO   |     | NULL                |               
 created_at         | timestamp        | NO   |     | 0000-00-00 00:00:00 |                
 updated_at         | timestamp        | NO   |     | 0000-00-00 00:00:00 |                


With relations one to many from jobprefixes to jobtitles and functionalscopes to jobtitles:

 TABLE_NAME | COLUMN_NAME        | CONSTRAINT_NAME                      | REFERENCED_TABLE_NAME | REFERENCED_COLUMN_NAME
----------- | ------------------ | ------------------------------------ | --------------------- | -----------------------
 jobtitles  | functionalscope_id | jobtitles_functionalscope_id_foreign | functionalscopes      | id                     
 jobtitles  | jobprefix_id       | jobtitles_jobprefix_id_foreign       | jobprefixes           | id                     


## Feature
- Backend validation on model
- Frontend validtion using parsleyjs
- Ajax validation combine model validation rules with parsleyjs (eg. check if jobtitles code is valid)
- Validation before delete parent (jobprefixes/functionalscopes), check child (jobtitles)
- List of data displayed in datatables for easy filter, sorting, and searching using chumper/datatable
 

## Setup
Its really simple to setup this app:
1. Clone or download zip this repository
2. If you don't have composer, then install [composer](http://getcomposer.org).
3. Install package for this app:
   - open terminal, go to app directory
   - run `$ composer install`
4. Change database configuration in app/config/database.php
5. Setup database structure
   - open terminal, go to app directory
   - run `$ php artisan migrate`
6. If needed, you can import sample data
   - open terminal, go to app directory
   - run `$ php artisan db:seed`
7. Run app with PHP builtin server:
   - open terminal, go to app directory
   - run `$ php artisan serve`
   - Access your app in http://localhost:8000/
8. Or, you can run with [virtual host in apache](http://sawmac.com/xampp/virtualhosts/)
9. Thats it, happy learning!


## What you will learn
I add a LOT of comment on this app, make sure you read the source. Also, if you reading my [commit messages](https://github.com/rahmatawaludin/human-capital/commits/master), you will learn some things on how I develop laravel app:
- Setup migrations
- Setup model (with in-model validation)
- Using Eloquent for accessing database and relationship
- Setup controller (with resource url)
- Setup view (with single and usable parent layout)
- Creating form in laravel
- Setup routing
- Setup custom namespace
- Setup flash messages
- and more..

## What you missing
- Testing
- Building package/module
- Authentication & Authorization
- Restfull controller
- Cookie
- and more..

## Contribute
1. fork
2. patch
3. pull!
