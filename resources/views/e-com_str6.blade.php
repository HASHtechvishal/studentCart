<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com str 6</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="text-capitalize">
	<h1>brande in admin part 1||create table||insert brand || migration//seeding</h1>

	<ol>
		<li>Create brands table :-
First of all, we will create brands table with migration. Create migration file with name create_brands_table for creating brands table with below columns :-
id, name, status, created_at, updated_at

So, we will run below artisan command to create migration file for brands :-
php artisan make:migration create_brands_table

Open create_brands_table migration file and add all required columns mentioned earlier.

Now, we will run below artisan command to create brands table with required columns :- 
php artisan migrate
</li>
		<li>Create Brand model :-
Create Brand model by running below command :-
php artisan make:model Brand
</li>
		<li>Create BrandController :-
Create BrandController by running below command :-
php artisan make:controller Admin/BrandController

Now, We will create Seeding for brands table to insert dummy brands like Arrow, Gap, Lee, Monte Carlo and Peter England from file. You can add your own choice of brands as per your requirement.</li>
		<li>Writing Seeder / Create BrandsTableSeeder file :-
First of all, we will generate seeder and create BrandsTableSeeder file where we will add records for brands table.

Run below artisan command to generate Seeder and create BrandsTableSeeder file :-
php artisan make:seeder BrandsTableSeeder

Above command will create BrandsTableSeeder.php file at \database\seeds\

Now open BrandsTableSeeder file and add query for adding brands.
</li>
		<li>Update DatabaseSeeder.php file :-
Now update DatabaseSeeder.php file located at database/seeds/ to add BrandsTableSeeder class as shown in video.
</li>
		<li>Run below command :-
Now run below command that will finally insert records into brands table.
php artisan db:seed
</li>
	</ol>

	<h1>brands in admin part 2|| display brand || add/edit/delete(curd)</h1>

	<p>First of all, remove earlier BrandController file that we have created in last video because we want to create it again under Admin folder.</p>
	<ol>
		<li>Create BrandController :-
Remove earlier BrandController file that we have created in last video because we want to create it again under Admin folder like below.
php artisan make:controller Admin/BrandController</li>
		<li>Create Route :-
Create GET route for brands in web.php file like below :-
 // Brands
 Route::get('brands','BrandController@brands');
</li>
		<li>Create brands function :-
Create brands function in BrandController to get all brands and return to brands.blade.php file.</li>
		<li>Create brands.blade.php file :-
Now create brands.blade.php file under /resources/views/admin/brands/ folder to show all brands there. 
         
Now we will work on Active/Inactive status for Brand
</li>
		<li>Create Route :-
Create POST Route for updating brand status in web.php file like below :-
Route::post('update-brand-status','BrandController@updateBrandStatus');
</li>
		<li>Create updateBrandStatus function :-
Now create updateBrandStatus function in BrandController to update the status of the brand to active or inactive.    
</li>
		<li>Update admin_script.js file :-
Now update admin_script.js file to add jquery function to update active or inactive status for brand.

Now we will work on Add/Edit Brand functionality.</li>
		<li>Create Route :-
Create GET/POST route to add/edit brand in web.php file like below :-
Route::match(['get','post'],'add-edit-brand/{id?}','BrandController@addEditBrand');</li>
		<li>Create addEditBrand function :-
Now create addEditBrand function in BrandController to add/edit brand.
 </li>
		<li>Create add_edit_brand.blade.php file :-
Now create add_edit_brand.blade.php file under /resources/views/admin/brands/ folder with add/edit brand form.

Now we will work on Delete Brand functionality.</li>
		<li>Create Route :-
Create GET route for delete brand in web.php file like below :-
Route::get('delete-brand/{id?}','BrandController@deleteBrand');
</li>
		<li>Create deleteBrand function :-
Now create deleteBrand function to delete the brand in BrandController and return with success message.

Now we will update icons for Edit, Delete and Active/Inactive
</li>
		<li>Update brands.blade.php file :-
We will update brands.blade.php file to use fontawesome icons for Edit, Delete and Active/Inactive.
</li>
		<li>Update admin_script.js file :-
We need to update jquery script at admin_script.js file for update brand status to show fontawesome toggle icon.

Now we able to add fontawesome icons for brands actions.</li>
	</ol>

	<h1>brand in admin part 3 || add brands for product|| font awesome icon</h1>

	<ol>
		<li>Add brand_id column in products table (with Migration)
First of all, we will update products table with brand_id column with the help of update migration command.

We will run below command to create update migration file like add_column_to_products in which we will add column brand_id after section_id.

php artisan make:migration add_column_to_products

Now we will run below command to make required changes in products table :-
php artisan migrate

You can check brand_id column added after section_id column in products table.</li>
		<li>Update addEditProduct function :-
Now we will update addEditProduct function to get all active brands and return to add_edit_product.blade.php file.
</li>
		<li>Update add_edit_product.blade.php file :-
Now update add_edit_product.blade.php file to add brands select box after category selection in which we will show all active brands and we will make this field mandatory.
</li>
		<li>Update addEditProduct function :-
Update addEditProduct function once again to update the query to save the brand_id in products table.

Now you can add/update brand for every product.

We will now add fontawesome icons for all modules where we have not added so far.</li>
		<li>Update sections.blade.php file :-
Update sections.blade.php file to add fontawesome toggle icon for active/inactive status.
</li>
		<li>Update admin_script.js file :-
Update admin_script.js file to update active/inactive jquery code for sections so that fontawesome toggle icons will work.
</li>
		<li>Update categories.blade.php file :-
Update categories.blade.php file to add fontawesome toggle icon for edit, delete and active/inactive status.
</li>
		<li>Update admin_script.js
Update admin_script.js file to update active/inactive jquery code for categories so that fontawesome toggle icons will work.</li>
		<li>Update products.blade.php file :-
Update products.blade.php file to add fontawesome toggle icon for edit, delete and active/inactive status.</li>
		<li>Update admin_script.js
Update admin_script.js file to update active/inactive jquery code for products so that fontawesome toggle icons will work.

Our E-commerce Admin Panel is ready now with Sections, Brands, Categories and Products module.</li>
	</ol>
</div>
</body>
</html>
































