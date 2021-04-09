@extends('layouts.e-com admin layout.admin_layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper text-capitalize">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">coupons</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
     <x-e-com_alert/>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">coupons</h3>
               <a href="/admin/add_edit_coupon" class="btn btn-success btn-sm float-right" 
                        type="submit"><i class="fas fa-add"> add coupons
                     </i>  
                </a> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="coupons" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>code</th>
                  <th>coupon type</th>
                  <th>Amount</th>
                  <th>expiry date</th>
                  <th>status</th>
                  <th>actions</th>
                </tr>
                </thead> 
                <tbody>
@foreach($coupons as $coupon)
                <tr>
                  <td>{{$coupon['id']}}</td>
                  <td>{{$coupon['coupon_code']}}</td>
                  <td>{{$coupon['coupon_type']}}</td>
                  <td>{{$coupon['amount']}}
                  @if($coupon['amount_type']=="percentage")
                  %
                  @else
                   INR
                  @endif
                 </td>
                  <td>{{$coupon['expiry_data']}}</td>
                  <td>
                    @if($coupon['status']==1)
                        <a class="updatecouponstatus" id="coupon-{{$coupon['id']}}" coupon_id="{{$coupon['id']}}" href="javescript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                    @else
                       <a class="updatecouponstatus" id="coupon-{{$coupon['id']}}" coupon_id="{{$coupon['id']}}" href="javescript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                    @endif
                  </td> 
                <td>
               <a title="edit coupon" href="{{url('/admin/add_edit_coupon/'.$coupon['id'])}}"><i class="fas fa-edit"></i></a>
                  &nbsp;&nbsp;
                  <a title="delete coupon" href="javascript:void(0)" class="confirmDelete" name="coupon" record="delete_coupon" recordid="{{$coupon['id']}}"><i class="fas fa-trash"></i></a>
                </td>
                </tr>
@endforeach
                </tbody>
                
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