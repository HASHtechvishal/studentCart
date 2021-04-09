<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com str5</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="text-capitalize">
		<h1>products attributes module in admin part 1 || create table</h1>
		<ol>
			<li>Create products_attributes table :-
First of all, we will create products_attributes table with migration. Create migration file with name create_products_attributes_table for creating products_attributes table with below columns :-
id, product_id, sku, color, size, price, stock and status

So, we will run below artisan command to create migration file for products_attributes :-
php artisan make:migration create_products_attributes_table

Open create_products_attributes_table migration file and add all required columns mentioned earlier.

Now, we will run below artisan command to create products_attributes table with required columns :- 
php artisan migrate

Now products_attributes table has been created with all the required columns.</li>
			<li>Create ProductsAttribute model :-
Create ProductsAttribute model by running below command :-
php artisan make:model ProductsAttribute

Now, We will create Seeding for products_attributes table to insert one test product attribute from file.
</li>
			<li>Writing Seeder / Create ProductsAttributesTableSeeder file :-
First of all, we will generate seeder and create ProductsAttributesTableSeeder file from where we will add one product attribute for products_attributes table.

Run below artisan command to generate Seeder and create ProductsAttributesTableSeeder file :-
php artisan make:seeder ProductsAttributesTableSeeder

Above command will create ProductsAttributesTableSeeder.php file at \database\seeds\

Now open ProductsAttributesTableSeeder file and add record for product attribute.</li>
			<li>Update DatabaseSeeder.php file :-
Now update DatabaseSeeder.php file located at database/seeds/ to add ProductsAttributesTableSeeder class as shown in video.
</li>
			<li>Run below command :-
Now run below command that will finally insert product into products_attributes table.
php artisan db:seed</li>
		</ol>

		<h1>product attributes in admin part 2|| create add attributes form </h1>
		<p> we will start working on Add/View Product Attributes page in admin panel. For Products Attributes, we will add Product Size, SKU, Price and Stock. Like if Product is Red Casual T-Shirt then its product attributes can be like below :-
			<pre>

Size           SKU              Price          Stock
Small        RC01-S             1000             10
Medium       RC01-M             1100             10
Large        RC01-L             1200             10
</pre>

There is a common page in which we will show Add Products Attribute form and at bottom we will show the products attributes that we have added so far for the product. In this video, we will create Add Products Attribute Page and going to show some Product Details like Product Code, Name, Color along with Product Image. Also, we are going to find and integrate Multiple fields Add/Remove script for product attributes. </p>
		<ol>
			<li> Update products.blade.php file :-
First of all, we will update products.blade.php file to add product attributes link in Actions column. Also we are going to update all action links to fontawesome icons that will look good and attractive.</li>
			<li> Create Route :-
Now we will create GET/POST Route for add-attributes in web.php file like below :-

Route::match(['get','post'],'add-attributes/{id}','ProductsController@addAttributes');</li>
			<li>Create addAttributes function :-
Now we will create addAttributes function in ProductsController and return product data that we will get from product id and return to add_attributes.blade.php file.
</li>
			<li>Create add_attributes.blade.php file :-
Now we will create add_attributes.blade.php file under /resources/views/admin/products/ folder and will show product details like Product Name, Product Code, Product Color and Product main image.</li>
			<li>Search Google for Multiple Add/Remove fields script :-
Now we will search in Google for "add remove fields dynamically in jquery" so that we can add multiple attributes like multiple sizes, stock, price and there sku's. It will save our time otherwise we can also build of our own as well.

We can take help from below website :-
https://www.codexworld.com/add-remove...</li>
			<li>Update admin_script.js
Now we will update admin_script.js to add the jquery script from the website that we have found in last step.</li>
			<li>Update add_attributes.blade file
Now we will update add_attributes.blade file to add all attributes fields Size, SKU, Price and Stock with Add/Remove link.

We need to update both add_attributes.blade.php file and admin_script.js vice versa so please watch in video..</li>
			<li> Update addAttributes function :-
Update addAttributes function once again to get the posted attributes and check/debug in function if we are getting complete data.</li>
		</ol>

		<h1>attribute in admin part 3 || add/validate/size/price/stack/sku</h1>

		<ol>
			<li>Update addAttributes function :-
Update addAttributes function to save all attributes in products_attributes table after adding two validations :-

i) All SKU must be unique so if SKU already exists then we will return with error message.

ii) If same size already added for Product then we will return with error message.    

After passing the validations, we are going to save the attributes in products_attributes table and return with success message.

Now admin can able to add product attributes after validating them.</li>
		</ol>

		<h1>attribute in admi part 4 || display attribute : size/price/stock/sku</h1>
		<ol>
			<li>Create attributes function :-
First of all, create attributes function in Product model to create hasMany relation between product and their attributes. One Product can have many attributes so hasMany relation will work here.
</li>
			<li>update addAttributes function :-
Update addAttributes function once again to update query to get product data along with their attributes by attaching attributes function with it.</li>
			<li> Update add_attributes.blade.php file :-
Update add_attributes.blade.php file to show added product attributes that we return from the function in last step.

Now admin can able to add and view product attributes in the same page.
</li>
		</ol>

		<h1>attribute in admin part 5 || update attr: stock/price</h1>
		<ol>
			<li>Update add_attributes.blade.php file :- 
We will update add_attributes.blade.php file to add form and with price and stock as input fields in array so that we can update multiple attributes together.</li>
			<li> Create Route :-
Now we will create POST route to edit attributes and will pass product id as parameter in web.php file like below :-
Route::match(['get','post'],'edit-attributes/{id}','ProductsController@editAttributes');</li>
			<li>Create editAttributes function :-
Now create editAttributes function in ProductsController to get the attribute data with product id to update attributes and return to product attributes page with success message.

Now we can able to update the product attributes price and stock.
</li>
		</ol>

		<h1>attribute in admin panel part 6 || disable/delete product attribute</h1>
		<ol>
			<li>Update add_attributes.blade.php file :-
First of all, update add_attributes.blade.php file to show Active/Inactive and Delete Links.

First we will work on Active/Inactive status for Product Attributes.</li>
			<li>Update admin_script.js file :- 
Now add jquery function for update attribute status at admin_script.js file.</li>
			<li>Create Route :-
Now we will create POST route to update attribute status in web.php file like below :- 
Route::post('update-attribute-status','ProductsController@updateAttributeStatus');
</li>
			<li>Update VerifyCsrfToken.php
Update VerifyCsrfToken.php to add "/admin/update-attribute-status" route to disable CSRF token check.</li>
			<li>Create updateAttributeStatus function :-
Now create updateAttributeStatus function in ProductsController to write query to update Active/Inactive status for the attribute.

We now able to update active/inactive status for the product attribute.

For delete attribute; take below steps :-
</li>
			<li>Create Route :-
Now create GET route for delete attribute in web.php file like below :-
Route::get('delete-attribute/{id?}','ProductsController@deleteAttribute');</li>
			<li>Create deleteAttribute function :-
Now create deleteAttribute function for writing query to delete the attribute and return with success message.
</li>
		</ol>

		<h1>product images in admin part 1 || create table || migration seeding</h1>
		<ol>
			<li>Create products_images table :-
First of all, we will create products_images table with migration. Create migration file with name create_products_images_table for creating products_images table with below columns :-
id, product_id, image and status

So, we will run below artisan command to create migration file for products_images :-
php artisan make:migration create_products_images_table

Open create_products_images_table migration file and add all required columns mentioned earlier.

Now, we will run below artisan command to create products_images table with required columns :- 
php artisan migrate

Now products_images table has been created with all the required columns.</li>
			<li>Create ProductsImage model :-
Create ProductsImage model by running below command :-
php artisan make:model ProductsImage

Now, We will create Seeding for products_images table to insert one test product image from seeder command.
</li>
			<li>Writing Seeder / Create ProductsImagesTableSeeder file :-
First of all, we will generate seeder and create ProductsImagesTableSeeder file from where we will add one product image for products_images table.

Run below artisan command to generate Seeder and create ProductsImagesTableSeeder file :-
php artisan make:seeder ProductsImagesTableSeeder

Above command will create ProductsImagesTableSeeder.php file at \database\seeds\

Now open ProductsImagesTableSeeder file and add record for product image.
</li>
			<li>Update DatabaseSeeder.php file :-
Now update DatabaseSeeder.php file located at database/seeds/ to add ProductsImagesTableSeeder class as shown in video.</li>
			<li> Run below command :-
Now run below command that will finally insert product into products_images table.
php artisan db:seed

In next video, we will work on Add/View Product Images page in admin panel.</li>
		</ol>

		<h1>product images in admin part 2 || create page | add/view product images</h1>
<p>First of all, we will update few things in our advance ecom series for products module :-

Update addEditProduct function :-
Update addEditProduct function in ProductsController and remove all conditions. 

Update database.php file :-
Just update strict to false in mysql array in database.php file located at config folder.

Update products table :-
And update products table to set "No" value for "is_featured" column.

ALTER TABLE `products` CHANGE `is_featured` `is_featured` ENUM('No','Yes') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No'; 

Now we will create Add/View Product Images page in admin panel.</p>
		<ol>
			<li>Update products.blade.php file :- 
Create "Add Images" link icon in Actions column at products.blade.php file
</li>
			<li>Create Route :-
Now create GET/POST route for add images with parameter product id in web.php file like below :-

// Images
Route::match(['get','post'],'add-images/{id}','ProductsController@addImages');
</li>
			<li>Create addImages function :-
Now create addImages function in ProductsController with parameter $id and return product details to add_images.blade.php file that we will create in next step.

Also create images relation in Product model and attach with query. One Product can have many images so we will add hasMany relation.
</li>
			<li>Create add_images.blade.php file :-
Now create add_images.blade.php file similar to add_attributes.blade.php file in which we will replace attributes fields with image field and replace added attributes with images.</li>
		</ol>

		<h1>product images in admin part 3 || add multiple images// delete// disable</h1>
		<ol>
			<li>Update addImages function :-
We will update addImages function to upload single or multiple alternate product images after resize.

We will save product images in products_images table and upload into small/medium and large folders located at /public/images/product_images/

Now check in video; we can able to upload multiple images of the product.

Now we will work on active/inactive functionality for the product image.
</li>
			<li>Update add_images.blade.php file :-
Update add_images.blade.php file to show Active/Inactive and Delete Links with their respective classes and id's.</li>
			<li>Update admin_script.js file :-
Now update admin_script.js file to add jquery click function with updateImageStatus class for updating image status.</li>
			<li>Create Route :-
Now create POST route for updating image status in web.php file like below :-
Route::post('update-image-status','ProductsController@updateImageStatus');</li>
			<li> Create updateImageStatus function :-
Now create updateImageStatus function to update status for the image from Active to Inactive or Inactive to Active. 

Now check in video; we can able to update image status of the product.

Now we will work on delete functionality for the product image.</li>
			<li> Create Route :-
Now create GET route for deleting product image in web.php file like below :-
Route::get('delete-image/{id?}','ProductsController@deleteImage');</li>
			<li>Create deleteImage function :-
Create deleteImage function to delete the product image from products_images table as well as small/medium and large folders. </li>
		</ol>
	</div>
</body>
</html>
































