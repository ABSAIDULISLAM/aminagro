@extends('layouts.layout')
@section('title', __('branch.title'))
@section('content')
<section class="content-header">
  <h1><i class="icon-list"></i> {{__('Add Branch') }}</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
    <li class="active">{{__('Add Branch') }}</li>
  </ol>
</section>
<section class="content"> @include('common.message')
  <div class="box box-success">
  <div class="modal-dialog modal-lg">
    <div class="modal-content branch-content-width">
      <div class="modal-header">
        <h4 class="modal-title">
          <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
          <i class="fa fa-plus-square branch-pencil"></i> <strong> {{__('branch.add_new_branch') }}</strong> </h4>
      </div>
      {!! Form::open(array('route' => ['branch.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
      <div class="modal-body">
        <div class="form-group">
          <div class="col-md-12">
            <label for="branch_name">{{__('branch.branch_name') }} <span class="validate">*</span> : </label>
            <input type="text" class="form-control" id="branch_name" value="" name="branch_name" placeholder="{{__('branch.branch_name') }}" required>
          </div>
        </div>
        <!--<div class="form-group">-->
        <!--  <div class="col-md-12">-->
        <!--    <label for="builders_name">{{__('branch.builder_name') }} <span class="validate">*</span> : </label>-->
        <!--    <input type="text" class="form-control" id="builders_name" value="" name="builders_name" placeholder="{{__('branch.builder_name') }}" required>-->
        <!--  </div>-->
        <!--</div>-->
        <!--<div class="form-group">-->
        <!--  <div class="col-md-12">-->
        <!--    <label for="phone_number">{{__('branch.phone_no') }} <span class="validate">*</span> : </label>-->
        <!--    <input type="text" class="form-control" id="phone_number" value="" name="phone_number" placeholder="{{__('branch.phone_no') }}" required>-->
        <!--  </div>-->
        <!--</div>-->
        <div class="form-group">
          <div class="col-md-12">
            <label for="email">{{__('branch.email') }} <span class="validate">*</span> : </label>
            <input type="text" class="form-control" id="email" value="" name="email" placeholder="{{__('branch.email') }}" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <label for="branch_address">{{__('branch.address') }} <span class="validate">*</span> : </label>
            <textarea class="form-control" id="branch_address" name="branch_address" required></textarea>
          </div>
        </div>
        <!--<div class="form-group">-->
        <!--  <div class="col-md-12">-->
        <!--    <label for="setup_date">{{__('branch.setup_date') }} <span class="validate">*</span> : </label>-->
        <!--    <input type="text" class="form-control wsit_datepicker" value="" name="setup_date" placeholder="{{__('branch.setup_date') }}" required>-->
        <!--  </div>-->
        <!--</div>-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{__('same.close') }}</button>
        {{Form::submit(__('same.save'),array('class'=>'btn btn-success btn-sm'))}} </div>
      {!! Form::close() !!} </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->

  </div>
</section>
<!-- Modal -->

<!-- /.modal -->
@endsection 