<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com str10</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="text-capitalize">
		<h1>login/register process(1) | embed login/register from/design</h1>
<p>For Admin Panel, we have used guards and now for users at front end, we are going to use default Auth.</p>
<ul>
	<li>User Login/Registration Process
<ol>
	<li>Embed User Login/Registration form/design</li>
<li>Register/Insert user in users table if not already exists</li>
	<li>Apply Laravel Validations for User Register Form</li>
	<li>Send User Register Email Offline</li>
	<li>Send User Register SMS Offline</li>
	<li>Apply Validations for User Login Form</li>
	<li>Auth::attempt to login user</li>
</ol></li>
</ul>

		<ol>
			<li>Create Route :-
First of all, create Get/Post route for login/register page in web.php file like below :-
// Login/Register
Route::match(['get','post','/login-register','UsersController@loginRegister']);</li>
			<li>Create UsersController :-
Now create UsersController at /app/Http/Controllers/Front/ with below artisan command :-
php artisan make:controller Front/UsersController</li>
			<li>Create loginRegister function :-
Now create loginRegister function in newly created UsersController.</li>
			<li>Create login_register.blade.php file :-
Now create login_register.blade.php file in which we will add front design and middle content we will copy from login.html file located at E-shop template.</li>
		</ol>

 <h1>login/register process(2) || update user table || submit register form</h1>
 <ol>
 	<li>Update users table (With Migration) :-
First of all, we will run below command to create migration file in which we are going to add new columns for users table.
<br>php artisan make:migration add_columns_to_users
<br>Now we will add required columns like mobile, address, city, state, country, pincode and status for users table in migration file.<br>Now we will run below command to add columns in users table :-
php artisan migrate
<br>Check users table is updated with additional columns.</li>
 	<li> Update login_register.blade.php file :-
Now we will update register form to add action as /register with csrf token along with proper id and name for all fields.</li>
 	<li>3) Create registerUser function :-
Now we will create registerUser function to accept the register form user data in post method and will debug whether posted user data is coming correctly.</li>
 </ol>

 <h1>login/register process 3 || registet/insert iser with default auth</h1>
 <ol>
 	<li>Update registerUser function :-
We will update registerUser function to check if the user is not already exists in users table and if not exists then going to insert the user in users table by converting the password to hash string with bcrypt function. And, we will use default auth to register the user.</li>
 	<li>Update login_register.blade.php file :-
Update login_register.blade.php file once again to show error message in case user already exists and we will use this error alert for other validations as well later on.</li>
 	<li>Create Logout Route :-
Now we will create get logout route in web.php file to logout the user.
// Logout User
Route::get('/logout','UsersController@logoutUser');</li>
 	<li>Create logoutUser function :-
Now create logoutUser function in Front\UsersController from where we will logout the user and redirect the user to index or login/register page again.</li>
 	<li>Update front_header.blade.php file :-
Now we will update front_header.blade.php file to show "My Account" and "Logout" links when the user is logged in and we will use Auth::check to verify whether the user is logged in.</li>
 </ol>

 <h1>login/register process 4 || jquery validation for form</h1>
 <ol>
 	<li>Search and Download jQuery Form Validation Script :-
Search "jquery validation" on Google and open "https://jqueryvalidation.org" website to download jQuery script for form validation.<br>Click to download source code in zipped format and unzip/run it in your apache/xampp server to check if validations are working fine for form as shown in video.
</li>
 	<li>Add jquery.validate.js :-
Now add jquery.validate.js file from jquery-validation-1.19.2/dist/ folder of jQuery source code downloaded.<br>And add path for jquery.validate.js at front_layout.blade.php file. </li>
 	<li>3) Update front_layout.blade.php file :-
Now we will update front_layout.blade.php file to write jQuery to add rules and messages for Register form. <br>We will take help from index.html file located in demo folder downloaded earlier.
<br>We will also use remote function of jQuery to check if email already exists.</li>
 	<li>4) Create Route :-
Now we will create GET/POST route in web.php file for checking email with remote function of jQuery. We will check whether email already exists or not.<br>
// Check if User already exists
Route::match(['GET','POST'],'/check-email','UsersController@checkEmail');</li>
 	<li>Create checkEmail function :-
Now we will create checkEmail function to check if email already exists. if email count is greater then 0 then we will return false otherwise true.<br>Now check in video, we able to validate Register form with jQuery.</li>
 </ol>

 <h1>login/register part 5 || login user with default auth | validate</h1>
 <ol>
 	<li>Update login_register.blade.php file :-
First of all, update login form with id as loginForm and action url as /login and also add email, password id's.</li>
 	<li>Create loginUser function :-
Now create loginUser function at UsersController in which we will get posted data i.e. email and password. We will check with Auth::attempt and will redirect back with error message in case email or password is incorrect.</li>
 	<li> Update front_script.js :-
Add jQuery validation for email and password fields of login form at front_script.js file</li>
 	<li>Update login_register.blade.php file :-
Now add error message alert div at login_register.blade.php file to show error message in case email or password is incorrect.</li>
 </ol>

 <h1>login/register part 6 || update cart while login/register</h1>
 <ol>
 	<li>Update loginUser function :-
First of all, we will update loginUser function at UsersController to update cart with user id when the user is logged in after adding product in cart.</li>
 	<li>Update registerUser function :-
Now, we will update registerUser function at UsersController to update cart with user id when new user is registered after adding product in cart.</li>
 	<li> Update addtocart function :-
Now, we will update addtocart function at ProductsController to update user_id in cart table in case user is already logged in and add product in cart.</li>
 </ol>

 <h1>login/register part 7 || send register SMS||sms api with curl</h1>
 <p>Please note that we will just tell you the steps to integrate the SMS API in website with Curl but for actual integration in website, you need to buy 3rd Party SMS Package. </p>
 <ol>
 	<li>Download Curl Script :-
First of all, open Sitemakers.in website and click on "Stack Developers" at the top to click on "Download Free SMS API Script with Curl (Use with any 3rd Party SMS API)"</li>
 	<li>Login with Username 'stackdevelopers' and password 'laravelwithamit' to download zipped format of SMS API.</li>
 	<li>reate Model :-
Now create Sms model with below artisan command :-
php artisan make:model Sms</li>
 	<li>Create sendSms function :-
Now create sendSms function in Sms model in which we will send $message and $mobile as parameters and copy SMS script that we have downloaded from Sitemakers.in earlier.<br>We will send $message and $mobile along with other params to 3rd party API URL via Curl.</li>
 	<li>Update registerUser function :-
Now we will update registerUser function to call sendSms function and send message and mobile as parameters to the sendSms function.<br>Now every time when user registers, he will get SMS to his mobile.<br>Make sure you will buy the SMS package from the 3rd party and you will also get authorization key, sender id and other necessary credentials when you purchase from 3rd party.</li>
 </ol>

 <h1>login/register part 8 || send register email offline|| gmail SMTP</h1>
 <p>We are required to do some email settings to send email offline. We will use Gmail SMTP server to send email from offline from apache server.<br>Please follow below steps to configure gmail email settings :-</p>
 <ol>
 	<li>First login to your Google account and under Security, enable "2 step verification".</li>
 	<li>Now generate "App Password" from there that you can use in .env file. 
Select App and Device while generating "App Password". Like I have selected "Mail" and "Mac" as my OS is Mac. You can select "Windows Computer" if your OS is Windows.</li>
 	<li>Open .env file and update Mail credentials like below :- <ul>
 		<li>MAIL_DRIVER=smtp</li>
 		<li>MAIL_HOST=smtp.gmail.com</li>
 		<li>MAIL_PORT=587</li>
 		<li>MAIL_USERNAME=amitphpprogrammer@gmail.com</li>
 		<li>MAIL_PASSWORD=apppassword</li>
 		<li>MAIL_ENCRYPTION=tls</li>
 		<li>MAIL_FROM_ADDRESS=amitphpprogrammer@gmail.com</li>
 		<li>MAIL_FROM_NAME="${APP_NAME}"</li>
 	</ul><p>And, update APP_NAME=E-commerceWebsite at top of .env file that will contain your company name without spaces.
</p></li>
 	<li>Update "register" function at UsersController to add code to send register email.</li>
 	<li>5) Update UsersController files with below header statement :-
use Illuminate\Support\Facades\Mail;</li>
 	<li>Create register.blade.php file to add Html part of register email under \resources\views\emails\ folder. Create emails folder under resources\views\ folder if it does not exists. And add some HTML code as shown in video.</li>
 </ol>
 <p>Now register new account with Yopmail email address that you can use for testing and check register email must comes in your Yopmail email account.
</p>

<h1>login/register part9 || send register email online || gmail</h1>
<p>We will create new email for our website at Godaddy server and will also do Laravel email settings to send emails from our E-commerce website online.</p>
<p>Create Email in Godaddy Server for your website like care@stackdevelopers.in</p>
<p>We will update .env file located at root of the project folder for email settings.</p>
<ol>
	<li>MAIL_DRIVER=sendmail</li>
	<li>MAIL_HOST=smtp.gmail.com</li>
	<li>MAIL_PORT=587</li>
	<li>MAIL_USERNAME=care@stackdevelopers.in</li>
	<li>MAIL_PASSWORD=</li>
	<li>MAIL_ENCRYPTION=tls</li>
	<li>MAIL_FROM_ADDRESS=care@stackdevelopers.in</li>
	<li>MAIL_FROM_NAME="${APP_NAME}"</li>
</ol>

<h1>login/register part 10 || email confirmation process| send activation link</h1>
<ol>
	<li>Update registerUser function :-
First of all, we will update registerUser function at Front\UsersController. We will keep 0 status by default whenever user will register and will make the status 1 when user will confirm his email.<br>Also we will disable register sms and email code and write code for verification email that we need to send to user at the time of registration.
<br>Also, we will remove Auth::attempt from registerUser function and will use this on confirmation of the email.
<br>We will generate activation code by encoding the email and send to user email in link to confirm so that his account will get activated when he clicks on link.
<br>After sending confirmation email, redirect the user back to login/register page with Success message.</li>
	<li>Create confirmation.blade.php file
Now create confirmation.blade.php file to write html of confirmation email that we need to send to user to confirm his email.<br>Now register with new account and check email if confirmation email comes in email account or not. </li>
	<li>Update loginUser function :-
Now update loginUser function to check whether the user account is active or not. If not active means if it is 0 then we don't let the user logged in and display the error message like below.
<br>"Your account is not activated! Please confirm your email to activate your account."
<br>And this error we need to display if user tries to login without confirming his email.
<br>In next video, we are going to confirm email and activate user account.</li>
</ol>

<h1>login/register part 11 || email confirmation || activate user account</h1>
<ol>
	<li>Create Route :-
Create GET/POST Route for confirming user email in web.php file like below :- 
// Confirm Account
Route::match(['GET','POST'],'/confirm/{code}','UsersController@confirmAccount');</li>
	<li>Create confirmAccount function :-
Create confirmAccount function in UsersController in which we will do following :-
 <ul>
  	<li>Get activation code from Route as parameter that we will decode to get user email. </li>
  	<li>Check email if exists otherwise send the user to 404 page.</li>
  	<li>Check status of email if already activated means status is 1 then we will return the user back to login page with message that 'Your Email account is already activated.</li>
  	<li>If email is not activated yet means status is 0 then we will activate the email with status 1 and will send welcome/register email to user.</li>
  	<li>We can return back the user to login page with success message or you can also return the user directly to cart page.</li>
  </ul> </li>
	<li>Create welcome.blade.php file :-
Now create welcome.blade.php file in emails folder for welcome email html same like we have done for register and confirmation emails.</li>
</ol>

<h1>forgot password function || send new password email</h1>
<ol>
	<li>Update login_register.blade.php :-
First we will add "Forgot Password" link under login form at login_register.blade.php file that the user can click to recover his password.</li>
	<li>Create Route :-
Create Get/POST Route for forgot-password in web.php file like below :-
// Forgot Password
Route::match(['get','post'],'forgot-password','UsersController@forgotPassword');</li>
	<li> Create forgotPassword function :-
Now create forgotPassword function at UsersController that will return to forgot_password.blade.php file.</li>
	<li>Create forgot_password.blade.php file :-
Now create forgot_password.blade.php file under views/users folder and create forgot password form with email field that user will fill to get his new password on his email.<br>You can copy content of login_register.blade.php file and replace login form with forgot password form as shown in video.</li>
	<li> Update forgotPassword function :-
Now update forgotPassword function and in post method condition, check if email exists in users table and if email does not exists then return back the user to forgot password page with error message that "Email does not exists".<br>Now we will generate new password that we will encode with bcrypt function and save in users table. After that we will add email code to send forgot password email.<br>We will generate new password with str_random function of Laravel and for using str_random function for Laravel 6 and later versions, we need to install helpers with below composer command :-
composer require laravel/helpers</li>
	<li>Create forgot_password.blade.php file :-
Now create forgot_password.blade.php file under resources/views/emails folder same like register.blade.php file located there and make required changes.<br>At last, return the user to login-register page after sending the forgot password email.<br>Check now in video, forgot password email is working fine. We able to get the new password in email and able to login with that password. </li>
</ol>
</div>
</body>
</html>