$(document).ready(function(){
	/*$("#sort_item").on('change',function(){
        
        this.form.submit();
	});*/
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	 $("#sort_item").on('change',function(){
	 	//alert("test");
	 	var sort_item = $(this).val();
	    var fabric = get_filter("fabric");
	    var sleeve = get_filter("sleeve");
	    var pattern = get_filter("pattern");
	    var fit = get_filter("fit");
	    var occassion = get_filter("occassion");
	 	var url = $("#url").val();
	 	//alert(sort_item);
	 	//alert(url);

	 	$.ajax({
	 		url:url,
	 		method:"post",
	 		data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occassion:occassion,sort_item:sort_item,url:url},
	 		success:function(data){
	 			$('.filter_products ')
	 		}
	 	})
	 });

	 $(".fabric").on('click',function(){
	 	var fabric = get_filter('fabric');
	    var sleeve = get_filter('sleeve');
	    var pattern = get_filter("pattern");
	    var fit = get_filter("fit");
	    var occassion = get_filter("occassion");
	 	var sort_item = $("#sort_item option:selected").text();
	 	var url = $("#url").val();
	 	    $.ajax({
	 		url:url,
	 		method:"post",
	 		data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occassion:occassion,sort_item:sort_item,url:url},
	 		success:function(data){
	 			$('.filter_products ')
	 		}
	 	})

	 });


	 $(".sleeve").on('click',function(){
        var fabric = get_filter('fabric');
	    var sleeve = get_filter('sleeve');
	    var pattern = get_filter("pattern");
	    var fit = get_filter("fit");
	    var occassion = get_filter("occassion");
	    var sort_item = $("#sort_item option:selected").text();
	 	var url = $("#url").val();
	 	    $.ajax({
	 		url:url,
	 		method:"post",
	 		data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occassion:occassion,sort_item:sort_item,url:url},
	 		success:function(data){
	 			$('.filter_products ')
	 		}
	 	})
 
	 });

	 $(".pattern").on('click',function(){
        var fabric = get_filter('fabric');
	    var sleeve = get_filter('sleeve');
	    var pattern = get_filter("pattern");
	    var fit = get_filter("fit");
	    var occassion = get_filter("occassion");
	    var sort_item = $("#sort_item option:selected").text();
	 	var url = $("#url").val();
	 	    $.ajax({
	 		url:url,
	 		method:"post",
	 		data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occassion:occassion,sort_item:sort_item,url:url},
	 		success:function(data){
	 			$('.filter_products ')
	 		}
	 	})

	 });



	 $(".fit").on('click',function(){
        var fabric = get_filter('fabric');
	    var sleeve = get_filter('sleeve');
	    var pattern = get_filter("pattern");
	    var fit = get_filter("fit");
	    var occassion = get_filter("occassion");
	    var sort_item = $("#sort_item option:selected").text();
	 	var url = $("#url").val();
	 	    $.ajax({
	 		url:url,
	 		method:"post",
	 		data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occassion:occassion,sort_item:sort_item,url:url},
	 		success:function(data){
	 			$('.filter_products ')
	 		}
	 	})

	 });



	 $(".occassion").on('click',function(){
        var fabric = get_filter('fabric');
	    var sleeve = get_filter('sleeve');
	    var pattern = get_filter("pattern");
	    var fit = get_filter("fit");
	    var occassion = get_filter("occassion"); 
	    var sort_item = $("#sort_item option:selected").text();
	 	var url = $("#url").val();
	 	    $.ajax({
	 		url:url,
	 		method:"post",
	 		data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occassion:occassion,sort_item:sort_item,url:url},
	 		success:function(data){
	 			$('.filter_products ')
	 		}
	 	})

	 });
 


function get_filter(class_name){
	var filter = [];
	$('.'+class_name+':checked').each(function(){
		filter.puch($(this).val());
	});
	return fliter;
}

$("#getPrice").change(function(){
	//alert("test");
	var size = $(this).val();
	//alert(size);
	if (size=="") {
		alert('please select size');
		return false;
	}
	var product_id = $(this).attr("product-id");
	//alert(product_id);
	$.ajax({
		url:'/get-product-price',
		data:{size:size,product_id:product_id},
		type:'post',
		success:function(resp){
			//alert(resp['product_price']);
			//alert(resp['discounted_price']);
			 //return false;
			 if (resp['discount']>0) {
			    $(".getAttrPrice").html("<del>Rs. "+resp['product_price']+"</del> Rs."+resp['discounted_price']); 
			 }else{
			 	$(".getAttrPrice").html("Rs. "+resp['product_price']);
			 }
		},error:function(){
			alert("error");
		}
	});
});
 
//update cart items + - items
$(document).on('click','.btnItemUpdate',function(){
	if ($(this).hasClass('qtyMinus')) {
	//if munis btn clicked by user	
		var quantity = $(this).prev().val();
		//alert(quantity);
		if (quantity<=1) {
			alert("item can't be 0");
			return false;
		}else{
			new_qty = parseInt(quantity)-1;
		}
	} 

	if ($(this).hasClass('qtyPlus')) {
	//if plus btn clicked by user
	    var quantity = $(this).prev().prev().val();
	    //alert(quantity); return false;
	    new_qty = parseInt(quantity)+1;	
	}
	//alert (new_qty);
	var cartid = $(this).data('cartid');
	//alert (cartid);
	$.ajax({
		data:{"cartid":cartid,"qty":new_qty},
		url:'/update-cart-item-qty',
		type: 'post',
		success:function(resp){
			//alert(resp.status);
			if (resp.status==false) {
				alert(resp.message);
			}
			//alert(resp.totalCartItems);
			$(".totalCartItems").html(resp.totalCartItems);
			$("#AppendCartItems").html(resp.view);
		},error:function(){
			alert('error'); 
		}
	});
});



//delete cart items 
$(document).on('click','.btnItemDelete',function(){
	
	var cartid = $(this).data('cartid');
	//alert (cartid); return false;
	var result = confirm("want to delete this cart item");
	if (result) {
		
		$.ajax({
		data:{"cartid":cartid},
		url:'/delete-cart-item',
		type: 'post',
		success:function(resp){
			$(".totalCartItems").html(resp.totalCartItems);
			$("#AppendCartItems").html(resp.view);
		},error:function(){
			alert('error'); 
		}
	 });

	}
});

// validate register form on keyup and submit
		$("#registerForm").validate({
			rules: {
				name: "required",
				mobile: {
					required: true,
					minlength: 10,
					maxlength: 10,
					digits: true
				},
				password: {
					required: true,
					minlength: 6
				},
				email: {
					required: true,
					email: true,
					remote: "check-email"
				}
			},
			messages: {
				name: "Please enter your name",
				mobile: {
					required: "Please enter a mobile number",
					minlength: "Your mobile must consist of 10 digits",
					maxlength: "Your mobile must consist of 10 digits",
					digits: "mobile number must be in dig"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long"
				},
				email: {
					required: "Please enter your email",
					email: "Please enter a valid email address",
					remote: "email already exists"
				}
			}
		});

// validate login form on keyup and submit
		$("#loginForm").validate({
			rules: {
				password: {
					required: true,
					minlength: 6
				},
				email: {
					required: true,
					email: true,
				}
			},
			messages: {
				password: {
					required: "Please enter a password",
					minlength: "Your password must be at least 6 characters long"
				},
				email: {
					required: "Please enter your email",
					email: "Please enter a valid email address",
				}
			}
		});


		// validate account form on keyup and submit
		$("#accountForm").validate({
			rules: {
				name: {
					required: true,
					lettersonly: true
				},
				mobile: {
					required: true,
					minlength: 10,
					maxlength: 10,
					digits: true
				},
			},
			messages: {
				name: {
				   required: "Please enter your name",
				   lettersonly: "please enter valide name"
				},
				mobile: {
					required: "Please enter a mobile number",
					minlength: "Your mobile must consist of 10 digits",
					maxlength: "Your mobile must consist of 10 digits",
					digits: "mobile number must be in dig"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long"
				},
				email: {
					required: "Please enter your email",
					email: "Please enter a valid email address",
					remote: "email already exists"
				}
			}
		});


		// validate update password form on keyup and submit
		$("#passwordForm").validate({
			rules: {
				current_pwd: {
					required: true,
					minlength: 6,
					maxlength: 10
				},
				new_pwd: {
					required: true,
					minlength: 6,
					maxlength: 10,
				},
				confirm_pwd: {
					required: true,
					minlength: 6,
					maxlength: 10,
					equalTo:"#new_pwd" 
				} 
			}
		});



		//check current user password
		$("#current_pwd").keyup(function(){
			var current_pwd = $(this).val();
			//alert(current_pwd);
			$.ajax({
				type:'post',
				url:'/check-user-pwd',
				data:{current_pwd:current_pwd},
				success:function(resp){
					//alert(resp);
					if (resp=="false") {
						$("#chkPwd").html("<font color='red'>Current password is Incorrect</font>");
					}else if(resp){
						$("#chkPwd").html("<font color='green'>Current password is correct</font>");
					}
				},error:function(){
					alert('error');
				}
			});
		});

		//apply coupon
		$("#ApplyCoupon").submit(function(){ 
			//alert("test");
			var user = $(this).attr("user");
			if (user==1) {
				//do nothing
			}else{
				alert("please login to apply coupon!");
				return false;
			} 
			var code = $("#code").val();
			$.ajax({
				type:'post',
				data:{code:code},
				url:'/apply-coupon',
				success:function(resp){
					if (resp.message!="") {
						alert(resp.message);
					}
					$(".totalCartItems").html(resp.totalCartItems);
			        $("#AppendCartItems").html(resp.view);
			        if(resp.couponAmount>=0){
			        	$(".couponAmount").text("Rs."+resp.couponAmount);
			        }else{
			        	$(".couponAmount").text("Rs.0");
			        }
			        if (resp.grand_total>=0) {
			            $(".grand_total").text("Rs."+resp.grand_total);
			        }   
			        //alert(resp.couponAmount);
				},error:function(){
					alert("Error");
				}
			})
		});


		$(document).on('click','.addressDelete',function(){
			var result = confirm("want to delete this address?");
			if (!result) {
				return false;
			}
		})

});  