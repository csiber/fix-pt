LDSOT3G
=======
test development

## Database config used in the development

* *database*:fix-pt
* *user*:fix-pt
* *pass*: 123456

## Server configuration

* change in /app/config/app.php 'url' value to what you have in you configuraton
[A successful git branching model](http://nvie.com/posts/a-successful-git-branching-model/) 


##PERMISSIONS

folder app/storage need write permission. 

HOW TO:
-go to app
-type: chmod -Rf 777 storage/


##.htaccess config
If you install the app in the userDir (ex: localhost/~sylwia/fix-pt)
than in the file public/.htaccess you have to specify the RewriteBas
ex: RewriteBase /~sylwia/fix-pt/ldsot3g3/public 

## database scheme
if you have you database working, than you can run this php artisan migrate. It will create a test database. After accessing public/users
it should show a page with users.
