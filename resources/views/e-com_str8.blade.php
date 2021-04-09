<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com_srt8</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
	<div class="text-capitalize">
		<h1>make new/ latest products dynamic at home page</h1>
		<ol>
			<li>Update index function :-
Update index function at IndexController to write query for latest products. We are going to show 6 latest products so will add limit of 6 as well in query.</li>
			<li>Update index.blade.php file :-
Now we will add foreach loop in index.blade.php file to show new/latest products.
</li>
		</ol>

		<h1>make home page banners dynamic part 1 || create table | migration | seeding</h1>
		<p>. We will create banners table with migration and will also add dummy banners in it with Seeding though later on we can add/update banners from admin panel. We will also create model for banners.
		</p>

		<ol>
			<li> Create banners table :-
First of all, we will create banners table with migration. Create migration file with name create_banners_table for creating banners table with below columns :-
id, image, link, title, alt and status

So, we will run below artisan command to create migration file for banners :-
php artisan make:migration create_banners_table

Open create_banners_table migration file and add all required columns mentioned earlier.

Now, we will run below artisan command to create banners table with required columns :- 
php artisan migrate

Now banners table has been created with all the required columns.</li>
			<li> Create Banner model :-
Create Banner model by running below command :-
php artisan make:model Banner

Now, We will create Seeding for banners table to insert few test banners from seeder command.</li>
			<li> Writing Seeder / Create BannersTableSeeder file :-
First of all, we will generate seeder and create BannersTableSeeder file from where we will add banner images for banners table.

Run below artisan command to generate Seeder and create BannersTableSeeder file :-
php artisan make:seeder BannersTableSeeder

Above command will create BannersTableSeeder.php file at \database\seeds\

Now open BannersTableSeeder file and add record for product image.</li>
			<li>) Update DatabaseSeeder.php file :-
Now update DatabaseSeeder.php file located at database/seeds/ to add BannersTableSeeder class as shown in video.</li>
			<li>Run below command :-
Now run below command that will finally insert banners into banners table.
php artisan db:seed
</li>
			
		</ol>


		<h1>make home page banner dynamic part 2 || display in admin|| active/delete</h1>

		<ol>
			<li>Create BannersController :-
First of all, create BannersController under Admin folder like below :- 
php artisan make:controller Admin/BannersController</li>
			<li>Create Route :-
Create GET route for banners in web.php file like below :-
// Banners
Route::get('banners','BannersController@banners');</li>
			<li>Create banners function :-
Create banners function in BannersController to get all banners and return to banners.blade.php file.</li>
			<li>Create banners.blade.php file :-
Now create banners.blade.php file under /resources/views/admin/banners/ folder to show all banners there.

Now we will work on Active/Inactive status for Banner</li>
			<li>Create Route :-
Create POST Route for updating banner status in web.php file like below :-
Route::post('update-banner-status','BannersController@updateBannerStatus');</li>
			<li>Create updateBannerStatus function :-
Now create updateBannerStatus function in BannersController to update the status of the banner to active or inactive.</li>
			<li>Update admin_script.js file :-
Now update admin_script.js file to add jquery function to update active or inactive status for banner.</li>
			<li>Update VerifyCsrfToken.php file :-
Update VerifyCsrfToken.php to add "/admin/update-banner-status" route to disable CSRF token check.

Now we will work on delete functionality for Banner</li>
			<li>Create Route :-
Create GET route for deleting banner in web.php file like below :-
Route::get('delete-banner/{id?}','BannersController@deleteBanner');</li>
			<li> Create deleteBanner function :-
Now create deleteBanner function in BannersController to delete the banner image from folder and banners table.</li>
		</ol>


<h1>make home page banner dynamic part 3 || add/edit banner in admin panel</h1>

<ol>
	<li> Update admin_sidebar.blade.php file :-
First of all, we will add "Banners" link at left sidebar of the admin panel.</li>
	<li>Create Route :-
Create GET/POST route for add/edit banner in web.php file like below :-
Route::match(['get','post'],'add-edit-banner/{id?}','BannersController@addEditBanner');</li>
	<li>Create addEditBanner function :-
Now we will create addEditBanner function in BannersController to add and update existing banner.</li>
	<li>Create add_edit_brand.blade.php file :-
Now create add_edit_brand.blade.php file under /resources/views/admin/banners/ path in which we will add banner form to add/update banner.</li>
</ol>

<h1>make home page banner dynamic part 4 || display banner at index page</h1>

<ol>
	<li>Create getBanners function :-
First of all, we will create getBanners function at Banner model to get the home page banners and return to index blade file.</li>
	<li>Update front_layout.blade.php file :-
Now we will update front_layout.blade.php file and will add below :-
<ul>
	<li>Include Banner model and call getBanners function from Banner model.</li>
	<li>Add foreach loop to show enabled banners with image, link, alt and title that we have got from getBanners function.

Now you can check in video; Home Page Banners are dynamic coming from the admin panel.

Now our complete home page is dynamic with dynamic header menu, left sidebar, featured products, new arrival products and home page banners.</li>
</ul></li>
</ol>

<h1>make listing page part 1  create controller// route//function || overview</h1>

<p>Like if we open link of t-shirts category then it will display all t-shirts. And if we open the link of shirts category then it will display all shirts.

Here one thing we need to note that if we open link of parent category like shirts that is having sub categories like casual shirts and formal shirts then it will show both casual and formal shirts under shirts category. And if we open casual shirts url then it will show only casual shirts.

Before start work on Listing Page, make one correction in Banners module. Create banners folder at path /resources/views/front/ and move home_page_banners.blade.php file there and update path to include the file at front_layout.blade.php.
{{--@include('front.banners.home_page_banners')</p>--}}
<ol>
	<li>Create ProductsController :-
First of all, we will create ProductsController in Front folder of Controllers.
php artisan make:controller Front/ProductsController</li>
	<li>Create listing Route :-
Now, we will create GET route for our category / listing page in web.php file like below :
Route::get('/{url}','ProductsController@listing');</li>
	<li>Create listing function :-
Now create listing function in ProductsController with parameter url so that we can get all the products of particular category. First we will check if category exists or not. And if not exists then we will return the user to 404 page. We will also design 404 page soon in future videos.</li>
	<li>Create categoryDetails function :-
Now we will create categoryDetails function in Category model to get the category details and category id's. If user opens the parent category url then we will get category id of parent as well as sub categories.
</li>
	<li>Update listing Function :-
Now update listing function in ProductsController to call categoryDetails function to get category details and category id's that will help us to write query to get the products.</li>
</ol>

<h1>make listing page part 2|| embed listing page html//design</h1>
<p>we will continue working on the listing page where we will show all the products of some particular category. In this video, we are going to embed listing page design in our Laravel website and will show category products.</p>
<ol>
	<li>Update listing Function :- 
We will update listing function to write query to get products from category id's that we get from categoryDetails function and return categoryDetails and categoryProducts to listing page that we will create in next step.</li>
	<li>Create listing.blade.php file :-
Now we will create products folder under /resources/views/ folder and then create listing.blade.php file under /resources/views/products/ folder. We will include front design to listing page and copy content (162 to 457 line) from products.html file located at ecom template that we have downloaded earlier from Sitemakers.in website. 

Add foreach loop for categoryProducts array and loop through all the products of particular category that user opens along with the product image, name, price etc.

We can now see shirts are coming in our listing page. Both casual and formal shirts are coming as we have open shirts category. But if we open casual or formal shirt category url then only casual or formal shirts will be shown up.</li>
</ol>

<h1>make listing page part3 || show brand || number of products|| breadcrumb</h1>
<ol>
	<li>Update catDetails function :-
First of all, update catDetails function to select category_name and url in subcategories sub query otherwise it will give error.</li>
	<li>Create brand function :-
Now, create brand function in Product model with belongsTo relation in which every product belongs to Brand.</li>
	<li> Update listing function :-
Now update listing function to attach brand relation with products query to get the brand of the product as well.</li>
	<li>Update listing.blade.php file :-
Now update listing file to show the brand of the product as well. We can replace description with brand name. 

Also, we will show products count at the top right side of the listing page.
{{--{{ count($categoryProducts) }}--}} products are available

And, we will also show category description at the top of listing page under category name but make sure to select category description in query as well.</li>
	<li> Update catDetails function :-
Now we will update catDetails function in Category model to update query to add breadcrumbs both for main category and sub category.
If main category is selected like shirts then only shirts will appear in breadcrumb along with home link and if sub category is selected like formal shirts then both shirts and formal shirts will appear in breadcrumb along with home link.

So we will add condition with parent_id of category. If parent_id of the category is 0 then current category is the parent category. And if parent_id of the category is greater then 0 then it means parent category of the current category exists.</li>
	<li>Update listing.blade.php file :-
Now update listing.blade.php file to show breadcrumbs that we have generated both for main and sub category.</li>
</ol>

<h1>make listing page part 4 || descriptive view of listing</h1>

<ol>
	<li>Update listing.blade.php file :-
Add foreach loop to show products in another design of listing page where we will display Product Name, Brand Name, Description, Product Price and Product Image.

Now you can see products listing in both available designs.</li>
	<li>Update front_header.blade.php file :-
Now we will update header menu in front_header.blade.php file and add link for the listing page for the categories so that we can go directly to any category page.</li>
	<li>Update front_sidebar.blade.php file :-
Now we will update front sidebar section in front_sidebar.blade.php file and add link for the categories so that we can go directly to any category page.

So now our category pages are ready. You can add as many categories as you want from admin with their URL and it will be dynamically created and will display in left and top menu. And you can go to any category page where only products of that category will be displayed.</li>
</ol>

<h1>make listing page part 5|| simple pagination || paginate method</h1>
<p>Simple Pagination
If you only need to display simple "Next" and "Previous" links in your pagination view, you may use the simplePaginate method to perform a more efficient query. 

Paginate Method :-
We will also integrate Paginate method that will not only display "Next" and "Previous" links but also Page numbers like 1, 2, 3 and so on depends upon the number of products that you want to show in each page.</p>
<ol>
	<li>Update listing function :- 
First of all, we will update listing function to replace get method and toArray with paginate method in query. We will also pass value 6 as argument in paginate method for number of products we want to display "per page".

First we will try with simplePaginate method and then with paginate method. We need to remove get and toArray and then only add paginate or simplePaginate method.</li>
	<li>Update listing.blade.php file :-
Now we will use links method of pagination at listing.blade.php file that will display the links of rest of the pages in which we are showing maximum 6 products. And, HTML generated by the links method is compatible with the Bootstrap CSS framework.

Now we can see in video that pagination has come now and maximum of 6 products are displaying in 1 page.</li>
</ol>

<h1>make listing page part 6 || sorting filters || sort by price/name/new</h1>

<ol>
	<li>Update listing.blade.php file :-
First of all, we will update "Sort By" select box with below options :-
Latest Product
Product name A - Z
Product name Z - A
Lowest Price first
Highest Price first

We will also update sort by form id and name with sortProducts.</li>
	<li>Create front_script.js :-
Now we will create front_script.js file for front like we have created admin_script.js for admin.

In front_script.js file, we will add jquery to submit Sort by form with change event that works every time when sort option selected.</li>
	<li>Update front_layout.blade.php file :-
Now include newly created front_script.js file at front_layout.blade.php</li>
	<li>Update listing function :-
Now we need to update listing function to update query with sort option if selected.</li>
	<li>Update listing.blade.php file :-
Finally, we require to update listing file to appends option of paging that append the pagination links with query string like sort.

Also, update sortProducts form to show the selected sort option in Sort By select drop down.</li>
</ol>
	</div>  
	
</body>
</html>





















