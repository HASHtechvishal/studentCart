<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com str10</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="text-capitalize">
		<h1>coupon codes part 1 || create "coupons" table with migration||seeding</h1>
		<p>In Basic E-com Series, we have added basic coupon functionality but now in Advance E-com Series, we are going to create advance coupon functionality and will add coupon options like below :- <ul>
			<li>Coupon Option :- Manual or Automatic</li>
			<li>Coupon Code</li>
			<li>Single, Multiple or All Categories</li>
			<li>Single, Multiple or All Users</li>
			<li>Coupon Type :- Single or Multiple</li>
			<li>Amount Type :- Percentage or Fixed</li>
			<li>Amount </li>
			<li>Expiry Date</li>
			<li>Enable/Disable</li>
		</ul></p>
		<p>For coupon code functionality, we will work back on admin panel again and make coupon code module there to add/edit/delete and view coupons.<br>In this video, we will create coupons table with Migration and add one dummy coupon with Seeding.<br>We will also create controller and model for coupons.</p>
		<ol>
			<li> Create coupons table :-
First of all, we will create coupons table with migration. Create migration file with name create_coupons_table for creating coupons table with below columns :-
id, coupon_option, coupon_code, categories, users, coupon_type, amount_type, amount, expiry_date, status, created_at, updated_at

So, we will run below artisan command to create migration file for coupons :-
php artisan make:migration create_coupons_table

Open create_coupons_table migration file and add all required columns mentioned earlier.

Now, we will run below artisan command to create coupons table with required columns :- 
php artisan migrate</li>
			<li>Create Coupon model :-
Create Coupon model by running below command :-
php artisan make:model Coupon</li>
			<li>Create CouponsController :-
Create CouponsController by running below command :-
php artisan make:controller Admin/CouponsController
<br>
Now, We will create Seeding for coupons table to insert one dummy coupon. </li>
			<li>Writing Seeder / Create CouponsTableSeeder file :-
First of all, we will generate seeder and create CouponsTableSeeder file where we will add records for coupons table.

Run below artisan command to generate Seeder and create CouponsTableSeeder file :-
php artisan make:seeder CouponsTableSeeder

Above command will create CouponsTableSeeder.php file at \database\seeds\

Now open CouponsTableSeeder file and add query for adding coupons.</li>
			<li>Update DatabaseSeeder.php file :-
Now update DatabaseSeeder.php file located at database/seeds/ to add CouponsTableSeeder class as shown in video.</li>
			<li>Run below command :-
Now run below command that will finally insert records into coupons table.
php artisan db:seed</li>
			<li>For Laravel 8 (Do below changes for Seeding)
If you have upgraded your project to Laravel 8 then you need to make below changes for Seeding to work :-

Add below namespace at top of DatabaseSeeder.php and other Seeder files :-
namespace Database\Seeders;

In addition, move all seeder files from previous database/seeds folder to database/seeders folder.

Finally, you need to update composer.json file to rename seeds to seeders<br>Lastly, run below commands :- <br>
composer dump-autoload <br>
php artisan db:seed
</li>
		</ol>

		<h1>coupon code part 2 || display "coupons" in admin panel</h1>
		<ol>
			<li>Create Route :-
Create GET route for coupons in web.php file under admin Middleware group like below :-
// Coupons
Route::get('coupons','CouponsController@coupons');</li>
			<li>Include Coupon Model :-
Include Coupon model at top of CouponsController
use App\Coupon;</li>
			<li>Create coupons function :-
Create coupons function in CouponsController to get all coupons and return to coupons.blade.php file.</li>
			<li>Create coupons.blade.php file :-
Now create coupons.blade.php file under /resources/views/admin/coupons/ folder to show all coupons there.<br>Now we will work on Active/Inactive status for Coupon</li>
			<li>Create Route :-
Create POST Route for updating coupon status in web.php file like below :-
Route::post('update-coupon-status','CouponsController@updateCouponStatus');</li>
			<li>Create updateCouponStatus function :-
Now create updateCouponStatus function in CouponsController to update the status of the coupon to active or inactive.</li>
			<li>Update admin_script.js file :-
Now update admin_script.js file to add jquery function to update active or inactive status for coupon.</li>
			<li>Update VerifyCsrfToken.php file :-
Add "admin/update-coupon-status" route in $except array at VerifyCsrfToken.php file to skip CSRF token check. <br>Now you can check in video; we able to display coupons and update their status to Active/Inactive.<br>In next video, we will start working on "Add Coupon" functionality.</li>
		</ol>

		<h1>coupon code part 3 || add coupon functionality||select categories</h1>
		<ol>
			<li>Update admin_sidebar.blade.php file :-
First of all, we will add "Coupons" link at left sidebar of the admin panel.</li>
			<li>Create Route :-
Create GET/POST route for add/edit coupon in web.php file like below :-
Route::match(['get','post'],'add-edit-coupon/{id?}','CouponsController@addEditCoupon');</li>
			<li>Create addEditCoupon function :-
Now we will create addEditCoupon function in CouponsController to add and update existing coupon.</li>
			<li>Create add_edit_coupon.blade.php file :-
Now create add_edit_coupon.blade.php file under /resources/views/admin/coupons/ folder in which we will add coupon form to add/update coupon.</li>
			<li>Update addEditCoupon function :-
We will get Sections, Categories and Sub Categories same like we get in Products module to return at Add/Edit Coupon form.</li>
			<li>Update add_edit_coupon.blade.php file :-
Now get categories in foreach loop and show in select box with multiple selection.</li>
		</ol>

		<h1>coupon code part 4 || add coupon functionality|| select users/expiry/other</h1>
		<ol>
			<li>Update addEditCoupon function :-
We will get all user emails and return to Add/Edit Coupon form</li>
			<li>Update add_edit_coupon.blade.php file :-
Now get users in foreach loop and show in select box with multiple selection.</li>
			<li>Update admin_layout.blade.php file :-
We will include jquery.inputmask.bundle.min.js file for expiry date format. Js file we will copy from advanced.html file located at AdminLTE template at path AdminLTE-3.0.2\pages\forms\</li>
			<li>Update admin_script.js file :-
We will also update admin_script.js file to add date scripts from advanced.html file.<br>We will also add script to show text field for coupon code when user select Automatic coupon.<br>Now we able to create Add Coupon form with all Coupon options.</li>
		</ol>
		<h1>add coupon functionaliinsert coupon| validation</h1>
		<ol>
			<li>Update addEditCoupon function :-
We will update addEditCoupon function to receive coupon data from add coupon form and save into coupons table.<br>We are required to convert categories and users array data to string with import function.<br>We will set status of coupon to 1 by default.<br>Finally, we will redirect to coupons page after adding coupon details to coupons table.</li>
			<li>Add Laravel Validation :-
Now we will add Laravel and HTML 5 validation for the coupon form.</li>
		</ol>

		<h1>coupon codes patr 6 || edit/delete coupon</h1>
		<ol>
			<li>Update addEditCoupon function :-
First of all, we will update addEditCoupon function at CouponsController so that we can return selected categories and users to our add/edit coupon form. We will use explode function to convert them to array once again so that we can show them in select boxes.</li>
			<li>Update add_edit_coupon.blade.php file :-
Now we will update add_edit_coupon.blade.php file to show all coupon data in add/edit coupon form including selected categories and users. We will use in_array PHP function to show selected categories and users in select boxes.<br>Coupon code and Coupon option is not editable and we will show coupon code only in edit coupon form.<br>Other coupon details we able to edit and show in add/edit coupon form.<br>Now we will work on delete coupon functionality.</li>
			<li>Create Route :-
Create Get route for delete coupon with coupon id as parameter in web.php file like below :-
Route::get('delete-coupon/{id}','CouponsController@deleteCoupon');</li>
			<li>Create deleteCoupon function :-
Now we will create deleteCoupon function with coupon id as parameter in CouponsController. We will delete coupon from coupons table and redirect to coupons table with success message.</li>
		</ol>

		<h1>coupon codes part 7|| apply coupon at shopping cart</h1>
		<ol>
			<li>Update cart.blade.php file :-
Update "Apply Coupon" form by adding form action, coupon field and type submit to apply the coupon in Ajax. We will add ApplyCoupon form id to run jQuery to apply Coupon via Ajax.<br>We will pass user as 1 in form if user is logged in so that we can add check in jQuery to ask the user to logged in to apply the coupon.</li>
			<li>Update front_script.js file :-
Add ApplyCoupon jQuery code at front_script.js file where we will first check if user is logged in and if user is logged in then we pass coupon code to apply-coupon route via Ajax to apply the coupon if valid.</li>
			<li>Create Route :-
Now create Post route for apply coupon in web.php file like below :-
// Apply Coupon
Route::post('/apply-coupon','ProductsController@applyCoupon');</li>
			<li>Create applyCoupon function :-
Now create applyCoupon function in CouponsController and check if coupon code is correct or not. If not correct then we will return error message and alert via Ajax response. </li>
			<li>Update front_script.js file :- 
Update response of Ajax to alert error message in case coupon is incorrect and re-load cart items.</li>
		</ol>

		<h1>coupon codes part 8|| apply coupon at shopping cart</h1>
		<ol>
			<li>Update applyCoupon function :-
We will update applyCoupon function and will add all coupon conditions one by one :- <ul>
	<li>Check if coupon is active</li>
	<li>Check if coupon is expired</li>
	<li>Check if coupon is from selected categories</li>
	<li>Check if user is from selected users</li>
</ul></li>
		</ol>

		<h1>coupon codes part 8||apply coupon|| show discount| grand total</h1>
		<ol>
			<li>We will do below steps to apply coupon code and update cart total :- <ul>
				<li>We will first get cart total amount</li>
				<li>We will check if amount type is Fixed or Percentage</li>
				<li>We will calculate coupon discount and add in session variable</li>
				<li>We will update cart page to show coupon discount and update cart total including coupon discount.</li>
			</ul></li>
		</ol>

		<h1>coupon codes part 9|| test coupons | resolve issues || checkout overvoew</h1>
		<ol>
			<li>Update applyCoupon function :-
We forgot to add user condition in applyCoupon function. If coupon is for the selected user then only we will check if the logged in user is the selected user of the coupon. </li>
<li>For Checkout Page, we will work on below :-
<ul>
	<li>Multiple Delivery Addresses</li>
	<li>Review Cart Items</li>
	<li></li>
</ul>Payment Methods</li>
		</ol>
</div>
</body>
</html>