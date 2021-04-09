<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-com str10</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="text-capitalize">
		
		<h1>make detail page part 1|| merge the gesign of product detail page</h1>
		<p>We will also show the product images and will work on zoom feature.

We will show the default price of the product that we will change via ajax when we select different size of the product.

We will also show the related products in the detail page of the product.

In this video, we are going to merge the design of product detail page, create route, function and its blade file.
</p>
<ol>
	<li>Create Route :-
First of all, create GET route for detail page in web.php file like below :-
Route::get('/product/{id}','ProductsController@detail');</li>
	<li>Create function :-
Now we will create detail function in Front/ProductsController that will return to detail blade file.
public function detail($id){
        return view('front.products.detail');
}</li>
	<li>Create detail.blade.php file :-
Now create detail blade file at path /resources/views/front/products/ and copy content from product_details.html file located at our ecom design template. We will also copy themes folder and keep it inside public folder in our laravel project.

We able to merge the design of the detail page in our laravel website.</li>
</ol>

<h1>make detail page part 2|| dynamically show the products </h1>

<ul>
	<li>Update web.php file :-
Also, we are going to remove code from our detail route to make it simple like below :-
Route::get('/product/{id}','ProductsController@detail');</li>
	<li> Update detail function :-
Now we will write query to get product details and return to detail blade file. <br> We will also add category, brand, attributes and images relation with the query to get product category, brand, attributes and images.
</li>
	<li>Update detail.blade.php file :-
Now we will update detail blade file to show the product name, code, color, filters values, description and all other product information.</li>
</ul>

<h1>make detail page part 3 || show products images | zoom images</h1>

<ul>
	<li>Update detail.blade.php file :-
We will update detail.blade.php file to show product main image and will add foreach loop to show all alternate product images with their zoom image</li>
	<li>Update jquery.lightbox-0.5.js :-
We will update jquery.lightbox-0.5.js to update paths of gif lightbox images that we are using for image zoom feature.</li>
	<li>Update detail function :-
Now we will update detail function to get and return the total stock of the product by sum up the stock of their attributes.</li>
</ul>

<h1>make detail page part 4 || show product's sizes price by ajax</h1>
<ul>
	<li> Update detail.blade.php file :-
Update size select box with getPrice id and pass product-id at detail blade file and give class getAttrPrice to h4 where we are showing product price.</li>
	<li> Update front_script.js
Add getPrice jquery function in which we will get size and product_id and return to get-product-price url with Ajax.</li>
	<li>Create Route :-
Now create POST route to get attribute price of the product according to size and return to detail page. 
// Get Product Attribute Price
Route::post('/get-product-price','ProductsController@getProductPrice');</li>
	<li>Create getProductPrice function :-
Now we will create getProductPrice function in ProductsController in which we will get product_id and size from ajax and find out the attribute price and return to ajax function where we return price to getAttrPrice class.</li>
	<li>Update front_script.js
Update ajax response of jQuery getPrice function at front_script.js to return attribute price of product in class getAttrPrice</li>
	<li>Add CSRF token
Now add Laravel CSRF token at front_script.js and add in header as meta in front_layout.blade.php

Now check in video; Price of the product is updating on selection of the Size with Ajax.</li>
</ul>

<h1>make details page part 5 || display related products at detail page</h1>
<ul>
	<li>Update detail function :-
First of all, we will update detail function to write related products query in which we will get all products of the category of the current product.</li>
	<li>Update detail.blade.php file :-
Now we will update detail.blade.php file to add foreach loop for the related products in both designs.</li>
	<li> Update ajax_products_listing.blade.php file :-
Now we will add detail page url for the products located at the listing pages.

In next video, we will create carts table with Migration and will start working on "Add to Cart" functionality.</li>
</ul> <br> <br> <br>


<h1>add to cart part 1 || create carts table || add to cart form</h1>
<ul>
	<li>Create carts table :-
First of all, we will create carts table with migration. Create migration file with name create_carts_table for creating carts table with below columns :-
id, session_id, user_id, product_id, product_size, product_qty, created_at, updated_at

So, we will run below artisan command to create migration file for carts :-
php artisan make:migration create_carts_table

Open create_carts_table migration file and add all required columns mentioned earlier.

Now, we will run below artisan command to create carts table with required columns :- 
php artisan migrate</li>
	<li>Create Cart model :-
Create Cart model by running below command :-
php artisan make:model Cart</li>
	<li>Update detail.blade.php file :-
Create add to cart form with product id, size, quantity fields with action add-to-cart to pass these values to addtocart function.</li>
	<li>Create Route :-
Create POST route for add-to-cart in web.php file like below :-
// Add to Cart Route
Route::post('/add-to-cart','ProductsController@addtocart');</li>
	<li>Create addtocart function :-
Now create addtocart function in ProductsController and get the data from add to cart form.</li>
</ul>

<h1>add to cart part 2 || insert product in carts table | add checks</h1>
<ul>
	<li>We will also add below checks before adding the product in cart :- 
 <ol>
		<li>- Product size is not out of stock</li>
		<li>- Product size not already exists in Shopping Cart</li>
	</ol> </li>
	<li>Update addtocart function :- <ol>
		<li>In this video, we are going to update addtocart function to get the product from the user, check its size is not out of stock and not already exists in cart and finally save into carts table.</li>
	</ol></li>
	<li>Update Headers :-
use App\Cart;
use Session;</li>
</ul>

 <h1>shopping cart part 1 || embed cart page design | show cart items</h1>
 <p>Cart Page
- Embed Cart Page Design 
- Show Cart Items with Image/Details/Price
</p>
 <ul>
 	<li>1) Create Route :-
Create GET route for shopping cart page in web.php file like below :-
// Cart Route
Route::get('/cart','ProductsController@cart');</li>
 	<li>2) Create cart function :-
Now create cart function in ProductsController that will return to cart blade file that we will create in next step.</li>
 	<li>3) Create cart.blade.php file :-
Now create cart blade file at /resources/views/front/products/ in which we will copy content from product_summary.html file from our e-shop html template and add front design to it.

Now you can check design of cart page is ready.</li>
 	<li>Update addtocart function :-
Now we will update addtocart function to include user auth conditions. We will assume that user logged in with username and password so that we can add conditions for it as well.

And if user is not logged in then we will check with user session id.</li>
 	<li>Include Auth :-
Include Auth class at top of ProductsController like below :-
use Auth;</li>
 </ul>

 <h1>shopping cart part 2 || show cart items with user session id
 </h1>

 <ul>
 	<li>Create getCartItems function :-
Update Cart model with getCartItems function in which we will get cart items or products by checking first user auth and if auth is not available means user is not logged in then with user session.</li>
 	<li>Update cart function :-
Now we will update cart function in which we will call getCartItems and print to check if all user items are coming with user session.</li>
 	<li>Create relation :-
Now we will create relation between carts and products table for getting the detail of the product so add product relation function in Cart model with belongsTo relation.</li>
 	<li>Update getCartItems function :-
Now we will update getCartItems function to attach the product relation so that we will get complete product details with every cart item.</li>
 	<li>Update cart.blade.php file :-
Now update cart blade file with foreach loop to show all cart items added by the user without logged in with session id.</li>
 </ul>


 <h1>shopping cart part 3 || show cart items with size wise price</h1>
 <ul>
 	<li>Create getProductAttrPrice function :-
Now create getProductAttrPrice function in Cart model to get attribute price of the product to show in shopping cart.</li>
 	<li>Include Cart Model :-
Now include Cart model in cart.blade.php and call getProductAttrPrice function in foreach loop to get the attribute price of every cart item. <br>We will also calculate and show the sub total of every cart item and will show the final price of the shopping cart without discount.</li>
 </ul>

 <h1>product/category discounts part 1 || show in listing/details page</h1>
 <p>So In this video, we are going to show Product and Category discounts in home listing and detail pages.

If both Product and Category Discount added from admin panel for the product then we will take Product Discount as the first priority.

1st Priority :- Product Discount
2nd Priority :- Category Discount

Suppose if there is 10% Product Discount and 20% Category Discount on the product then we will take 10% Product Discount.

It will be practically more clear when we integrate it.
</p>
 <ol>
 	<li>Create getDiscountedPrice function :-
First of all, we will create getDiscountedPrice function in which we will pass product id to calculate discount on the product. This function we will use for the listing page where sizes are not there and we will pick main product price for category and product discount.</li>
 	<li>Update ajax_products_listing.blade.php :-
Now we will update ajax_products_listing.blade.php to call getDiscountedPrice function and will show discounted price of the product.</li>
 	<li>Update detail.blade.php file :-
Now we will update detail blade file and will call getDiscountedPrice function to show the product or category discount initially without selecting any size.</li>
 </ol>

 <h1>product/category discount paet 2 || show for attributes via ajax</h1>
 <ul>
 	<li>Create getDiscountedAttrPrice function :-
First of all, we will create getDiscountedAttrPrice function in which we will pass product id and size to calculate discount on the product.</li>
 	<li>Update getProductPrice function :-
Now we will update getProductPrice function located at ProductsController and call getDiscountedAttrPrice function to get the discounted price if product or category discount is there for the product. 

We will return the array of product price and discounted price to ajax from where we will display at detail page.</li>
 	<li>Update front_script.js file :-
Now we will update getPrice jQuery function located at front_script.js file to get the response in success function of ajax to show discounted price of the product in case exists.</li>
 </ul>

 <h1>product/category discounts part 3 || show for featured/latest items</h1>
 <p>Include Product model and call getDiscountedPrice function to show discounted price by cutting main price of the product.
</p> 

<h1>shopping cart part 4 || show discount/sub/grand total at cart page</h1>

<ol>
	<li>Update getDiscountedAttrPrice function :-
First of all, we will update getDiscountedAttrPrice function to calculate the product/category discount from product id and size and return.</li>
	<li>Update cart.blade.php file :-
We will update cart page to call getDiscountedAttrPrice function to show the discount and sale/final price of the products along with the cost price/mrp of the product. <br>Also include Cart model at the top of cart.blade.php file.
 </li>
	<li>Update addtocart function :-
We will update addtocart function to redirect the user to cart page once product added to cart from detail page and will show the success message there</li>
	<li>Update cart.blade.php file :-
Now we will update cart page once again to show the success message once product added to cart.</li>
</ol>

<h1>shopping cart part 5|| update cart items quantity via ajax</h1>
<ol>
	<li>Create cart_items.blade.php file :-
First of all, create cart_items.blade.php file at path /front/products/ and move foreach loop of cart items located at cart.blade.php file.</li>
	<li>Update cart.blade.php file :-
Include cart_items.blade.php file inside cart.blade.php file and embed it in div with id AppendCartItems. <br> Now check once if cart page is coming fine and product is adding correctly in cart so that we can move further.</li>
	<li>Update cart_items.blade.php file :-
Now update cart_items.blade.php file and add class btn btnItemUpdate qtyMinus for Quantity minus button and add class btn btnItemUpdate qtyPlus for Quantity plus button. And pass cart id in data-cartid attribute.  </li>
	<li>Update front_script.js file :-
Now add jQuery function for updating cart items at front_script.js file which we will call on click of btnItemUpdate class where we will get cart id and will check if user click on plus or minus button. If user clicks on plus button, then we increment the qty by 1 and if user clicks on minus button then we decrement the qty by 1 but make sure to add check if qty is less then 1.<br>We will use prev jQuery method to get the current quantity of the cart item and more jQuery syntax.</li>
</ol>

<h1>shopping cart part 6 || update cart items qty ajax</h1>
<ol>
	<li>Update front_script.js file :-
Get current quantity, cart item id and plus/minus in Jquery and pass via Ajax to update-cart-item-qty route to pass further to function to update the cart.</li>
	<li>Create Route :-
Now create post route for updating cart item quantity in web.php file like below :-
// Update Cart Item Quantity
Route::post('/update-cart-item-qty','ProductsController@updateCartItemQty');</li>
	<li>Create updateCartItemQty function :-
Now create updateCartItemQty function at Front/ProductsController to get the cart id and new quantity of cart item that we require to update.</li>
	<li>Add Header Statement :-
Add below header statement at top of ProductsController :-
use Illuminate\Support\Facades\View;</li>
	<li> Update front_script.js file :-
Update front_script.js file once again to get response in Ajax and show updated cart items by calling it within success function. </li>
</ol>

<h1>shopping cart part 7 || update cart item if size/stock available</h1>
<ol>
	<li>Update updateCartItemQty function :-
First of all, update updateCartItemQty function to check whether stock demanded by the user in cart is available in products attributes table or not.</li>
	<li>Update front_script.js file :-
Now update jQuery function to get status and alert error message "Product Stock is not available" in case status is false.</li>
	<li>Update updateCartItemQty function :-
We can update updateCartItemQty function to add the size available check as well.</li>
	<li>Update front_script.js file :-
Now update jQuery function once again to get status and alert error message "Product Size is not available" in case status is false.</li>
</ol>

<h1>shopping cart part 8 || delete cart item via ajax</h1>
<ol>
	<li>Update cart_items.blade.php file :-
First of all, update delete cart item button with data-cartid attribute from where we will pass the cart id to jQuery/Ajax and add class btnItemDelete to run jQuery function on click.</li>
	<li>Update front_script.js file :-
Now add jQuery function that will run on click of class btnItemDelete where we will get cartid and send to route and function via Ajax.</li>
	<li>Create Route :-
Now create post route to delete cart item in web.php file like below :-
// Delete Cart Item
Route::post('/delete-cart-item','ProductsController@deleteCartItem');</li>
	<li>Create deleteCartItem function :-
Now create deleteCartItem function from where we will delete cart item and update the shopping cart without refreshing the page.5) Add Confirm Check :-
Now we will add simple javascript confirm check to confirm the user before deleting the cart item.</li>
	<li>Add Confirm Check :-
Now we will add simple javascript confirm check to confirm the user before deleting the cart item.</li>
</ol>
</div>
</body>
</html>