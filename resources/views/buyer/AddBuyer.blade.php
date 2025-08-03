@extends('layouts.layout')
@section('title', __('Add Buyer'))
@section('content') 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<section class="content-header">
  <h1><i class="icon-list"></i> {{__('Add Buyer') }}</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
    <li class="active">{{__('Add Buyer') }}</li>
  </ol>
</section>
<section class="content">
  @include('common.message')
  <div class="box box-success">
<div style="padding: 50px;">
<form action="{{ route('buyersave') }}" method="POST">
    @csrf

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Name*</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Name" name="name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Phone*</label>
      <input type="text" class="form-control" id="inputPassword4" placeholder="Phone" name="phone">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Address*</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Address" name="address">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Balance*</label>
      <input type="text" class="form-control" id="inputPassword4" placeholder="Balance" name="balance">
    </div>
  </div>
  <button type="submit" class="btn btn-primary" style="margin-left: 20px;">Save</button>
</form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif
</div>
    <div class="box-footer"> </div>

  </div>
</section>

<!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="fa fa-plus-square color-green"></i> {{__('food_item.add_new_unit') }}</h4>
        </div>
          {!! Form::open(array('route' => ['food-item.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
        <div class="modal-body">
          <div class="form-group">
              <div class="col-md-12">
                <label for="name">{{__('food_item.name') }} <span class="validate">*</span> : </label>
                <input type="text" class="form-control" value="" name="name" placeholder="{{__('food_item.name') }}" required>
              </div>
          </div> 
        </div>
        <div class="modal-footer" align="right">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{__('same.close') }}</button>
            {{Form::submit(__('same.update'),array('class'=>'btn btn-success btn-sm'))}}
        </div>
          {!! Form::close() !!}
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
<!-- /.modal -->

@endsection 