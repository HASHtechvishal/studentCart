<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com str</title>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
	<div class="text-capitalize">
	<h1>install authentication</h1> 
	<ol>
		<li>run cmd composer require laravel/ui --dev</li>
		<li>create database</li>
		<li>php artisan ui vue --auth</li>
	</ol>

	<h1>merge adminLET admin dashboard</h1>
	<ol>
		<li>Download Template :-
Open website https://adminlte.io to download the latest version of AdminLTE 3.</li>
		<li>Merge Template :- 
Now we will start merging AdminLTE template files into our Laravel website. 

We will copy CSS, JS, Images and Plugins from AdminLTE template to our Laravel file structure.
<ul>
	<li>
2.1) Copy CSS Files :- 
We will create admin_css folder under /public/css and copy all CSS files from dist/css/ folder from AdminLTE into it.
</li>
	<li>
2.2) Copy JS Files :- 
We will create admin_js folder under /public/js and copy all JS files from dist/js/ AdminLTE into it.
</li>
	<li>2.3) Copy Images :- 
We will create admin_images folder under /public/images and copy all Images files from dist/img/ AdminLTE into it.</li>
	<li>2.4) Plugins Folder :- 
We will copy plugins folder from AdminLTE folder and paste into public folder in our Laravel website.</li>
</ul></li>
<li>Create admin_layout Folder and admin_layout.blade.php File :-
We will create admin_layout Folder under resources/views/layouts/ path in which we will create admin_layout.blade.php file. </li>
<li>We will copy content from index.html file from AdminLTE folder and paste it into this admin_layout.blade.php file. Before making further changes in this file, we will also create below files under admin_layout Folder :-
<ul>
	<li>admin_header.blade.php file</li>
	<li>admin_footer.blade.php file</li>
	<li>admin_sidebar.blade.php file
</li>
</ul></li>
<li>We will add content into above three files and will also update admin_layout.blade.php file as shown in video.  
<ul>
	<li>In admin_header.blade.php file, add Navbar related code and we will include admin_header.blade.php file in admin_layout.blade.php file like below :-
@,include('layouts.admin_layout.admin_header')</li>
	<li>In admin_footer.blade.php file, add footer related code and we will include admin_footer.blade.php file in admin_layout.blade.php file like below :-.
@,include('layouts.admin_layout.admin_footer')
</li>
	<li>In admin_sidebar.blade.php file, add sidebar related code and and we will include admin_sidebar.blade.php file in admin_layout.blade.php file like below :-
@,include('layouts.admin_layout.admin_sidebar')</li>
</ul></li>
<li>For middle content, add admin_dashboard.blade.php file under admin folder that we will create under /resources/views/ path and we will include in admin_layout.blade.php file like below :-
@,yield('content')</li>
	</ol>

	<h1>admin panel part 2 layout dashboard</h1>
	<ol>
		<li> Update admin_layout.blade.php file :-
First of all, we will update admin_layout.blade.php file to add Laravel asset/url to css/js/images and plugins paths.
</li>
		<li>Update admin_header.blade.php file :-
Now we will update admin_header.blade.php file to add Laravel asset to images paths.
</li>
		<li>Update admin_sidebar.blade.php file :-
Now we will update admin_sidebar.blade.php file to add Laravel asset to images paths.
</li>
		<li>Update admin_dashboard.blade.php file :-
Now we will update admin_dashboard.blade.php file to add Laravel asset to images paths.</li>
		<li>Create AdminController.php file :-
Now create Admin folder under /app/Http/Controllers/ and then create AdminController.php file under Admin folder by running below artisan command :-
php artisan make:controller Admin/AdminController

We will keep all Admin Controllers separate from Front Controllers that will help us to do clear coding.
</li>
		<li>Create Route :-
We will create separate group in web.php file for admin routes so that we can keep them separately with namespace Admin and prefix admin. <br>

We have added dashboard route without any authentication for now but in upcoming videos, we will add Guard Auth for admin routes.
</li>
		<li>Create function :-
We will create dashboard function in AdminController and will return to admin_dashboard.blade.php file.
</li>
	</ol>

	<h1>admin dashboard part3 admin login design</h1>
	<ol>
		<li>Create Route :- 
First of all, create GET/POST route for admin login in Admin route group like below :-
Route::match(['get','post'],'/','AdminController@login');</li>
		<li>Create Function :-
Now create login function in AdminController that will return to admin_login.blade.php file that we will create in next step.
</li>
		<li>Create admin_login.blade.php file :-
Now we will create admin_login.blade.php file in /resources/views/admin/ folder in which we will add content from login.html page from AdminLTE/pages/examples/ folder. We will not add admin design to it as admin design layout with header, footer and sidebar is for the internal pages of admin.
</li>
	</ol>

	<h1>multi auth || guards for admin || auth for users</h1>
	<ol>
		<li>Create Migration File
First of all, we will create migration file with name create_admins_table for creating admins table with below columns :-
id, name, type, mobile, email, email_verified_at, password, image, status

So, we will run below artisan command to create migration file for admins :-
php artisan make:migration create_admins_table

Open create_admins_table migration file and add all required columns mentioned earlier.
           
Now we will run below artisan command to create admins table with required columns :- 
php artisan migrate</li>
		<li>Create Admin model :-
Now we will create Admin model with below artisan command :-
php artisan make:model Admin

We will update content of Admin model file to set protected guard variable for admin and set other variables as shown in video.

We will also extends Admin class to Authenticatable and add its namespace as well.
</li>
		<li>Update auth.php file :-
We will update auth.php file located at config\auth.php to set guards for admin to assign session in driver and admins in provider as shown in video.

We will also set providers for admins to assign eloquent in driver and Admin class in model.
</li>
		<li>Create Admin Middleware :-
Now we will create Admin Middleware file by running below command :-
php artisan make:middleware Admin
</li>
		<li>Update kernel.php file :-
Now we will update kernel.php file located at app\http\ folder to register Admin middleware as global as shown in video.
</li>
		<li>Update Admin Middleware
Add Auth:guard check in Admin Middleware to protect the admin routes. This check will be false for now as we have not registered the admin guard yet. 
</li>
		<li>Update web.php file :-
Add admin middleware group and move admin dashboard route under it to protect it from unauthorised access.

Now no one can access admin dashboard without login into the admin panel.  We have used Guards to protect the admin routes including dashboard route.

In next video, we will work on admin login and logout functionality. We will register admin guard every time when admin logged in and destroy it every time when admin logged out from the admin panel.
</li>
	</ol>

	<h1>database seeding || writing seeders || running seeders</h1>
	<span>Seeding helps us to insert data into table from file and will also help us for future projects to automatically create table with migration and data with seeding. 
</span>
<p>
We will create Seeding for admins table to automatically insert admin data from file and it will help us in our next project as well.
</p>
	<ol>
		<li>Writing Seeder / Create AdminsTableSeeder file :-
First of all, we will generate seeder and create AdminsTableSeeder file where we will add record for admins table.

Run below artisan command to generate Seeder and create AdminsTableSeeder file :-
php artisan make:seeder adminsTableSeeder

Above command will create AdminsTableSeeder.php file at \database\seeds\

Now open AdminsTableSeeder file and add record for admin.

We will generate hash password for admin by using Hash::make function as shown in video.
</li>
		<li>Update Admin model :-
Now we need to update Admin model to add all admins table columns in fillable array as shown in video.
</li>
		<li>Update DatabaseSeeder.php file :-
Now update DatabaseSeeder.php file located at database/seeds/ to add AdminsTableSeeder class as shown in video.
</li>
		<li>Running Seeders / Run below command :-
Once you have written your seeder, you may need to regenerate Composer's autoloader using the dump-autoload command:
composer dump-autoload
</li>
		<li>Run below command :-
Now run last command that will finally insert admin record into admins table that we can use for admin login.
php artisan db:seed

You can see in video; we able to generate record for admins table with hash password.
</li>
	</ol>

	<h1>multi authentication || admin panel login with guard</h1>
	<ol>
		<li>Update admin_login.blade.php file :-
First of all, we will update admin_login.blade.php file to update Login form. We will set its action, CSRF token, username (email) and password.
</li>
		<li>Update login function :-
Now we will update login function at AdminController. We will add the condition for posted data and use guard for admin login as shown in video.
You can try login with username admin@admin.com and password 123456 that we have set in last video with Seeding.

Once logged in, we will redirect the user to Dashboard page and if the username or password is incorrect then we can redirect back the user and flash error message in admin login page.
</li>
		<li>Update admin_header.blade.php file :-
Remove all unwanted code and add "Logout" link for the user at top right side of the header as shown in video.
 </li>
		<li>Create Route :-
Now we will create GET route for Admin Logout in web.php file like below :-

// Admin Logout
Route::get('logout''AdminController@logout'); 
</li>
		<li>Create logout function :-
Now we will create logout function in AdminController in which we will unset admin guard as shown in video. </li>
		<li>Update admin_login.blade.php file :-
Update admin_login.blade.php file to show the error message if admin user or password is incorrect.

We can get the "error message alert bootstrap" script from below website :-
https://getbootstrap.com/docs/4.0/com...

Now check in video, we able to login in admin panel with Guard and logout as well. If username or password is incorrect then we are displaying error message in admin login page.</li>
	</ol>
	<h1>laravel validations</h1>
	<ol>
		<li>Update login function :-
Update login function located at AdminController and write validator code for email and password as shown in video.

Take help from https://laravel.com/docs/6.x/validati... for writing validation logic.
</li>
		<li>
2) Update admin_login.blade.php file :-
Now update admin_login.blade.php file to display the error if validation fails for email and password. You can check this at Laravel website under "Displaying The Validation Errors" section.
https://laravel.com/docs/6.x/validati...
</li>
		<li>Update Header Statement :-
Now add below statement at the top of AdminController to include Validator class for Laravel validation :-
use Validator;

Check now validation is working fine in admin login form. Default error message will come for email and password but we can write custom error message for email and password.</li>
		<li>Update login function :-
For custom error messages, we will write validation logic in one array and custom error messages in another and then validate them as shown in video.

We will learn more about Laravel validations in future videos when we work on other forms. 

In next video, we will work on settings page for change password functionality.

</li>
	</ol>

	<h1>change password part 1 || setting page</h1>
	<ol>
		<li>Create Route :- 
First of all, create GET route for settings page in web.php file like below :-
Route::get('settings', 'AdminController@settings');

We will also keep this route in admin middleware Route::group to protect it from unauthorized access.</li>
		<li>Create settings function :- 
Now we will create settings function in AdminController that we will return to setting blade file.
</li>
		<li>Create admin_settings.blade.php :-
Now we will create admin_settings.blade.php file similar to admin_dashboard.blade.php file that we have created earlier on.

Now copy the form design content from AdminLTE template from path /pages/forms/general.html

We will add email, current password, new password and confirm password fields.
</li>
		<li>Update settings function :- 
Now we will update settings function in AdminController to get the current admin details like email and password from Auth guard admin and return to settings page.
</li>
		<li>Include Admin Model :-
Now we will include Admin model at top of the AdminController like below :-
use App\Admin;
</li>
		<li>Update admin_settings.blade.php :-
Now we will update settings page and will show email in update password form that we have got from settings function at AdminController from admin guard.
</li>
		<li>Update admin_header.blade.php file :-
Now we will also update admin header to show settings link along with admin name and type who logged in.
</li>
	</ol>

	<h1>change password part 2 || check current password with ajax</h1>
	<ol>
		<li>Update admin_settings.blade.php file :-
First of all, we will update "Update Password" form by adding action, name, id to form. </li>
		<li>Create admin_script.js file :-
First of all, we will create admin_script.js file at /public/js/admin_js/ folder. Then we will add Jquery/Ajax in this file to check if current password entered by the admin is correct or not.
</li>
		<li>Update admin_layout.blade.php file :-
Now we will include admin_script.js file in admin_layout.blade.php file.
</li>
		<li> Create Route :-
Now we will create POST route in web.php file for checking current password that we have passed via Ajax URL :- 
Route::POST('check-current-pwd','AdminController@,chkCurrentPassword');
</li>
		<li>Create chkCurrentPassword function :-
Now we will create chkCurrentPassword function at AdminController in which we will check if current password entered by admin is correct or not. We will return true or false to Ajax to display the message at update password form.
</li>
		<li>Update admin_settings.blade.php file :-
Now in admin_settings file, in Password form, below Current password field, we will add one span tag with id to display message that we have returned from Ajax. 

Now we will update our Jquery function. We will check true or false value in Ajax return to display the success or error message in chkPwd ID that we have just created.
</li>
		<li>Update VerifyCsrfToken.php
We will add '/admin/check-current-pwd' route in VerifyCsrfToken.php to exclude it from CSRF verification.

Now see in video, true comes if we give correct password 123456 and false comes if we give incorrect password. And we have added condition in Ajax to display error or success message based on it.

See now in video, message comes based on our current password. So if we give correct password then it shows Current Password is Correct, otherwise Incorrect.
</li>
	</ol>

	<h1>change password part 3 || check/update current admin password</h1>
	<ol>
		<li>Update admin_header.blade.php file :-
First of all, update admin header with Admin name who logged in and Settings page link.
</li>
		<li>Create Route :-
Now we will create POST route in web.php file for updating current admin password :- 
Route::POST('update-current-pwd','AdminController@,updateCurrentPassword');</li>
		<li>Create updateCurrentPassword function :-
Now we will create updateCurrentPassword function to update the current password and set the new password entered by the user but first we will check if current password entered is correct or not. If not correct we will send back the admin to update password form with error message. And if correct then we will compare new password with confirm password, if correct then we will update new password and return success message otherwise will return error message.
</li>
		<li>Update admin_settings.blade.php file :-
Update admin settings page with success and error message div's.
Check in video : Admin can able to update current admin panel password. 
</li>
	</ol>
</div>
</body>
</html>





























