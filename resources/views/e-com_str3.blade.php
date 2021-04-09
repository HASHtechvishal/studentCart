<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com str3</title>
		   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="text-capitalize">
	<h1>categories module in admin panel part 1 | migration seeding</h1>
	<ol>
		<li>Create categories table :-
First of all, we will create categories table with migration. Create migration file with name create_categories_table for creating categories table with below columns :-
id, parent_id, section_id, category_name, category_image, category_discount, description, url, meta_title, meta_description, meta_keywords and status

So, we will run below artisan command to create migration file for categories :-
php artisan make:migration create_categories_table

Open create_categories_table migration file and add all required columns mentioned earlier.

Now, we will run below artisan command to create categories table with required columns :- 
php artisan migrate

Now categories table has been created with all the required columns.
</li>
		<li>Create Category model :-
Create Category model by running below command :-
php artisan make:model Category
</li>
		<li>Create CategoryController :-
Create CategoryController in Admin folder at /app/Http/Controllers/Admin/ by running below command :-
php artisan make:controller Admin/CategoryControlle

Now, We will create Seeding for categories table to insert one test category like T-Shirts from file.
</li>
		<li>Writing Seeder / Create CategoryTableSeeder file :-
First of all, we will generate seeder and create CategoryTableSeeder file from where we will add one category for categories table.

Run below artisan command to generate Seeder and create CategoryTableSeeder file :-
php artisan make:seeder CategoryTableSeeder

Above command will create CategoryTableSeeder.php file at \database\seeds\

Now open CategoryTableSeeder file and add record for category.</li>
		<li>Update DatabaseSeeder.php file :-
Now update DatabaseSeeder.php file located at database/seeds/ to add CategoryTableSeeder class as shown in video.
</li>
		<li>Run below command :-
Now run below command that will finally insert category into categories table.
php artisan db:seed</li>
	</ol>

	<h1>categories in admin panel part2 || display categories</h1>
	<ol>
		<li> Create Route :-
Create GET route in web.php file in admin middleware group prefixed with admin and having namespace Admin for displaying categories in admin panel :-
// Categories
Route::get('categories','CategoryController@categories');
</li>
		<li>Create categories function :-
Now create categories function in CategoryController to write query to display all the categories in admin panel and return to categories blade file that we will create under /resources/views/admin/categories/ folder.</li>
		<li> Include Category model :-
Include Category model at top of CategoryController.
use App\Category;</li>
		<li>Create categories.blade.php file :-
Now create categories.blade.php file under /resources/views/admin/categories/ folder in which we will add content from LTE admin template data.html file located at folder /pages/tables/data.html and will display categories within foreach loop. 

Now we can see in video; we can able to see T-Shirts category in "View Categories" page along with URL and status in admin panel. 

Now we will add functionality to toggle Active/Inactive status for categories like we have done for sections.

Add id, class and category_id attributes for Active and Inactive status for categories at categories.blade.php file that are required to update the status with jquery and ajax.
</li>
		<li>Update admin_script.js file :-
Add updateCategoryStatus jquery function in admin_script.js file in which we will pass status and category_id that we will return to ajax via admin/update-category-status route. 
</li>
		<li>Create Route :-
Now we will create below Post route in admin middleware group in web.php file for updating status that we pass via ajax in last step.
Route::post('update-category-status','CategoryController@updateCategoryStatus');</li>
		<li>Update VerifyCsrfToken.php :-
Add route "admin/update-category-status" in VerifyCsrfToken.php file so that CSRF token mismatch error won't come. 
</li>
		<li>Create updateCategoryStatus :-
Now we will create updateCategoryStatus in CategoryController to update the status of category in categories table and return back the updated status to ajax via json. </li>
		<li>Update admin_script.js file :-
Update admin_script.js file again to get the status and category id in ajax response and update status in categorys.blade.php file.
</li>
	</ol>

	<h1>categories in admin part 3 || add//edit category page admin</h1>
	<ol>
		<li>Update categories.blade.php file :- 
First of all, we will show "Add Category" link at top right side of the categories page in admin panel.</li>
		<li>Create Route :-
Create GET/POST route for Add/Edit Category in web.php file under admin group with id parameter as optional (that is required in case of edit category) like below :-
Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@addEditCategory');</li>
		<li>Create addEditCategory function :-
Create addEditCategory function in CategoryController with parameter $id as optional. We will add condition to execute "Add Category" functionality in case $id is empty otherwise "Edit Category" functionality if $id is coming.
We will also get all the categories and return to add_edit_category.blade.php file that we will create in next step.
</li>
		<li> Create add_edit_category.blade.php file :-
Now we will create add_edit_category.blade.php file at path /resources/views/admin/categories/ and will add admin design to it.

We will create Add/Edit Category form with the help of General/Advance forms given in AdminLTE template. We will copy form design from AdminLTE template from general.html and advance.html files located at path /AdminLTE-3.0.2/pages/forms/ of AdminLTE folder as shown in video.</li>
		<li>Update admin_layout.blade.php file :-
Add select2 CSS/JS files for advance html form that is having better select box script as shown in video. 

Now check in video; our "Add Category Form" design is ready.
</li>
	</ol>

	<h1>categories in admin panel part 4 || add category| laravel validation</h1>
	<ol>
		<li>update add_edit_category.blade.php file :-
First of all, we will update add_edit_category.blade.php file to make sure to add form action, name and id's for form and for all fields.</li>
		<li>Update addEditCategory function :-
Now we will update addEditCategory function at CategoryController to add query for adding category details in categories table and return the user to categories page with success message.

We will also add Laravel validations to make sure correct category data added.</li>
		<li>Include Header Statements :-
Include Session and Image class at top of CategoryController :-
use Session;
use Image;
</li>
		<li>Update add_edit_category.blade.php file :-
Now show error message above form at add_edit_category.blade.php file :-
</li>
		<li>Update categories.blade.php file :-
We will show success message in categories page if category successfully added. </li>
	</ol>

	<h1>categories in admin panel part 5 || add category|level select box</h1>
	<ol>
		<li>Create append_categories_level.blade.php file :-
First of all, we will create append_categories_level.blade.php file under resources/views/admin/categories/ folder and add categories level select box from add_edit_category.blade.php file.</li>
		<li> Update add_edit_category.blade.php file :-
We will add div with id appendCategoriesLevel and include newly created append_categories_level.blade.php file into it as shown in video.</li>
		<li>Update admin_script.js file :-
Now we will create jquery function that will come into role when admin select section and we will pass section id with ajax to fetch categories to show in category level select box.
</li>
		<li> Create Route :-
Now we will create post route in web.php file to append categories level :-
Route::post('append-categories-level','CategoryController@appendCategoriesLevel');</li>
		<li>Create appendCategoriesLevel function :-
Now we will create appendCategoriesLevel function in CategoryController to write the query to get the root categories of particular section and return into category level select box.</li>
		<li>Update addEditCategory function :-
We want to allow the admin to add alphabets with spaces in "Category Name" field. Last time we have added alpha option that Laravel provides but it will not allow spaces so we will search on net for better solution.

Search for the keyword like 'laravel validation for alphabetic characters and spaces' and open below stackoverflow link to find the solution.

https://stackoverflow.com/questions/3...

We will add regular expression for allowing alphabets with spaces as shown in video.
</li>
		<li> Update VerifyCsrfToken.php file :-
Update VerifyCsrfToken.php file to add url /admin/append-categories-level to prevent CSRF token.</li>
		<li>Update Category.php Model :-
Add subcategories function with hasMany relation to fetch all sub categories of parent categories. </li>
		<li>Update appendCategoriesLevel function :-
Now update query in appendCategoriesLevel function with subcategories relation to get all sub categories of categories. 
</li>
		<li>Update append_categories_level.blade.php file :-
Finally, update append_categories_level.blade.php file to add foreach loop for sub categories as shown in video.

Now Categories and Sub Categories depends upon Sections. If you select Men section then all categories and sub categories of men will appear and if you select Women section then all categories and sub categories of women will appear and so on..</li>
	</ol>

	<h1>category in admin part 6 | display parent category/section</h1>
	<ol>
		<li>Update Category model :-
Create section function in Category model to make belongsTo relation between categories and section in which every category belongs to section.</li>
		<li>Update categories function :-
Now update categories function to update query to add section relation with it so that we can get section of every category. 
</li>
		<li>Update categories.blade.php file :-
Now update categories.blade.php file to add section into it.

Now, we will take steps to show parent categories in categories page.
</li>
		<li>Update Category Model :-
Create parentcategory function in Category model to make belongsTo relation between categories and parent categories with parent_id in categories table.
</li>
		<li>Update categories function :-
Now update categories function to update query to add parentcategory relation with it so that we can get parent category of every category if exists.</li>
		<li>Update categories.blade.php file :-
Now update categories.blade.php file to add parent category into it.

Now parent category and section appears in categories page in admin panel.</li>
	</ol>

	<h1>category in admin panel part 7 | edit category in admin</h1>
	<ol>
		<li>Update categories.blade.php file :-
First of all, update categories page in admin panel with Actions column that is having Edit and Delete links for category. We will add Edit link for now for editing the category.</li>
		<li>Update addEditCategory function :-
Now, we will update addEditCategory function in CategoryController. We will fetch category data from query that we want to edit and return that category data to add_edit_category.blade.php file.
</li>
		<li>Update add_edit_category.blade.php file :-
Now we will update add_edit_category.blade.php file and show category data in form that we want to edit. We will also change action of form if category id coming from $categorydata array is not empty. We will allow the admin to change the section, category level and other category details along with category image. </li>
		<li>Update addEditCategory function :-
Update addEditCategory function again in CategoryController to get the category level that we have selected at the time of "Add Category". We now need to select that category level in edit category form as well so we will return category level.
</li>
	</ol>

	<h1>category in admin || edit category/level in admin panel</h1>
	<ol>
		<li>Update append_categories_level.blade.php :-
Now we will update append_categories_level.blade.php file to select category level.</li>
		<li>Update addEditCategory function :-
Finally, update addEditCategory function to update the query to update category details.</li>
	</ol>

	<h1>category in admin panel | delete category/image in admin</h1>
	First of all, we will show Category Image with Delete link and functionality.
<ol>
		<li>Update add_edit_category.blade.php file :-
Show Category Image if already added along with Delete link so add condition for it at add_edit_category.blade.php file.
</li>
		<li>Create Route :-
Now we will create GET route to delete category image with parameter category id in web.php file like below :-
Route::get('delete-category-image/{id}','CategoryController@deleteCategoryImage');
</li>
		<li>Create deleteCategoryImage function :-
Now create deleteCategoryImage function in CategoryController in which we will write query to delete category image from categories table and category_images folder.

Now we will delete category as well.</li>
		<li>Update categories.blade.php file :-
Now we will update categories.blade.php file to add delete category link with every category listing.</li>
		<li>Create Route :-
Now we will create GET route with parameter category id to delete category in web.php file like below :-
Route::get('delete-category/{id}','CategoryController@deleteCategory');
</li>
		<li>Create deleteCategory function :-
Now we will create deleteCategory function in CategoryController to write the query to delete the category with category id that we will get as parameter. After deleting the category, we will return to categories page with success message.

So, we able to delete the category image as well as category. 
</li>
	</ol>

	<h1>categories in admin panel | sweetalert 2 jquery for delete</h1>
	<ol>
		<li>Simple JavaScript Alert</li>
		<li>SweetAlert 2 Javascript Library
			<ul>
				<li>Simple JavaScript Alert

Add confirmDelete class and name Category in delete cateogory link and then create confirmDelete click event in javascript to add simple confirm alert.

Update admin_layout.blade.php file to add confirmDelete click event in jQuery.

Now update admin_script.js file to add confirmDelete function in which we will add confirm script. If admin confirm then we will pass return true otherwise return false.</li>
				<li>SweetAlert Javascript Library

Now remove earlier simple script to add  SweetAlert jQuery script.

Follow below link to install SweetAlert 2 
https://sweetalert2.github.io

Run below command to install SweetAlert 2 :-
npm install sweetalert2

Also, update admin_layout.blade.php file with below JS script

Check if SweetAlert script is working by adding sample script given in sweetalert2 website in admin_script.js file.

If script working then we will continue further.

Add record and recordid attributes in delete category link.

In record, we will pass "category" and in recordid, we will pass category id.

And disable href and keep class "confirmDelete" that we have added earlier.

Now update admin_script.js file and add Jquery script there with SweetAlert.

Now check in video, our SweetAlert is working fine while deleting categories.

Now, we will add SweetAlert for deleting category image. So update "Delete Image" link at add_edit_category.blade.php with record as "category-image", recordid as "category id".

And no need to do jquery function again to add SweetAlert. Same function will work for deleting category images as well.</li>
			</ul></li>
	</ol>
</div>
</body>
</html>



































