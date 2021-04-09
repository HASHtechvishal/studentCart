<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com str10</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="text-capitalize">
		<h1>my account part 1 || update user contact detail | validate</h1>
		<ol> 
			<li>Create Route :-
First of all, create GET/POST route for account page in web.php file :-
// Users Account Page
Route::match(['GET','POST'],'/account','UsersController@account');</li>
			<li>Create account function :-
Now Create "account" function in UsersController that we will return to account.blade.php file.</li>
			<li>Create account.blade.php file :-
Now create account.blade.php file similar to login_register.blade.php file and add account and update password forms.<br>We will show name, address, city, state, country, pincode and mobile fields that user can update. And email will be shown as read only that user can't update.</li>
			<li>Update account function :-
Now we will update account function to return current user details to show in account form.</li>
			<li>Update account.blade.php file :-
Now update account form again to show user details in form that user can update.</li>
			<li>Update front_script.js :-
Now we will add jquery validation for account form as well same like register form. We will add validations for name and mobile only, rest fields are optional.</li>
			<li>Update account function :-
Now update account function again to receive posted account form data and update users table.</li>
		</ol>

		<h1>my account part 2 || create countries table / select box</h1>
		<ol>
			<li>Import countries table :- 
First of all, we will search and import countries table. We can search in Google for keyword like "countries mysql" and open below link :-
https://github.com/raramuridesign/mys...<br>Simply copy and paste mysql code in Phpmyadmin and we will rename apps_countries table to countries table.</li>
			<li>Create Country Model :-
Create Country model by running below command :-
php artisan make:model Country</li>
			<li>Update account function :-
Now we will get all countries from countries table in account function in UsersController and return to account blade file.</li>
			<li>Include Country model :-
Include Country model at the top of UsersController like below :-
use App\Country;</li>
			<li>Update account.blade.php file :-
Now we will replace country text field with select box and add foreach loop to show all countries in countries select box in account form.</li>
		</ol>

		<h1>my account par 3|| create country table/ select box</h1>
		<ol>
			<li>Update account.blade.php file :-
First of all, we will add Current Password, New Password and Confirm Password fields with action as update-user-pwd.</li>
			<li>Update front_script.js file :-
Now we will add jQuery function in front_script.js file that will check whether current password is correct or not via ajax/route/function. <br>We will also add jQuery validation for our password form.</li>
			<li>Create Route :-
Now we will create POST route for checking current password in web.php like below :-
// Check User Current Password
Route::post('/check-user-pwd','UsersController@chkUserPassword');</li>
			<li>Create "chkUserPassword" function :-
Now we will create "chkUserPassword" function in UsersController file to check whether current password is correct or not. If correct then we will send true otherwise false based on which we will display message under current password field.</li>
			<li>Resolve 419 Error : 
If in case 419 error comes then follow below steps to resolve :-
 <ul>
  	<li>Add meta statement in front_layout blade file as shown in video.</li>
  	<li>Update jQuery function in front_script.js file for csrf-token  as shown in video.</li>
  </ul> </li>
			<li>Update Header Statements :-
Add below header statement in UsersController file :-
use Illuminate\Support\Facades\Hash;</li>
			<li>Update front_script.js file :-
We need to update our jQuery function once again to set another id that depends upon true or false response.<br>If response is false then we will display Incorrect Password and if response is true then we will display Correct Password and its value we are going to display under Current Password field.</li>
			<li>Update account.blade.php file :-
Now we will update account blade file with chkPwd id that we will display under current password to tell whether current password entered by user is correct or not.<br>So now you have seen in video, we able to display "Current Password is correct" or "Current Password is incorrect" message under Current Password field.</li>
			<li>Create Route :-
Now we will create post route in web.php file for updating user password and we call the "updatePassword function.
Route::post('/update-user-pwd','UsersController@updatePassword');</li>
			<li>Create "updatePassword" function :-
Now we will create "updatePassword" function in UsersController to update the user password. First we will check once again whether the current password of the user is correct and if correct then we will update the user password whatever user entered.</li>
		</ol>


		<h1>protect laravel website route || ad middleware Auth group</h1>
		<ol>
			<li>Update web.php file :-
We will update web.php file and add middleware auth group in which we will add account and password routes that we have added in last few videos.
<br>We will also update login/register route like shown in video.
<br>Now all the front routes that we want to prevent from users like account and password routes can not be accessible without login.</li>
		</ol>

		<h1>create custom helper file for common function | total cart item</h1>
		<p>We will create common function totalCartItems in Helpers file that we can use anywhere in our website to show total items added in user shopping cart.</p>
		<ol>
			<li>Create Helpers folder and Helper.php file :-
First of all, we will create Helpers folder under /app/ and Helper.php file under Helpers folder</li>
			<li>Update composer.json file :-
Now, update composer.json file to include Helper.php file path </li>
			<li>Run below composer command :-
composer dump-autoload</li>
			<li>Create totalCartItems function :-
Now we will create totalCartItems function in Helper.php file in which we will return total cart items count based on user id if user logged in otherwise session id if user not logged in.</li>
			<li>Include Cart model :-
Also include Cart model to Helper.php file</li>
			<li>Update front_header.blade.php file :-
Now we will call totalCartItems function at front_header.blade.php file to display total cart items count added by the user along with the shopping cart link. We will also add totalCartItems class so that we can update total cart items count via ajax as well.</li>
			<li>Update front_sidebar.blade.php file
Now we will also update front_sidebar.blade.php file to display total cart items count.</li>
			<li>Update updateCartItemQty function :-
Now we will update updateCartItemQty function located at ProductsController to call totalCartItems function to get total cart items count and return to Ajax response from where we will display with class totalCartItems.</li>
			<li>Update deleteCartItem function :-
Now we will update deleteCartItem function to call totalCartItems function to get total cart items count and return to Ajax response from where we will display with class totalCartItems.</li>
			<li>Update front_script.js file :-
Finally, we will update "Update Cart Items" and "Delete Cart Items" jQuery located at front_script.js file to get totalCartItems in response and display with class totalCartItems.<br>Now check in video, We able to show total cart items count at header, sidebar and in shopping cart. Count updates without refresh.</li>
		</ol>
</div>
</body>
</html>