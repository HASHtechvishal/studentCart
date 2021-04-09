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
              <li class="breadcrumb-item active">sections</li>
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
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">sections</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="section" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>name</th>
                  <th>status</th>
                </tr>
                </thead>
                <tbody>
 @foreach($section as $section)                 
                <tr>
                  <td>{{$section->id}}</td>
                  <td>{{$section->name}}
                  </td>
                  <td>
                    @if($section->status==1)
                        <a class="updateSectionStatus" id="section-{{$section->id}}" section_id="{{$section->id}}" href="javescript:void(0)">active</a>
                    @else
                       <a class="updateSectionStatus" id="section-{{$section->id}}" section_id="{{$section->id}}" href="javescript:void(0)">inactive</a>
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
