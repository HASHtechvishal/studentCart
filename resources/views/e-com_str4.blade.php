<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com str4</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="text-capitalize">
		<h1>products module in admin panel part1 | migration | seeding</h1>
		<ol>
			<li>Create products table :-
First of all, we will create products table with migration. Create migration file with name create_products_table for creating products table with below columns :-
id, category_id, section_id, product_name, product_code, product_color, main_image, description, wash_care, fabric, pattern, sleeve, fit, occasion, product_price, product_discount, product_weight, product_video, meta_title, meta_description, meta_keywords, is_featured and status

So, we will run below artisan command to create migration file for products :-
php artisan make:migration create_products_table

Open create_products_table migration file and add all required columns mentioned earlier.

Now, we will run below artisan command to create products table with required columns :- 
php artisan migrate

Now products table has been created with all the required columns.
</li>
			<li>Create Product model :-
Create Product model by running below command :-
php artisan make:model Product
</li>
			<li>Create ProductsController :-
Create ProductsController in Admin folder at /app/Http/Controllers/Admin/ by running below command :-
php artisan make:controller Admin/ProductsController

Now, We will create Seeding for products table to insert one test product from file.</li>
			<li>Writing Seeder / Create ProductsTableSeeder file :-
First of all, we will generate seeder and create ProductsTableSeeder file from where we will add one product for products table.

Run below artisan command to generate Seeder and create ProductsTableSeeder file :-
php artisan make:seeder ProductsTableSeeder

Above command will create ProductsTableSeeder.php file at \database\seeds\

Now open ProductsTableSeeder file and add record for product</li>
			<li> Update DatabaseSeeder.php file :-
Now update DatabaseSeeder.php file located at database/seeds/ to add ProductsTableSeeder class as shown in video.</li>
			<li> Run below command :-
Now run below command that will finally insert product into products table.
php artisan db:seed</li>
		</ol>

		<h1>product module in admin panel part 2 || active/inactive/delete</h1>

		<ol>
			<li>Create Route :-
Create GET route in web.php file in admin middleware group prefixed with admin and having namespace Admin for displaying products in admin panel :-
// Products
Route::get('products','ProductsController@products');</li>
			<li>Create products function :-
Now create products function in ProductsController to write query to display all the products in admin panel and return to products blade file that we will create under /resources/views/admin/products/ folder.</li>
			<li>include Product model :-
Include Product model at top of ProductsController.
use App\Product;</li>
			<li>Create products.blade.php file :-
Now create products.blade.php file under /resources/views/admin/products/ folder to display products within foreach loop. We can copy design structure from categories.blade.php file that we have copied from LTE Admin template explained in earlier videos.

Now we can see in video; we can able to see Blue and Red Casual T-Shirts products in "View Products" page along with their product name/code/color and status in admin panel. 

Now we will add functionality to toggle Active/Inactive status for products like we have done for categories.

Add id, class and product_id attributes for Active and Inactive status for products at products.blade.php file that are required to update the status with jquery and ajax.</li>
			<li> Update admin_script.js file :-
Add updateProductStatus jquery function in admin_script.js file in which we will pass status and product_id that we will return to ajax via admin/update-product-status route. 
</li>
			<li>Create Route :-
Now we will create below Post route in admin middleware group in web.php file for updating status that we pass via ajax in last step.
Route::post('update-product-status','ProductsController@updateProductStatus');</li>
			<li>Update VerifyCsrfToken.php :-
Add route "admin/update-product-status" in VerifyCsrfToken.php file so that CSRF token mismatch error won't come. 
</li>
			<li> Create updateProductStatus :-
Now we will create updateProductStatus in ProductsController to update the status of product in products table and return back the updated status to ajax via json. </li>
			<li>Update admin_script.js file :-
Update admin_script.js file again to get the status and product id in ajax response and update status in products.blade.php file.

Delete functionality will automatically work after creating delete-product route and update id's at delete product link and make identical function like delete category.</li>
		</ol>

		<h1>product module admin part 3 || display product || active/inactive/delete</h1>

		<ol>
			<li>Update Product model :- 
First of all, update Product model to make Eloquent Relationships to get category and section of product.</li>
			<li>Update products function :-
Now update products function to attach category and section relations in products query to get the category and section of the product.</li>
			<li>Update products.blade.php file :-
Finally, we will show category and section of product in products.blade.php file in foreach loop.</li>
			<li>Update products function :-
We will update products function once again to add sub query to select only required data from category and section model that we require. It will make our query fast also and we will do this in practise.</li>
		</ol>

		<h1>product module in admin part 4 || add/edit/product page/form design</h1>
		<ol>
			<li>Update products.blade.php file :- 
First of all, we will show "Add Product" link at top right side of the products page in admin panel.</li>
			<li>Create Route :-
Create GET/POST route for Add/Edit Product in web.php file under admin group with id parameter as optional (that is required in case of edit product) like below :-
Route::match(['get','post'],'add-edit-product/{id?}','ProductsController@addEditProduct');</li>
			<li>Create addEditProduct function :-
Create addEditProduct function in ProductsController with parameter $id as optional. We will add condition to execute "Add Product" functionality in case $id is empty otherwise "Edit Product" functionality if $id is coming.
We will also get all the products and return to add_edit_product.blade.php file that we will create in next step.</li>
			<li>Create add_edit_product.blade.php file :-
Now we will create add_edit_product.blade.php file at path /resources/views/admin/products/ and will add admin design to it similar to add_edit_categories.blade.php file.

We will create Add Product form with all columns that we have created in products table along with "Select Category" drop down in which we will show all categories and sub categories under sections.
</li>
			<li>Update addEditProduct function :-
We will update addEditProduct function to create filters arrays so that we can return filter options to display in "Add Product" form.
</li>
</ol>
<h1>realtion | hasMany | belongsTo |debugging</h1>
{{--https://www.youtube.com/watch?v=xyEqkUEZB_0&list=PLLUtELdNs2ZaHaFmydqjcQ-YyeQ19Cd6u&index=33--}}
<span>relation-- hasMany(one section has many category) for ex- man section has many categories like t-shirts etc by sub query</span>

<h1>product module in admin part 5 || add product form || category level</h1>

<ol>
	<li>Update add_edit_product.blade.php file :-
We will update add_edit_product.blade.php file to add filters select boxes.
</li>
	<li>Update Section model :-
Now, we will create categories function so that we can get categories and sub categories of section. We will add condition to pick all root and enabled categories.</li>
	<li>Update addEditProduct function :-
We will update addEditProduct function to get sections with categories relation so that we can display sections, their categories and their sub categories in "Add Product" form.</li>
	<li>Update add_edit_product.blade.php file :-
Now we will update add_edit_product.blade.php file once again to show sections with their categories and sub categories in "Select Category" drop down.

Now our "Add Product" form is ready. In next video, we will insert product in products table and will show it in view products page.</li>
</ol>

<h1>product module in admin part 6 ||add product|| laravel validations</h1>

<ol>
	<li>Update addEditProduct function :-
First of all, we will update addEditProduct function to get posted data and debug all product data is coming fine. After that, add laravel validations for mandatory data like category_id, product_name, product_code, product_price and product_color.</li>
	<li>Update add_edit_product.blade.php file :-
Now we will update add_edit_product.blade.php file to show validation error messages and show earlier filled data as well so that admin/client not required to fill all product information again.</li>
	<li>Update addEditProduct function :-
Update addEditProduct function once again to write query to save the products data in products table. We will also get section_id from category_id and will save it as well. We will return to add products page again with success message after saving the product.</li>
</ol>

<h1>product in admin part 7 ||add video ||image after resize||intervention</h1>
<ol>
	<li>Create product_images folder :-
First of all, create product_images folder under /public/images/ path and then add small, medium and large folders under product_images folder that will look like below :-
/public/images/product_images/small/
/public/images/product_images/medium/
/public/images/product_images/large/</li>
	<li>Update addEditProduct function :-
Update addEditProduct function in ProductsController to write code to add product main image by resizing it to small, medium and large sizes that we will upload in small, medium and large folders created in last step.

Intervention package helps us to resize images into 3 parts and add in folders. 
</li>
	<li>Include Header Statement :-
Now include below statement at the top of ProductsController so that we can add/update and resize images with Intervention package that we have installed in Part-14 :- https://youtu.be/qdrmd7HVlgk
use image;

Now you can see in video, we able to add product images into their respective folders after resizing them.

Now we will add product videos.</li>
	<li>Create product_videos folder :-
Create videos folder under /public/ folder and then create product_videos folder under /public/videos/ folder where we will upload all product videos.</li>
	<li>Update addEditProduct function :-
Update addEditProduct function in ProductsController to write code to add product video.

Now we can able to add video of the product as well.</li>
</ol>

<h1>product module in admin park part 8 ||show product image||dummy image</h1>

<ol>
	<li>Update products.blade.php file :-
Update view products page in admin panel to show product main image if it exists otherwise show dummy product image that we will generate from below website :-
https://dummyimage.com

We will create dummy image of width 100px and height 115px and will add text "No Image" in it.

Now we will add one more condition that if product image not there in products folder then again it will show dummy image.</li>
</ol>

<h1>product in admin part 9 ||edit product || image/video</h1>

<ol>
	<li>Update addEditProduct function :-
First of all, we will update addEditProduct function to get the product details from product id and return the product details to edit product form to display there.</li>
	<li> Update add_edit_product.blade.php file :-
Update "Select Category" drop down and other fields to show the existing product details that we can update.</li>
	<li>Update addEditProduct function :-
Update addEditProduct function once again to write query to update the product details from the edit product form on the updation of the form.

Now we able to update product details, image and video as well.</li>
</ol>

<h1>product module admin part 10 || show/delete/product image/video</h1>
<ol>
	<li>Update add_edit_product.blade.php file :-
Update add_edit_product.blade.php file to show product image in edit product form if user already added it while adding the product. We will show "Delete Image" link as well if product image is there.

Now we will show download link for the video if video added by the admin while adding the product. We will show "Delete Video" link as well if product image is there.</li>
	<li>Create Routes :-
Now we will create GET routes for deleting product image and video in web.php file like below :-
Route::get('delete-product-image/{id}','ProductsController@deleteProductImage');
Route::get('delete-product-video/{id}','ProductsController@deleteProductVideo'); </li>
	<li>Create deleteProductImage function :-
Now create deleteProductImage function to delete product images from small, medium and large folders and from products table.
</li>
	<li>Create deleteProductVideo function :-
Now create deleteProductVideo function to delete product video from videos folders and from products table.

We able to show and delete both Product Main Image and Video.
</li>
</ol>
	</div>

</body>
</html>


























