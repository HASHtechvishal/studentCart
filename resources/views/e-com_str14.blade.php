<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com str10</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="text-capitalize">
	<h1>checkout page part 1||multiple delivery addresses | create table</h1>
	<ol>
		<li>Create delivery_addresses table :-
First of all, we will create delivery_addresses table with migration. Create migration file with name create_delivery_addresses_table for creating delivery_addresses table with below columns :-
id, user_id, name, address, city, state, country, pincode, mobile, status, created_at, updated_at <br>
So, we will run below artisan command to create migration file for delivery addresses :-
php artisan make:migration create_delivery_addresses_table <br> Open create_delivery_addresses_table migration file and add all required columns mentioned earlier. <br> Now, we will run below artisan command to create delivery_addresses table with required columns :- 
php artisan migrate </li>
		<li>Now, we will run below artisan command to create delivery_addresses table with required columns :- 
php artisan migrate <br> Now, We will create Seeding for delivery_addresses table to insert dummy delivery address.</li>
		<li>Writing Seeder / Create DeliveryAddressTableSeeder file :-
First of all, we will generate seeder and create DeliveryAddressTableSeeder file where we will add dummy delivery address for delivery_addresses table.<br>Run below artisan command to generate Seeder and create DeliveryAddressTableSeeder file :-
php artisan make:seeder DeliveryAddressTableSeeder <br>Above command will create DeliveryAddressTableSeeder.php file at \database\seeds\
 <br>Now open DeliveryAddressTableSeeder file and add query for adding delivery address. </li>
		<li> Update DatabaseSeeder.php file :-
Now update DatabaseSeeder.php file located at database/seeds/ to add DeliveryAddressTableSeeder class as shown in video.</li>
		<li>Run below commands :-
Now run below command that will finally insert records into delivery_addresses table.
composer dump-autoload (if required)
php artisan db:seed <br>If in case "Target class [TableSeeder] does not exist" error comes then follow below link to resolve :-
https://stackoverflow.com/a/65377397/...</li>
	</ol>
	

	<h1>checkout page part 2 || display delivery address</h1>
	<ol>
			<li>Create Route :-
Create checkout route if not created yet in web.php file :-
// Checkout
Route::match(['GET','POST'],'/checkout','ProductsController@checkout');</li>
			<li>Create checkout function :-
Now create checkout function in ProductsController that we will return to checkout blade file with userCartItems.</li>
			<li>Create checkout.blade.php file :-
Create checkout.blade.php file at /resources/views/front/product/ folder in which we will show delivery address, cart items and payment methods.</li>
			<li>Create deliveryAddresses function :-
Create deliveryAddresses function at DeliveryAddress.php model in which we will get all delivery addresses of the user.</li>
			<li>Update checkout function :-
Now update checkout function once again to get the delivery addresses and return to checkout blade file.</li>
			<li>Update checkout.blade.php file :-
Update checkout.blade.php file to show delivery addresses one by one with radio button.</li>
		</ol>

		<h1>checkout page part 3|| add multiple delivery address</h1>
		<ol>
			<li>Update checkout.blade.php file :-
First of all, update checkout.blade.php file to add "Add", "Edit" and "Delete" Delivery Address links.</li>
			<li>Create Route :-
Now create GET/POST Route for add/edit delivery address in web.php file like below :-
// Add/Edit Delivery Address
Route::match(['GET','POST'],'/add-edit-delivery-address/{id?}','ProductsController@addEditDeliveryAddress');</li>
			<li>Create addEditDeliveryAddress function :-
Now create addEditDeliveryAddress function at ProductsController in which we will also return countries.</li>
			<li>Create add_edit_delivery_address.blade.php file :-
Now create add_edit_delivery_address.blade.php file at resources/views/products/ path similar to account blade file which we will update further.</li>
			<li>Update addEditDeliveryAddress function :-
Now update addEditDeliveryAddress function at ProductsController to insert the delivery address with in post method when id is empty.</li>
			<li>Update checkout.blade.php file :-
Forget success_message session at checkout page after showing the success message. Do same for error message everywhere.</li>
		</ol>

		<h1>checkout page part 4 || edit delete address</h1>
		<ol>
			<li>Update checkout.blade.php file :-
First of all, update checkout.blade.php file to add "Edit" and "Delete" Delivery Address links.</li>
			<li> Update add_edit_delivery_address.blade.php file :-
We will update add_edit_delivery_address.blade.php file to add condition for action of the form. We will pass address id if user tries to edit delivery address. Also we will show delivery address existing details in delivery address form that user can update.</li>
			<li>Update addEditDeliveryAddress function :-
Make sure to add condition at addEditDeliveryAddress function when id is not empty. We will get the posted data from delivery address form and will update that. <br>Now we will work on deletion of delivery address.</li>
			<li>Create Route :-
Create GET route for deleting delivery address in web.php file like below :-
// Delete Delivery Address
Route::get('/delete-delivery-address/{id}','ProductsController@deleteDeliveryAddress');</li>
			<li>Create deleteDeliveryAddress function :-
Now create deleteDeliveryAddress function at ProductsController in which we will delete delivery address with address id.</li>
			<li>Update front_script.js file :-
Update front_script.js file to add jQuery for confirm of the delete address with class addressDelete.</li>
		</ol>

		<h1>checkout page part 5 || validate delivery address from</h1>
		<ol>
			<li>Update add_edit_delivery.blade.php file :-
Add condition in delivery form to show last added address in case any field is not valid.</li>
			<li>Update addEditDeliveryAddress function :-
Update validation rules in addEditDeliveryAddress function located at ProductsController with custom error messages. <br>Check in video; we able to validate delivery form.</li>
		</ol>

		<h1>checkout page part 6 || show payment method</h1>
		<p>First of all, we will resolve one issue in cart and checkout pages. We will replace "CouponAmount" Session variable with "couponAmount" Session variable where c must be in small instead of caps.</p>
		<ol>
			<li>Update cart_items.blade.php file :-
Replace "CouponAmount" Session variable with "couponAmount" Session variable where c must be in small instead of caps.</li>
			<li>Update checkout.blade.php file :-
Replace "CouponAmount" Session variable with "couponAmount" Session variable where c must be in small instead of caps.<br>Also, add "Shipping Charges" as 0 for the time being. We will work on its complete module to generate Shipping Charges later on.
<br>Now we will add below 2 payment methods at checkout page with radio buttons :-
COD
Paypal
We will add more later on.
<br>We will also generate Session Variable for Grand total.</li>
			<li> Update checkout function :-
Now we will get the address id and payment method at checkout function in posted data condition and will add conditions for both. If empty then we redirect back to checkout page with error message.</li>
		</ol>

		<h1>order placement process part 1 || create order table with migration</h1>
		<ol>
			<li>orders table</li>
			<li>orders_products table <br>We will also create model for orders and orders_products tables. <ol>
				<li>Create orders table :-
First of all, we will create orders table with migration. <br>"orders" table will contain delivery details, coupon / shipping details, grand total and other main information.<br>Create migration file with name create_orders_table for creating orders table with below columns and data types :- <ul>
	<li>id  int(11) primary unique</li>
	<li>user_id  int(11)</li>
	<li>name  varchar(255)</li>
	<li>address  varchar(255)</li>
	<li>city  varchar(255)</li>
	<li>state varchar(255)</li>
	<li>country  varchar(255)</li>
	<li>pincode  varchar(255)</li>
	<li>mobile  varchar(255)</li>
	<li>email  varchar(255)</li>
	<li>shipping_charges float</li>
	<li>coupon_code  varchar(255)</li>
	<li>coupon_amount  float</li>
	<li>order_status varchar(255)</li>
	<li>payment_method  varchar(255)</li>
	<li>payment_gateway  varchar(255)</li>
	<li>grand_total  float</li>
	<li>created_at  datetime</li>
	<li>updated_at  timestamp</li>
</ul><br>So, we will run below artisan command to create migration file for orders table :-
php artisan make:migration create_orders_table<br>Open create_orders_table migration file and add all required columns mentioned earlier.<br>Now, we will run below artisan command to create orders table with required columns :- 
php artisan migrate</li>
			</ol></li>
			<li>Create Order model :-
Create Order model by running below command :-
php artisan make:model Order</li>
			<li>Create orders_products table :-
Now create orders_products table that will have ordered products data that the user going to order.<br>Create migration file with name create_orders_products_table for creating orders_products table with below columns and data types :- <ul>
	<li>id  int(11) primary unique</li>
	<li>order_id int(11)</li>
	<li>user_id int(11)</li>
	<li>product_id int(11)</li>
	<li>product_code varchar(255)</li>
	<li>product_name varchar(255)</li>
	<li>product_color varchar(255)</li>
	<li>product_size varchar(255)</li>
	<li>product_price float</li>
	<li>product_qty int(11)</li>
	<li>created_at datetime</li>
	<li>updated_at timestamp</li>
</ul><br>So, we will run below artisan command to create migration file for orders_products table :-
php artisan make:migration create_orders_products_table<br>Open create_orders_products_table migration file and add all required columns mentioned earlier.<br>Now, we will run below artisan command to create orders_products table with required columns :- <br>php artisan migrate</li>
<li>Create OrdersProduct model :-
Create OrdersProduct model by running below command :-
php artisan make:model OrdersProduct</li>
		</ol>

		<h1>order placement process part 2 || place cod order | insert order</h1>
		<ol>
			<li>Update checkout.blade.php file :-
First of all, update payment_method to payment_gateway in checkout form.</li>
			<li>Update checkout function :-
Now we will update checkout function step by step for inserting the order details in orders tables. <ol>
	<li>Update payment_method to payment_gateway in if condition to make sure payment_gateway is not empty. </li>
	<li>Add condition to assign COD in payment_method variable if payment_gateway is COD otherwise Prepaid in all other cases like Paypal or any others in future.</li>
	<li>From address id, we will get the delivery details of the user that we want to insert in orders table.</li>
	<li>Finally insert delivery address, coupon, shipping details, grand total, payment method etc. in orders table.</li>
	<li>After inserting orders detail in orders table, get last order id.</li>
	<li>Get user cart items from carts table by comparing with user_id.</li>
	<li>Insert all user cart items in orders_products table in foreach loop.</li>
	<li>Include below header statements at top of ProductsController :-
use App\Order;
use App\OrdersProduct;
use DB;</li>
	<li>Use beginTransaction and commit functions of Laravel to secure the query so that no half query run anytime.</li>
</ol></li>
		</ol>

		<h1>order placement process part 3 || place cod order | thanks page</h1>
		<ol>
			<li>Update checkout function :-
After inserting the order details in DB, we will add Session variable for Order Id.
And will redirect to thanks page in case of COD.</li>
			<li>Create Route :-
We will create GET route for thanks page in web.php file :-
<br>// Thanks
Route::get('/thanks','ProductsController@thanks');</li>
			<li>Create thanks function :-
We will create thanks function in ProductsController in which we will empty the cart table. We can remove this empty cart query from checkout function that we have added earlier.</li>
			<li>Create thanks.blade.php file :-
Now create thanks.blade.php file at path /resources/views/front/products in which we will show thanks message to the user with Order Id and Grand total.<br>We will forget Order Id and Grand Total Session variables in thanks page.</li>
			<li>Update thanks function :-
If user refresh thanks page then we will redirect him to cart page. We will check in thanks function if Order Id Session variable is empty then we will redirect to cart page.</li>
		</ol>

		<h1>user order paer 1 || display all order in user account</h1>
		<ol>
			<li>Update front_header.blade.php file :-
First of all, we will update front_header.blade.php file to add "Orders link at top navigation menu.</li>
			<li>Create Route :-
Now we will create GET Route for orders in web.php file :-
// Users Orders
Route::get('/orders','OrdersController@orders');</li>
			<li>Create Controller :-
Now we will create OrdersController at \app\Http\Controllers\Front\ folder :-
php artisan make:controller Front/OrdersController</li>
			<li>Create orders function :-
Now we will create orders function at OrdersController in which we will fetch all user orders.</li>
			<li>Create orders_products function Relation :-
Now we will create orders_products function in Order.php model with hasMany relation in which we will fetch ordered products details of the order.</li>
			<li>Update orders function :-
Now we will update orders function at OrdersController and attach orders_products relation with the query to fetch ordered products as well from orders_products table.</li>
			<li> Create orders.blade.php file :-
Create orders folder at path /resources/views/front/ under which we will create orders.blade.php file </li>
		</ol>

		<h1>user orders part 2 || display complete order details</h1>
		<ol>
			<li>Update orders.blade.php file :-
First of all, we will update orders.blade.php file to add link for order details page at order id.</li>
			<li>Create Route :-
Create GET route for order detail with parameter id in web.php file like below :-
// User Order Details
Route::get('/orders/{id}','OrdersController@orderDetails');</li>
			<li>Create orderDetails function :-
Create orderDetails function with parameter id in OrdersController to get order details. We will also attach orders_products relation to get order product details.</li>
			<li> Create order_details.blade.php file :-
Now we will create order_details.blade.php file and will show order details, delivery address and ordered products details.</li>
		</ol>

		<h1>user orders part 3 || display ordered product images</h1>
		<ol>
			<li>Create getProductImage function :-
We will create getProductImage function in Product model so that we can get main image of the product from product id.</li>
			<li>Update order_details.blade.php file :-
Now we will update order_details.blade.php file again to call getProductImage function to show product images.<br>We will also include Product model at order_details.blade.php file.</li>
		</ol>
</div>
</body>
</html>