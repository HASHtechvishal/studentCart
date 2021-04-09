 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com str10</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="text-capitalize">
  <h1>orders module in admin panel part 1 || display all users orders</h1>
  <ol>
  	<li>Update admin_sidebar.blade.php file :-
First of all, add Orders tab at admin_sidebar.blade.php file with admin/orders link.</li>
  	<li> Create Route :-
Now create GET route for displaying orders in web.php file in admin route group :-
// Orders
Route::get('orders','OrdersController@orders');</li>
  	<li>Create OrdersController :-
Now create OrdersController with below artisan command in Admin folder :-
php artisan make:controller Admin/OrdersController</li>
  	<li>Create orders function :-
Now create orders function in OrdersController to fetch all orders and return to orders.blade.php file.</li>
  	<li>Create orders.blade.php file :-
Now create orders folder in /resources/views/admin/ folder in which we will create orders.blade.php file.</li>
  </ol>

  <h1>order module in admin panel part 2 || show complete oroder details</h1>

  <ol>
    <li>Update orders.blade.php file :-
First of all, update orders.blade.php file to add URL for order detail page.</li>
    <li>Create Route :-
Now create GET Route for order detail page in web.php file with parameter order id. 
Route::get('orders/{id}','OrdersController@orderDetails'); </li>
    <li>Create orderDetails function :-
Now create orderDetails function in OrdersController located at Admin Controllers folder in which we will get order details and return to order detail page.</li>
    <li>Create order_details.blade.php file :-
Now create order_details.blade.php file at path /resources/views/admin/orders/ in which we will show complete order details.<br>We will copy its layout from AdminLTE HTML template from file simple.html located at path /AdminLTE-3.0.2/pages/tables/ 
<br>Copy main content section from line 721 to line 1164 and will make changes in order_details.blade.php file to show order details.<br>We will show Order Details and Delivery Address in the same way like we have shown in front.</li>
  </ol>

  <h1>orders module in admin panel part 3 || show complete order details</h1>
  <ol>
    <li>Update orderDetails function :-
First of all, update orderDetails function to get user details of the user who placed the order and return to order detail page in admin panel.</li>
    <li>Update order_details.blade.php file :-
Now we will update order_details.blade.php file to display customer details, billing address and order status section.</li>
  </ol>

  <h1>orders module in admin panel part 4 || create order_statu table</h1>
  <ol>
    <li>Create order_statuses table :-
First of all, we will create order_statuses table with migration. Create migration file with name create_order_statuses_table for creating order_statuses table with below columns :-
id, name and status<br>So, we will run below artisan command to create migration file for order_statuses :-
php artisan make:migration create_order_statuses_table<br>Open create_order_statuses_table migration file and add all required columns mentioned earlier.<br>Now, we will run below artisan command to create order_statuses table with required columns :- 
php artisan migrate<br>Now order_statuses table has been created with all the required columns.</li>
    <li>Create OrderStatus model :-
Create OrderStatus model by running below command :-
php artisan make:model OrderStatus<br>Now, We will create Seeding for order_statuses table to insert few status from seeder command.</li>
    <li>Writing Seeder / Create OrderStatusTableSeeder file :-
First of all, we will generate seeder and create OrderStatusTableSeeder file from where we will add few order status for order_statuses table.<br>Run below artisan command to generate Seeder and create OrderStatusTableSeeder file :-
php artisan make:seeder OrderStatusTableSeeder<br>Above command will create OrderStatusTableSeeder.php file at \database\seeds\<br>Now open OrderStatusTableSeeder file and add record for order status.</li>
    <li>Update DatabaseSeeder.php file :-
Now update DatabaseSeeder.php file located at database/seeds/ to add OrderStatusTableSeeder class as shown in video.</li>
    <li>Run below commands :-
Now run below commands that will finally insert product into order_statuses table.
composer dump-autoload (if required)
php artisan db:seed</li>
  </ol>

  <h1>order module in admin panel part 5 || show/update order status</h1>
  <ol>
    <li>Update orderDetails function :-
First of all, we will update orderDetails function to get all order status from order_statuses table and return to order detail page in admin panel.</li>
    <li>Update order_details.blade.php file :-
Now we will update order_details.blade.php file to show all order status dynamically in foreach loop in select option. We will also add form with order_id as hidden.</li>
    <li> Create Route :-
Now we will create POST route in web.php file for updating order status :-
Route::post('update-order-status','OrdersController@updateOrderStatus');</li>
    <li>Create updateOrderStatus function :-
Now we will create updateOrderStatus function to update the order status of particular order and return success message.</li>
    <li> Update order_details.blade.php file :-
Update order_details.blade.php file once again to show success message after updating the order status.</li>
  </ol>

  <h1>send order email/sms || COD order placement</h1>
  <ol>
    <li>Update checkout function :-
We will update checkout function at ProductsController to send Order SMS after saving the order into the orders and orders_products tables.<br>We require to call sendSms function and need to return message and mobile variables to sendSms function to send the order confirmation SMS to the user who placed the order.<br>Now we will work on sending order email to the user.<br>We will get order and user details and return both to the order email blade file along with user email, name and order id.</li>
<li>Include Header Statements  :-
Update ProductsController files with below header statements :-
use Illuminate\Support\Facades\Mail; (For sending emails)
use App\Sms; (For Sending SMS)</li>
  </ol>

  <h1>send order email offline | design html template of order email</h1>
  <ol>
    <li>Create order.blade.php file :- 
We will create order.blade.php file at \resources\views\emails\ path and create HTML to show order details along with delivery address of the user.</li>
  </ol>

  <h1>orders statuses logs/history|| create orders_logs table || save logs</h1>
  <p>In this video, we will create orders_logs table with migration and will create model for orders logs.<br>We will update order logs table every time when we update order status from the admin panel.</p>
  <ol>
    <li>Create orders_logs table :-
First of all, we will create orders_logs table with migration. Create migration file with name create_orders_logs_table for creating orders_logs table with below columns :-
id, order_id, order_status, created_at, updated_at<br>So, we will run below artisan command to create migration file for orders_logs :-
php artisan make:migration create_orders_logs_table<br>Open create_orders_logs_table migration file and add all required columns mentioned earlier.<br>Now, we will run below artisan command to create orders_logs table with required columns :- 
php artisan migrate<br>Now orders_logs table has been created with all the required columns.</li>
    <li>Create OrdersLog model :-
Create OrdersLog model by running below command :-
php artisan make:model OrdersLog</li>
    <li> Update updateOrderStatus function :-
Now we will update updateOrderStatus function to maintain record of order status with date/time in orders_logs table.</li>
    <li>Include Header Statement :-
Include OrdersLog model at top of OrdersController :-
use App\OrdersLog;</li>
    <li>Update orderDetails function :-
Update orderDetails function to get order logs for the particular order and return to order_details.blade.php file.</li>
    <li>Update order_details.blade.php file :-
Now we will update order_details.blade.php file to show all order logs/status with date/time.</li>
  </ol>

  <h1>save courier name || tracking number || update shipped order email</h1>
  <ol>
    <li>Update orders table (with Migration) :-
First of all, we will add below columns in orders table with migration :-
courier_name
tracking_number <br>Run below command to create the migration file to update orders table with required columns :-
php artisan make:migration update_orders_table<br>Make changes in update_orders_table migration file as shown in video and run below command :-
php artisan migrate<br>Now you can check; courier_name and tracking_number columns added in orders table.</li>
    <li> Update order_details.blade.php file :-
Add text fields for courier name and tracking number and show them every time when shipped status is selected.</li>
    <li>Update updateOrderStatus function :-
Now we will update updateOrderStatus function to update courier name and tracking number in orders table. </li>
    <li>Update admin_script.js file :-
Lastly, we will show courier name and tracking number only if shipped status gets selected so we will update admin_script.js file to write jquery code for it.</li>
  </ol>

  <h1>show couier name||tracking no in order details at admin/front/email</h1>
  <ol>
    <li>Update order_details.blade.php file :-
Show courier name and tracking number in their respective text fields.</li>
    <li>Update updateOrderStatus function :-
Now we will update updateOrderStatus function to send courier name and tracking number in order status email.</li>
    <li>Update order_status.blade.php file :-
Now add courier name and tracking number in order status email blade file that we will show if added by the client</li>
  </ol>

  <h1>show courier name || tracking no. in order details at admin/front/email</h1>
  <ol>
    <li>Update orders.blade.php file :-
First of all, we will update orders.blade.php file to give link icon for printing order invoice in case of shipped orders.</li>
    <li> Create Route :- Create GET route for generating order invoice with parameter order id in web.php file like below :-
Route::get('view-order-invoice/{id}','OrdersController@viewOrderInvoice');</li>
    <li> Create viewOrderInvoice function :-
Create viewOrderInvoice function at OrdersController in which we are going to get complete order and user details and return to order_invoice blade file that we will create in next step.</li>
    <li>Create order_invoice.blade.php file :-
Now we will create order_invoice.blade.php file under /resources/views/admin/orders/ folder in which we will create order invoice html that we will search and download from internet.</li>
    <li>Download "Order Invoice HTML Template"
We will search in Google for keyword "order invoice html template" and copy order invoice from below link to order_invoice.blade.php file :-
https://bootsnipp.com/snippets/featur..<br>Now check its print out format is looking perfect by pressing Ctrl+P that will be shown in A4 paper size by default.</li>
    <li>Update order_invoice.blade.php file :-
We are returning order details and user details from viewOrderInvoice function to order_invoice.blade.php file in the same way like we have did in order_details.blade.php file.<br>We will first make user billing and shipping addresses dynamic and then will show ordered products in foreach loop as shown in video.<br>We will also calculate order sub total and will show it along with coupon code, coupon discount, shipping charges and grand total.</li>
  </ol>

  <h1>order invoice part 2 || generate barcode/ qr code for order invoice</h1>
  <p>We will install milon/barcode package for generating the Barcode and QR Code.</p>
  <ol>
    <li> Search Google :- We will search for keyword "integrate bar code laravel" and open below link to install milon/barcode package.
https://github.com/milon/barcode</li>
    <li> Run Composer command :-
Now run below composer command to install milon/barcode package :-
composer require milon/barcode<br>If in case "Allowed memory size of 1610612736 bytes exhausted" error comes then run below command :-
COMPOSER_MEMORY_LIMIT=-1 composer require milon/barcode</li>
    <li>Update order_invoice.blade.php file :-
Now add barcode syntax in order_invoice.blade.php file. We can use getBarcodeHTML function given in package with order number and product codes to check if barcode is coming fine.<br>Now check in video barcode must come fine in order invoice. You can try with various barcodes given in package.<br>This is the standard approach of adding the barcode. If you integrate some shipping partner like Fedex for international shipping or Delhivery if you want to deliver in India then shipping company will provide their own API's with barcodes CSS that you have to integrate in your order invoice.</li>
  </ol>
</div>
</body>
</html>