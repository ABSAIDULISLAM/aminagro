@extends('layouts.layout')
@section('title', __('food_item.title'))
@section('content') 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<section class="content-header">
  <h1><i class="icon-list"></i> {{__('Buy Food') }}</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
    <li class="active">{{__('food_item.title') }}</li>
  </ol>
</section>
<section class="content">
  @include('common.message')
  <div class="box box-success">
<div style="padding: 50px;">
<form action="{{ route('addFoodsave') }}" method="POST">
    @csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Supplier*</label>
      <select class="form-control" id="exampleFormControlSelect1" name="supplier">
          @foreach ($supplier as $suppliers)
      <option value="{{ $suppliers->name }}">{{ $suppliers->name }}</option>
          @endforeach
    </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Food*</label>
      <select class="form-control" id="exampleFormControlSelect1" name="food">
          @foreach ($foodItem as $foodItems)
      <option value="{{ $foodItems->id }}">{{ $foodItems->name }}</option>
          @endforeach
    </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Quantity*</label>
  <input type="text" class="form-control" id="inputEmail4" placeholder="Quantity" name="quantity">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Unit*</label>
      <select class="form-control" id="exampleFormControlSelect1" name="unit">
          @foreach ($foodUnit as $foodUnits)
      <option value="{{ $foodUnits->name }}">{{ $foodUnits->name }}</option>
           @endforeach
    </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Price*</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Price" name="price">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Date*</label>
      <input type="date" class="form-control" id="inputPassword4" placeholder="Date" name="date" style="width: 40%;">
    </div>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1" style="margin-left: 20px;">Description*</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"name="description" style="width: 98%; margin-left: 20px;"></textarea>
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