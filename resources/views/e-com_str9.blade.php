<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>com_srt9</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="text-capitalize">
		
     <h1>make website online part 1 || search & buy domain || hosting</h1>
     <p>It is the time when we have developed something and want to show the client and the only way is to make the website online so that the client can also test. And for making the website online on internet, we require domain and hosting. 

Domain name is the address on internet where users can access your website.

Web hosting is an online service that enables you to publish your website on the Internet. Many web hosting service provider provides the service to host the website to show on internet.

We will use Godaddy Hosting Service provider to register and host our website.

You can use below link to host your website on less cost  :-
https://www.jdoqocy.com/click-1002080...</p>

<ol>
	<li>Select and buy domain for website
</li>
	<li>Select and buy hosting for website
</li>
	<li>Upload the website code via File Manager or FTP
</li>
	<li>Upload database of website
</li>
	<li>Making Connection and other required settings
</li>
</ol>
<p>In this video, we are going to buy domain and hosting for our E-commerce website from Godaddy i.e. one of the top domain and hosting service provider. 

In next video, we will upload our e-commerce website code via File Manager and Filezilla FTP and will do final settings to make it live.</p>


<h1>make website online part 2 || upload via file manager / FTP | upload database</h1>
<p>In this video, we will upload our e-commerce website code via File Manager and Filezilla FTP.</p>
<p>Make sure to install Filezilla FTP as per your operating system :-https://filezilla-project.org</p>
<p>We will also create and import our advance e-commerce website database in our new hosting account.</p>
<p>Finally, after doing some necessary settings, we will able to make our Advance E-commerce Website online up till listing page.</p>


<h1>make listing page part 7 | sorting filters | display products with ajax</h1>
<ol>
	<li>Update listing function :-
First of all, we will update listing function to return url to listing.blade.php file.</li>
	<li>Create ajax_products_listing.blade.php file :- 
First of all, create ajax_products_listing.blade.php file at path /resources/views/front/products/ in which we will add foreach loop of products that is in listing.blade.php file and we will add class "filter_products" and include ajax_products_listing.blade.php

Also, add hidden field for url in listing.blade.php file.</li>
	<li> Update front_script.js file :-
Update front_script.js file to add jquery script that will work with change event for sort select box. We will get sort option and url and send that to listing function with ajax.</li>
	<li>Update listing function :-
Now we will update listing function to get the url and sort data from ajax.</li>
</ol>

<h1>make listing page part 8|| sorting filter | display with ajax</h1>

<p>In Part-72 of Advance E-com Series in Laravel 7, we will continue working on the listing page where we will show all the products of some particular category. In this video, we able to sort products and display them with ajax without refreshing the page.</p>
<p>
Update listing function :-
Update listing function to get the url and sort data from ajax and add conditions in query to sort the products with the sort option selected by the user.</p>
<p>Now we can able to sort the products with ajax without refreshing the page.
</p>

<h1>make listing page part 9</h1>

<ol>
	<li>Create productFilters function :- 
First of all, we will create productFilters function in Product model so that we can update filters at the one place only every time if we want to add new filter and its value. We will call productFilters function both at front and admin panel.</li>
	<li>Update addEditProduct function :-
Now we will update addEditProduct function located at /Admin/ProductsController.php file and delete earlier filter arrays and call productFilters function that we have made in last step. We will return all filter arrays after getting them from productFilters function.</li>
	<li>Update listing function :-
Now we will update listing function to call productFilters function in else part of condition and return all filters arrays to listing blade file. Also we will use page_name variable and return listing value so that we can add condition to show filters in listing page only.</li>
	<li>Update front_sidebar.blade.php file :-
Now update front_sidebar.blade.php file to show all filters at left sidebar within condition of listing page as filters will appear only at listing page.
We will use foreach loop for all filters to display their values.</li>
</ol>

<h1>make listing page part 10 || sorting filter | display products with ajax</h1>

<ol>
	<li>Update front_sidebar.blade.php file :-
First of all, we will update front_sidebar.blade.php file and add class for all filters so that we can call jquery function with that class.</li>
	<li>Update front_script.js file :-
Now we will update front_script.js file and add get_filter function that will get all the selected values of our filters so that we can pass to listing function via ajax <span>Now we will work on fabric jquery function that will work on click of fabric class and we will return url, fabric and sort values to listing function via ajax</span> </li>
	<li>Update listing function :-
Now we will update listing function at Front/ProductsController and add condition for getting products with selected fabrics in query located at the ajax condition. </li>
	<li>Update front_script.js file :-
Update front_script.js file once again to update sort jquery function to return fabric in it as well so that sort filter will work along fabric filter.</li>
</ol>

<h1>make listing page part 11 ||sorting filter || display product with ajax</h1>

<ol>
	<li>Update front_sidebar.blade.php file :-
First of all, we will update front_sidebar.blade.php file and make sure to add class for all filters so that we can call jquery function with that class.</li>
	<li>Update front_sidebar.blade.php file :-
First of all, we will update front_sidebar.blade.php file and make sure to add class for all filters so that we can call jquery function with that class.</li>
	<li>Update listing function :-
Now we will update listing function at Front/ProductsController and add condition for getting products with all selected filters in query located at the ajax condition.</li>
</ol>

<h1>make listing page part 12|| listing pge routing like shirt</h1>
<ol>
	<li> Update web.php file :-
We will update web.php file like below :- <ul>
	<li>Include Category model :- We we include Category model at the top of web.php file :-
use App\Category;</li>
	<li> Disable earlier Listing Page route :-
We will disable earlier listing page route.</li>
	<li>Fetch all Category Url's :-
We will fetch all category url's by writing query in web.php file itself and write Listing route within foreach loop so that we can make routes for our all listing pages.</li>
</ul> </li>
	<li>Update listing function :-
Now update listing function at Front/ProductsController and remove $url from parameters and in else condition, get currently opened category url.</li>
	<li>Include Header Statement :-
Now include below header statement at top of Front/ProductsController :-
use Illuminate\Support\Facades\Route;</li>
</ol>
	</div>
</body>
</html>