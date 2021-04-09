<?php use App\Product; ?>
@extends('layouts.e-com admin layout.admin_layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper text-capitalize">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Orders</h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orders #{{$orderDetails['id']}} Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid --> 
    </section>


     <x-e-com_alert/>


<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  
                  <tbody>
                    <tr>
          <td>Order Date</td>
          <td>{{date('d-m-Y',strtotime($orderDetails['created_at']))}}</td>
        </tr>
        <tr>
          <td>Order Status</td>
          <td>{{$orderDetails['order_status']}}</td>
        </tr>
        <tr>
          <td>Order Total</td>
          <td>{{$orderDetails['grand_total']}}</td>
        </tr>
        <tr>
          <td>Order Charges</td>
          <td>{{$orderDetails['shipping_charges']}}</td>
        </tr>
        <tr>
          <td>Order Amount</td>
          <td>{{$orderDetails['coupon_amount']}}</td>
        </tr>
        <tr>
          <td>Payment Method</td>
          <td>{{$orderDetails['payment_method']}}</td>
        </tr>
         <tr>
          <td>Payment gateway</td>
          <td>{{$orderDetails['payment_gateway']}}</td>
        </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Delivery Address</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
          <td>Name</td>
          <td>{{$orderDetails['name']}}</td>
        </tr>
        <tr>
          <td>Address</td>
          <td>{{$orderDetails['address']}}</td>
        </tr>
        <tr>
          <td>City</td>
          <td>{{$orderDetails['city']}}</td>
        </tr>
        <tr>
          <td>State</td>
          <td>{{$orderDetails['state']}}</td>
        </tr>
        <tr>
          <td>Country</td>
          <td>{{$orderDetails['country']}}</td>
        </tr>
        <tr>
          <td>Pincode</td>
          <td>{{$orderDetails['pincode']}}</td>
        </tr>
        <tr>
          <td>Mobile</td>
          <td>{{$orderDetails['mobile']}}</td>
        </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customer Details</h3>

                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
          <td>Name</td>
          <td>{{$userDetails['name']}}</td>
        </tr>
        <tr>
          <td>Email</td>
          <td class="text-lowercase">{{$userDetails['email']}}</td>
        </tr>
        
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Billing Address</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
          <td>Name</td>
          <td>{{$userDetails['name']}}</td>
        </tr>
        <tr>
          <td>Address</td>
          <td>{{$userDetails['address']}}</td>
        </tr>
        <tr> 
          <td>City</td>
          <td>{{$userDetails['city']}}</td>
        </tr>
        <tr>
          <td>State</td>
          <td>{{$userDetails['state']}}</td>
        </tr>
        <tr>
          <td>Country</td>
          <td>{{$userDetails['country']}}</td>
        </tr>
        <tr>
          <td>Pincode</td>
          <td>{{$userDetails['pincode']}}</td>
        </tr>
        <tr>
          <td>Mobile</td>
          <td>{{$userDetails['mobile']}}</td>
        </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Update Order Status</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
          <td colspan="2">
            <form action="{{url('admin/update-order-status')}}" method="post">@csrf
              <input type="hidden" name="order_id" value="{{$orderDetails['id']}}">
            <select name="order_status" id="order_status" required="">
              <option value="">Select status</option>
        @foreach($orderStatus as $status)
              <option value="{{$status['name']}}" @if(isset($orderDetails['order_status']) && $orderDetails['order_status']==$status['name']) selected="" @endif>{{$status['name']}}</option>
        @endforeach
            </select> &nbsp; &nbsp;
            <input style="width: 120px;" type="text" name="courier_name" @if(empty($orderDetails['courier_name'])) id="courier_name" @endif placeholder="courier name"  value="{{$orderDetails['courier_name']}}">
            <input style="width: 120px;" type="text" name="tracking_number" @if(empty($orderDetails['tracking_number'])) id="tracking_number" @endif placeholder="tracking number" value="{{$orderDetails['tracking_number']}}">
            <button type="submit">Update</button>
          </form>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            @foreach($orderLog as $log)
            <strong>{{$log['order_status']}}</strong><br>
            {{date('F j, Y, g:i a', strtotime($log['created_at']))}}
            <hr>
            @endforeach
          </td>
        </tr>
         
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users products</h3>

                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Product Image</th>
                      <th>Product Code</th>
                      <th>Product Name</th>
                      <th>Product Size</th>
                      <th>Product Color</th>
                      <th>Product Qty</th>
                    </tr>
                  </thead>
                  <tbody>
  @foreach($orderDetails['orders_products'] as $product)
              <tr>
            <td><?php $getProductImage =  Product::getProductImage($product['product_id'])?>
              <a target="_blank" href="{{url('product_details/'.$product['product_id'])}}"><img style="width: 60px;" src="{{asset('e-com images/product images/small_img/'.$getProductImage)}}" alt="pro_img"></a>
            </td>
          <td>{{$product['product_code']}}</td>
          <td>{{$product['product_name']}}</td>
          <td>{{$product['product_size']}}</td> 
          <td>{{$product['product_color']}}</td>
          <td>{{$product['product_qty']}}</td>
                    </tr>
  @endforeach 
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->
@endsection 