@extends('layouts.layout')
@section('title', __('স্থায়ী খরচ'))
@section('content') 
<section class="content-header">
  <h1><i class="icon-list"></i> {{__('স্থায়ী খরচ') }}</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
    <li class="active">{{__('স্থায়ী খরচ') }}</li>
  </ol>
</section>
<section class="content">
  @include('common.message')
  <div class="box box-success">
<div style="padding: 50px;">
<form action="{{ route('save-permanent-expense') }}" method="POST">
    @csrf


    <div class="form-group col-md-12">
      <label for="inputEmail4">তারিখ*</label>
      <input type="date" class="form-control" id="inputEmail4" placeholder="তারিখ" name="date" style="width: 25%;">
    </div>
        <div class="form-group col-md-12">
      <label for="inputEmail4">নাম*</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="নাম" name="name">
    </div>
    <div class="form-group col-md-12">
    <label for="exampleFormControlTextarea1">বিবরণ</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"name="description"></textarea>
    </div>
    
    <div class="form-group col-md-12">
      <label for="inputPassword4">ধরণ</label>
      <select class="form-control" id="exampleFormControlSelect1" name="status">
                <option value="0">জমা</option>
                 <option value="1">খরচ</option>
               </select>
    </div>
    
        <div class="form-group col-md-12">
      <label for="inputEmail4">মূল্য*</label>
      <input type="number" class="form-control" id="inputEmail4" placeholder="মূল্য" name="price">
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