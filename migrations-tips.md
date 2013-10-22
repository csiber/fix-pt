# Make changes to the Database

### Creating Migrations

You must always use the artisan command to generate migrations, because of the timestamp order.

Command:

	php artisan migrate:make <migration_name>
	
Always give migrations descriptive names, like

	add_birthday_date_to_users_table
	create_comments_table
	etc


### Create the Migration System

* Check if your app/config/database.php has the following line 

		'migrations' => 'migrations'

* Run the following command on the root of the project

		php artisan migrate:install
		
	If you have a valid connection to a database it shows you the following notification
	
		Migration table created successfully
		
	You should now have a table called migrations on your database

### Running Migrations

Use the following command to run the migrations

	php artisan migrate
	
If no error occurs, it shows that the migrations have been created.
	
	
### Warnings

Any change that you want to make to the database, never change or update a previous migration, you should always make a new one! Even if you just want to change the name of a column or add another one.

### Rolling Back

If some migration brokes some of the code, leaving the application broken, you can rollback the changes made by a migration using the following command

	php artisan migrate:rollback
	
This commands rolls back only the migrations that were ran the last time we used migrate.



	