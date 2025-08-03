@extends('layouts.layout')
@section('title', __('Collect Milk'))
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="icon-list"></i> {{__('Collect Milk') }}</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
    <li class="active">{{__('Collect Milk') }}</li>
  </ol>
</section>
<?php
use App\Models\Animal;
?>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  @include('common.message')
  <div class="box box-success">
    <div class="box-body">
      <div class="form-group">
        <div class="clearfix"></div>
      </div>
  <!-- Modal -->
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-plus-square color-green"></i> {{__('collect_milk.collect_milk') }}</h4>
        </div>
        {!! Form::open(array('route' =>['collect-milk.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <!--<div class="col-md-6">-->
                <!--  <label for="account_number">-->
                <!--  {{__('collect_milk.account_no') }}-->
                <!--  <label class="fa fa-question-circle tooltip-color" data-toggle="tooltip" title="Maintain daily same custom account number to store milk that account. Example: 25122020 (dmy)"></label>-->
                <!--  <span class="validate">*</span> :-->
                <!--  </label>-->
                <!--  <input type="text" name="account_number" class="form-control" required>-->
                <!--</div>-->
                <div class="col-md-6">
                  <label for="name">{{__('collect_milk.collected_from_name') }}
                  <!--<span class="validate">*</span> :-->
                  </label>
                  <input type="text" name="name" class="form-control"  >
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label for="address">{{__('collect_milk.address') }} : </label>
                  <textarea name="address" class="form-control"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6">
                  <label for="stall_no">{{__('collect_milk.stall_number') }} <span class="validate">*</span> : </label>
                  <select class="form-control load-animal-milk-collect-page" name="stall_no" data-url="{{URL::to('get-animal-details')}}" data-select="dairy_number" required>
                    <option value="">{{__('same.select') }}</option>
					@foreach($all_sheds as $sheds)
                    	<option value="{{$sheds->id}}">{{$sheds->shed_number}}</option>
					@endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="dairy_number">{{__('collect_milk.animal_id') }}
                  <!--<span class="validate">*</span> : -->
                  </label>
                  <select class="form-control" id="dairy_number" name="dairy_number">
                    <option value="">{{__('same.select') }}</option>
                  </select>
                </div>

<script>
$(document).ready(function() {
  // Store the original select container for reference
  const selectContainer = $('#dairy_number').closest('div');
  
  // Create a container for the dynamic inputs that will appear
  const dynamicInputsContainer = $('<div class="selected-items-container mt-2"></div>');
  selectContainer.after(dynamicInputsContainer);
  
  // Handle select change event
  $('#dairy_number').on('change', function() {
    const selectedValue = $(this).val();
    const selectedText = $(this).find('option:selected').text();
    
    if (selectedValue) {
      // Generate a unique ID for this selection
      const uniqueId = 'item-' + Date.now();
      
      // Create a new row for this selection
      const newItemRow = $(`
        <div class="input-group mb-2" id="${uniqueId}" style="margin: 15px;">
          <input type="text" class="form-control" value="${selectedText}" readonly>
          <input type="text" class="form-control" name="user_input[${selectedValue}]" placeholder="Liter">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary cancel-btn" type="button" data-id="${uniqueId}">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <input type="hidden" name="liter[]" value="${selectedValue}" required>
        </div>
      `);
      
      // Add the new row to the container
      dynamicInputsContainer.append(newItemRow);
      
      // Reset the select to its default value
      $(this).val('');
    }
  });
  
  // Handle cancel button click using event delegation
  $(document).on('click', '.cancel-btn', function() {
    // Get the ID of the row to remove
    const rowId = $(this).data('id');
    
    // Remove the specific row
    $('#' + rowId).remove();
  });
});
</script>


              </div>
              <div class="form-group">
                <!--<div class="col-md-6">-->
                <!--  <label for="liter">{{__('collect_milk.liter') }} <span class="validate">*</span> : </label>-->
                <!--  <input type="text" name="liter" id="liter_0" onkeyup="calculate(0)" class="form-control decimal" required >-->
                <!--</div>-->
                <div class="col-md-12">
                  <label for="fate">{{__('collect_milk.fate') }} (%) : </label>
                  <input type="text" name="fate" class="form-control decimal" >
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label for="liter_price">{{__('collect_milk.price_liter') }} <span class="validate">*</span> : </label>
                  <input type="text" name="liter_price" id="liter_price_0" onkeyup="calculate(0)" class="form-control decimal" required >
                </div>
              </div>
              <!--<div class="form-group">-->
              <!--  <div class="col-md-12">-->
              <!--    <label for="total">{{__('collect_milk.total') }} : </label>-->
              <!--    <input type="text" name="total" id="total_0" class="form-control" readonly>-->
              <!--  </div>-->
              <!--</div>-->
              <div class="form-group">
                <div class="col-md-12" align="right">
                  <button type="button" class="btn btn-default  btn-sm" data-dismiss="modal"> {{__('same.close') }} </button>
                  <button type="submit" name="save" class="btn btn-success btn-sm"> {{__('same.save') }} </button>
				 </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer"> </div>
      {!! Form::close() !!} </div>
    <!-- /.modal-content -->

    </div>
    <!-- /.box-body -->
    <div class="box-footer"> </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

  <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</section>
<!-- /.content -->
@endsection 