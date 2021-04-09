$(document).ready(function(){
	//check admin password is currect or not
	$("#current_id").keyup(function(){
	var current_id = $('#current_id').val();
	//alert(current_id);
//add ajax
   $.ajax({
   	type:'post',
   	url:'/admin/check-current-pwd',
   	data:{current_id:current_id},
   	success:function(resp){
   		//alert(resp);
   		if (resp == "false") {
   		$("#check_pwd").html("<font color=red>current password is incurrect</font>");	
   		}else if(resp == "true"){
   		$("#check_pwd").html("<font color=green>current password is currect</font>");	
   		}
   	},error:function(){
   		alert('error');
   	}
   });	
});
//for update section
          $(document).on("click",".updateSectionStatus",function(){
      var status = $(this).text();
      var section_id = $(this).attr("section_id");
    //  alert(status);
      //alert(section_id);
      $.ajax({
         type:'post',
         url:'/admin/update-section-status',
         data:{status:status,section_id:section_id},
         success:function(resp){
          //  alert(resp['status']);
           // alert(resp['section_id']);
            if(resp['status']==0){
               $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>inactive</a>");
          }else if(resp['status']==1){
               $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>active</a>");

          }

         },error:function(){
            //alert('error');
         }
      });
   });

 //for update category
      $(document).on("click",".updateCategoryStatus",function(){
      var status = $(this).text();
      var category_id = $(this).attr("category_id");
    //  alert(status);
      //alert(section_id);
      $.ajax({
         type:'post',
         url:'/admin/update-category-status',
         data:{status:status,category_id:category_id},
         success:function(resp){
          //  alert(resp['status']);
           // alert(resp['section_id']);
            if(resp['status']==0){
               $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>inactive</a>");
          }else if(resp['status']==1){
               $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>active</a>");

          }

         },error:function(){
           // alert('error');
         }
      });
   });

    //for product  update status
    //https://www.youtube.com/watch?v=HV7gtlKCQto&list=PLLUtELdNs2ZaHaFmydqjcQ-YyeQ19Cd6u&index=30
    $(document).on("click",".updateProductStatus",function(){
      var status = $(this).text();
      var product_id = $(this).attr("product_id");
      //alert(status);
      //alert(section_id);
      $.ajax({
         type:'post',
         url:'/admin/update-product-status',
         data:{status:status,product_id:product_id},
         success:function(resp){
           //alert(resp['status']);
           //alert(resp['section_id']);
            if(resp['status']==0){
               $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>inactive</a>");
          }else if(resp['status']==1){
               $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>active</a>");

          }

         },error:function(){
            //alert('error');
         }
      });
   });  

      //for product attribute  update status
    //https://www.youtube.com/watch?v=HV7gtlKCQto&list=PLLUtELdNs2ZaHaFmydqjcQ-YyeQ19Cd6u&index=30
    $(document).on("click",".updateAttributeStatus",function(){
      var status = $(this).text();
      var attribute_id = $(this).attr("attribute_id");
      //alert(status);
      //alert(section_id);
      $.ajax({
         type:'post',
         url:'/admin/update_attribute',
         data:{status:status,attribute_id:attribute_id},
         success:function(resp){
           //alert(resp['status']);
           //alert(resp['section_id']);
            if(resp['status']==0){
               $("#attribute-"+attribute_id).html("inactive");
          }else if(resp['status']==1){
               $("#attribute-"+attribute_id).html("active");

          }

         },error:function(){
            alert('error');
         }
      });
   });

         //for product brand  update status
    //https://www.youtube.com/watch?v=HV7gtlKCQto&list=PLLUtELdNs2ZaHaFmydqjcQ-YyeQ19Cd6u&index=30
    $(document).on("click",".updatebrandtatus",function(){
      var status = $(this).children("i").attr("status");
      var brand_id = $(this).attr("brand_id");
      //alert(status);
      //alert(section_id);
      $.ajax({
         type:'post',
         url:'/admin/update_brand',//this is the route we have to create
         data:{status:status,brand_id:brand_id},
         success:function(resp){
           //alert(resp['status']);
           //alert(resp['section_id']);
            if(resp['status']==0){
               $("#brand-"+brand_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='inactive'></i>");
          }else if(resp['status']==1){
               $("#brand-"+brand_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='active'></i>");

          }
 
         },error:function(){
            alert('error');
         }
      });
   });


    $(document).on("click",".updatebannerstatus",function(){
      var status = $(this).children("i").attr("status");
      var banner_id = $(this).attr("banner_id");
      //alert(status);
      //alert(section_id);
      $.ajax({
         type:'post',
         url:'/admin/update_banner',//this is the route we have to create
         data:{status:status,banner_id:banner_id},
         success:function(resp){
           //alert(resp['status']);
           //alert(resp['section_id']);
            if(resp['status']==0){
               $("#banner-"+banner_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='inactive'></i>");
          }else if(resp['status']==1){
               $("#banner-"+banner_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='active'></i>");

          }

         },error:function(){
            alert('error');
         }
      });
   });


     //for product image  update status
    //https://www.youtube.com/watch?v=HV7gtlKCQto&list=PLLUtELdNs2ZaHaFmydqjcQ-YyeQ19Cd6u&index=30
  $(document).on("click",".updateimagestatus",function(){
      var status = $(this).text();
      var images_id = $(this).attr("images_id");
      //alert(status);
      //alert(section_id);
      $.ajax({
         type:'post',
         url:'/admin/update_image',
         data:{status:status,images_id:images_id},
         success:function(resp){
           //alert(resp['status']);
           //alert(resp['section_id']);
            if(resp['status']==0){
               $("#image-"+images_id).html("inactive");
          }else if(resp['status']==1){
               $("#image-"+images_id).html("active");

          }

         },error:function(){
            alert('error');
         }
      });
   });


   //append categories level
   $('#section_id').change(function(){
      var section_id = $(this).val();
      //alert(section_id);
      $.ajax({
        type:'post',
        url:'/admin/category_level',
        data:{section_id:section_id},
        success:function(resp){
          $("#cate_level").html(resp);

        },error:function(){
          alert("error");
        }
      });
   }); 

   //confirm deletion of record
  /* $(".confirmDelete").click(function(){
    var name = $(this).attr("name");
    if(confirm(" Are You Sure To Delete This "+name+"?")){
      return true;
    }
      return false;
   }); */



   //confirm deletion with sweetalert
   //$(".confirmDelete").click(function(){//this function we can use in all function for delete
    $(document).on("click",".confirmDelete",function(){//as the deleting function is not working in pagenation so we use this function
    var record = $(this).attr("record");
    var recordid = $(this).attr("recordid");
    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
    window.location.href = "/admin/"+record+"/"+recordid;
  }
});
       });


//product attribute add/remove script
   var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><br><input type="text" name="size[]" style="width:120px" placeholder="Size"/>   <input type="text" name="sku[]" style="width:120px" placeholder="SKU"/>   <input type="text" name="price[]" style="width:120px" placeholder="Price"/>   <input type="text" name="stock[]" style="width:120px"  placeholder="Stock"/><a href="javascript:void(0);" class="remove_button">remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    }); 
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });


    //show hide coupon field for manual auto
    $("#ManualCoupon").click(function(){
      $("#couponField").show();
    });

    $("#AutomaticCoupon").click(function(){
      $("#couponField").hide();
    });

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

  //show courier name and tracking number in case of shipping order status
  $("#courier_name").hide();
  $("#tracking_number").hide();
  $("#order_status").on("change",function(){
    //alert(this.value);
    if (this.value=="Shipped") {
      $("#courier_name").show();
      $("#tracking_number").show();
    }else{
      $("#courier_name").hide();
      $("#tracking_number").hide();
    }
  });    

});	


























