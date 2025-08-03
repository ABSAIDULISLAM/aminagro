@extends('layouts.layout')
@section('title', __('animal_type.title'))
@section('content')
<section class="content-header">
  <h1><i class="icon-list"></i> {{__('animal_type.title') }}</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
    <li class="active">{{__('animal_type.title') }}</li>
  </ol>
</section>
<section class="content"> @include('common.message')
  <div class="box box-success">
    <div class="modal-content">
      <!--<div class="modal-header">-->
      <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
      <!--  <h4 class="modal-title"><i class="fa fa-plus-square color-green"></i> {{__('animal_type.add_new_type') }}</h4>-->
      <!--</div>-->
      {!! Form::open(array('route' => ['animal-type.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
      <div class="modal-body">
        <div class="form-group">
          <div class="col-md-12">
            <label for="type_name">{{__('animal_type.name') }} <span class="validate">*</span> : </label>
            <input type="text" class="form-control" value="" name="type_name" placeholder="{{__('animal_type.name') }}" required>
          </div>
        </div>
      </div>
      <div class="modal-footer" align="right">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{__('same.close') }}</button>
        {{Form::submit(__('same.save'),array('class'=>'btn btn-success btn-sm'))}} </div>
      {!! Form::close() !!} </div>
    <div class="box-footer"> </div>
  </div>
</section>
<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-plus-square color-green"></i> {{__('animal_type.add_new_type') }}</h4>
      </div>
      {!! Form::open(array('route' => ['animal-type.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
      <div class="modal-body">
        <div class="form-group">
          <div class="col-md-12">
            <label for="type_name">{{__('animal_type.name') }} <span class="validate">*</span> : </label>
            <input type="text" class="form-control" value="" name="type_name" placeholder="{{__('animal_type.name') }}" required>
          </div>
        </div>
      </div>
      <div class="modal-footer" align="right">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{__('same.close') }}</button>
        {{Form::submit(__('same.save'),array('class'=>'btn btn-success btn-sm'))}} </div>
      {!! Form::close() !!} </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection 