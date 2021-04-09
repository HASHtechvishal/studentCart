<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com_str2</title>
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
	<div class="text-capitalize">
		<h1>update admin details</h1>
		<ol>
			<li>Create Route :- 
Create GET/POST route for updating admin details in web.php file like below :-
Route::match(['get','post'],'update-admin-details', 'AdminController@updateAdminDetails');</li>
			<li> Create updateAdminDetails function :-
Create updateAdminDetails function in AdminController and return to update_admin_details.blade.php file.</li>
			<li>Create update_admin_details.blade.php file :-
Now create update_admin_details.blade.php file at resources/views/admin/ folder. 

We will create update admin details form with admin name, email, image and mobile with email as read only.
 </li>
			<li>Update updateAdminDetails function :-
Now update updateAdminDetails function to get admin name and mobile and update in admins table. 

We will also validate name and mobile and return to update admin details form in case name and mobile is not valid. 
</li>
			<li>Update update_admin_details.blade.php file :-
We will add alert div at update_admin_details.blade.php file that we will display in case if name or mobile is not valid.
</li>
		</ol>

		<h1>update admin image | install intervention package</h1>
		<ol>
			<li>Install Intervention Package :-
Simply run below composer command to install Intervention Package :-
composer require intervention/image</li>
			<li>Update update_admin_details.blade.php file :-
Add enctype="multipart/form-data" in update admin details form to accept files and we will also add condition to show admin image and add another hidden field for current admin image.</li>
			<li>Update updateAdminDetails function :-
Now we will update updateAdminDetails function to add validation for image and will add upload image script and finally save the image name in admins table as well.

We will create admin_photos folder under admin_images folder where we will store all admin images.</li>
			<li>Update admin_sidebar.blade.php file :-
Now we will update admin sidebar with admin image who logged in. If no admin image exists then we will show some dummy image. </li>
		</ol>

		<h1>update admin sidebar</h1>
		<ol>
			<li>Update dashboard function :-
Update dashboard function with page session having dashboard value.</li>
			<li>Update settings function :-
Update settings function with page session having settings value.
Session::put('page','settings');
</li>
			<li> Update updateAdminDetails function :-
Update updateAdminDetails function with page session having update-admin-details value.
Session::put('page','update-admin-details');

Future pages also we will add in session so that we can also highlight them on left sidebar.</li>
			<li>Update admin_sidebar.blade.php file :-
We will add conditions at left sidebar to highlight sections if it matches with the page session value.</li>
		</ol>

		<h1>section module in admin panel part1 || migration seeding</h1>
		<ol>
			<li>Create sections table :-
First of all, we will create sections table with migration. Create migration file with name create_sections_table for creating sections table with below columns :-
id, name, status

So, we will run below artisan command to create migration file for sections :-
php artisan make:migration create_sections_table

Open create_sections_table migration file and add all required columns mentioned earlier.

Now, we will run below artisan command to create sections table with required columns :- 
php artisan migrate
</li>
			<li>Create Section model :-
Create Section model by running below command :-
php artisan make:model Section
</li>
			<li>Create SectionController :-
Create SectionController by running below command :-
php artisan make:controller Admin/SectionController

Now, We will create Seeding for sections table to insert sections like Men, Women and Kids from file.</li>
			<li>Writing Seeder / Create SectionsTableSeeder file :-
First of all, we will generate seeder and create SectionsTableSeeder file where we will add records for sections table.

Run below artisan command to generate Seeder and create SectionsTableSeeder file :-
php artisan make:seeder SectionsTableSeeder

Above command will create SectionsTableSeeder.php file at \database\seeds\

Now open SectionsTableSeeder file and add record for section.</li>
			<li>Update DatabaseSeeder.php file :-
Now update DatabaseSeeder.php file located at database/seeds/ to add SectionsTableSeeder class as shown in video.
</li>
			<li>Run below command :-
Now run below command that will finally insert records into sections table.
php artisan db:seed</li>
		</ol>


		<h1>section module in admin panel part 2 | display sections</h1>
		<ol>
			<li>Create SectionController :-
In last video, we have created SectionController under app/Http/Controllers/ but we need to remove from their and will add under app/Http/Controllers/Admin folder. We will add all admin related controllers under Admin folder and front related controllers under Front folder.

Create SectionController by running below command :-
php artisan make:controller Admin/SectionController</li>
			<li> Create Route :-
Create GET route in web.php file in admin middleware group prefixed with admin and having namespace Admin for displaying sections in admin panel :-
Route::get('sections','SectionController@sections);</li>
			<li>Create sections function :-
Now create sections function in SectionController to write query to display all the sections in admin panel and return to sections blade file that we will create under /resources/views/admin/sections/ folder.</li>
			<li>Include Section model :-
Include Section model at top of SectionController.
use App\Section;</li>
			<li>Create sections.blade.php file :-
Now create sections.blade.php file under /resources/views/admin/sections/ folder in which we will add content from LTE admin template data.html file located at folder /pages/tables/data.html and will display sections within foreach loop. 
</li>
			<li>Update admin_layout.blade.php file :-
Now include paths for CSS and JS datatable files required for displaying sections in admin panel.

Now check in video; Men, Women and kids sections are displayed in datatable. </li>
		</ol>

		<h1>sections in admin panel part 3 || update active/inactive status (ajax)</h1>
		<ol>
			<li>Update sections.blade.php file :-
Add id, class and section_id attributes for Active and Inactive status for sections at sections.blade.php file that are required to update the status with jquery and ajax.</li>
			<li>Update admin_script.js file :-
Add updateSectionStatus jquery function in admin_script.js file in which we will pass status and section_id that we will return to ajax via admin/update-section-status route. 
</li>
			<li>Create Route :-
Now we will create below Post route in admin middleware group in web.php file for updating status that we pass via ajax in last step.
Route::post('update-section-status','SectionController@updateSectionStatus');
</li>
			<li>Update VerifyCsrfToken.php :-
Add route "admin/update-section-status" in VerifyCsrfToken.php file so that CSRF token mismatch error won't come. </li>
			<li>Create updateSectionStatus :-
Now we will create updateSectionStatus in SectionController to update the status of section in sections table and return back the updated status to ajax via json. </li>
			<li>Update admin_script.js file :-
Update admin_script.js file again to get the status and section id in ajax response and update status in sections.blade.php file.</li>
			<li>Update admin_sidebar.blade.php file :-
Update Admin sidebar to add sections tab. We will add Catalogues as heading or you can add heading of your choice. We will keep sections, categories, products and coupons under catalogues only.</li>
		</ol>
	</div>
</body>
</html>

































