<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com str 7</title>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="text-capitalize">
		<h1>e-con frontend||download template part 1</h1>
		<ol>
			<li>Open below website :-
http://sitemakers.in
</li>
			<li>Click on "STACK DEVELOPERS" link at top navigation that will take you to Stack Developers section</li>
			<li>Click on "Login to Download" link to download Free Advance E-commerce HTML Responsive Template
</li>
			<li>Enter below Username and Password to login  :-
Username :- stackdevelopers
Password :- laravelwithamit</li>
			<li>After login, click on "Click Here to Download" link to download Free Advance E-commerce HTML Responsive Template that we will use for our E-commerce website.
</li>
			<li>Understand the E-shop Process
We need to understand the E-shop Process in which user comes into the website; search for the product, add into shopping cart and place order for it. 
<pre>
i) Index/Home Page
ii) Listing Page 
iii) Product Detail Page
iv) Shopping Cart Page
v) Login/Register/Account Pages
vi) Checkout Page
vii) Order Review Page
viii) Payment Method / COD
ix) Confirmation of Order Placement

</pre>
</li>
		</ol>

		<h1>merge e-com html template part 1||copy html/image/js/css</h1>
		<p>And we will also create route, controller, function for index page and set its design as well.
</p>
		<ol>
			<li>Copy CSS, JS, Images and Fonts :-
First of all, we will copy CSS, JS, Images and Plugins from html template to our Laravel file structure.
<ul>
	<li>Copy CSS Files :- 
We will create front_css folder under /public/css and copy all CSS files from /themes/css/ folder of html template into it.
</li>
	<li>Copy JS Files :- 
We will create front_js folder under /public/js and copy all JS files from /themes/js/ folder of html template into it.
</li>
	<li>Copy Images :- 
We will create front_images folder under /public/images and copy all Images from themes/images/ and themes/img/ of html template into it.
</li>
	<li>Copy Fonts :- 
We will copy font folder from html template folder and paste into public folder in our Laravel website.
</li>
</ul>
</li>
			<li>Create front_layout Folder and front_layout.blade.php File :-
We will create front_layout Folder under resources/views/layouts/ path in which we will create front_layout.blade.php file. 

We will copy content from index.html file from html template folder and paste it into this front_layout.blade.php file. 

Before making further changes in this file, we will also create below files under front_layout Folder :-

front_header.blade.php
front_footer.blade.php
front_sidebar.blade.php

front_header.blade.php file contains the header part of our E-com website

front_footer.blade.php file contains the footer part of our E-com website

front_sidebar.blade.php file contains the left sidebar of our E-com website

We will add content into above three files and will also update front_layout.blade.php file as shown in video.  

In front_header.blade.php file, add header related code and we will include front_header.blade.php file in front_layout.blade.php file like below :-
{{--@include('layouts.front_layout.front_header')--}}

In front_footer.blade.php file, add footer related code and we will include front_footer.blade.php file in front_layout.blade.php file like below :-.
{{--@include('layouts.front_layout.front_footer')--}}
In front_sidebar.blade.php file, add sidebar related code and and we will include front_sidebar.blade.php file in front_layout.blade.php file like below :-
{{--@include('layouts.front_layout.front_sidebar')--}}
For middle content, add @yield('content') in front_layout.blade.php file that will fetch middle content of the page dynamically. 

For index page, add index.blade.php file under front folder that we will create under /resources/views/ path in which we will copy middle content from index.html file from html template.
</li>
			<li>Create IndexController :-
Now create Front folder under /app/Http/Controllers/ and then create IndexController.php file under Front folder by running below artisan command :-
php artisan make:controller Front/IndexController

We will keep all Front Controllers separate from Admin Controllers that will help us to separate front and admin code.</li>
			<li>Create Route :-
We will create separate group in web.php file for front routes so that we can keep them separately with namespace Front and prefix front.

Learn more about Routing/Controllers including namespaces/route groups in Laravel 6 Basics playlist :-
https://www.youtube.com/playlist?list...
</li>
			<li> Create index function :-
Now create index function in IndexController that will return to index.blade.php file in which we have already copied middle content of index.html

You can check now in video; home page of our ecom website will come but without any css and images that we will set in next video by using url and asset functions of laravel.</li>
		</ol>

		<h1>merge e-com html templte part 2 || update front layout files</h1>

		<ol>
			<li>Update front_layout.blade.php file :-
First of all, we will update front_layout.blade.php file to add Laravel asset/url to css, js and images paths.
</li>
			<li>Update front_header.blade.php file :-
Now we will update front_header.blade.php file to add Laravel asset to images paths. No image exists in header so we can skip this step.</li>
			<li>Update front_sidebar.blade.php file :-
Now we will update front_sidebar.blade.php file to add Laravel asset to images paths.
</li>
			<li>Update front_footer.blade.php file :-
Now we will update front_footer.blade.php file to add Laravel asset to images paths.
</li>
			<li>Update index.blade.php file :-
Now we will update index.blade.php file to add Laravel asset to images paths.
</li>
			<li>Update font-awesome.css file :-
Now we will update font-awesome.css file to update paths of all font.

Now we will add condition to show Home Page banners in home page only, not in other pages.
</li>
			<li>Update index function :-
We will update index function in IndexController with page_name variable with value Index that we will compare in front_layout.
</li>
			<li>Update front_layout.blade.php file :-
Now we will add condition in front_layout.blade.php file to show banners in home page only. We will check if page_name is coming as Index and will show banners in home page.
</li>
		</ol>

		<h1>make header menu dynamic || sections/categories/sub-categories</h1>
		<ol>
			<li>Create function :-
First of all, we will create sections static function in Section model in which we will also attach categories function so that we will get categories and sub categories of every section in array.</li>
			<li> Update front_header.blade.php :-
Now we will include Section model and call sections function in front_header.blade.php and integrate foreach loop for sections, categories and sub categories in header menu. 

We will only show those sections that are having categories under it otherwise we will not show.

Now we able to show Sections, Categories and Sub Categories dynamically in header menu. We can add/remove any of the categories for the changes to make effect in menu.
</li>
		</ol>

		<h1>make left sidebar dynamic || sections/categories/sub-categories</h1>
		<ol>
			<li>Update front_sidebar.blade.php file :-
First include Section model to call sections function that we have made in last video to get sections, categories and their sub categories to show them in foreach loop at left sidebar.
</li>
		</ol>

		<h1>make featured product dynamic || home page || update admin jquery</h1>
		<ol>
			<li>Update admin_script.js file :-
First of all, we will resolve jquery issue that will come in paging of the datatables. We will update click events admin_script.js file as shown in video.
</li>
			<li>Update addEditProduct function :-
Now update addEditProduct function so that is_featured column works properly if checked or unchecked.

Now we will work on making featured products dynamic at home page.</li>
			<li>Update index function :-
Now update index function at IndexController to write query for featured products with array_chunk so that we can make sub arrays of 4 products in main array. Also we will count featured products and return to index blade file.</li>
		</ol>

			<h1>make featured product dynamic part 2 || home page || use array_chunk</h1>

			<ol>
				<li>Update index.blade.php file :-
We will add foreach loops in index.blade.php file for featured products. In inner foreach loop, we will show products that will come as sub array of 4 products.
</li>
			</ol>
	</div>

</body>
</html>
























