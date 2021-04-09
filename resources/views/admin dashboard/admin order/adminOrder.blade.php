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
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content"> 
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <x-e-com_alert/>

          
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Orders</h3>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="orders" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>order ID</th>
                 <th>order date</th>
                 <th>Customer name</th>
                 <th>customer email</th>
                 <th>ordered products</th>
                 <th>order amount</th>
                 <th>order status</th>
                 <th>payment method</th>
                 <th>actions</th>
                </tr>
                </thead>
                <tbody>
 @foreach($orders as $order)                  
                <tr>
                  <td>{{$order['id']}}</td>   
                 <td>{{date('d-m-Y',strtotime($order['created_at']))}}</td> 
                 <td>{{$order['name']}}</td>
                  <td class="text-lowercase">{{$order['email']}}</td>
                   <td>
                     @foreach($order['orders_products'] as $product)
                    {{$product['product_code']}} ({{$product['product_qty']}})<br>
                     @endforeach
                  </td>
                  <td>{{$order['grand_total']}}</td>
                  <td>{{$order['order_status']}}</td> 
                  <td>{{$order['payment_method']}}</td> 
                <td style="width: 120px;">
                <a title="view order details" href="{{url('admin/orders/'.$order['id'])}}"><i class="fas fa-file"></i></a>&nbsp; &nbsp;
                @if($order['order_status']=="Shipped" || $order['order_status']=="Delivered")
                <a title="view order invoice" href="{{url('admin/view-order-invoice/'.$order['id'])}}" target="_blank"><i class="fas fa-print"></i></a>
                @endif
                </td>
              
               </tr>
               
 @endforeach               
                </tbody>
                <tfoot>
              
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection 