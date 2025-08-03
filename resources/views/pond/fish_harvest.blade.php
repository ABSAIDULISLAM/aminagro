@extends('layouts.layout')
@section('title', __('মাছ সংগ্রহ'))
@section('content') 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<section class="content-header">
  <h1><i class="icon-list"></i> {{__('মাছ সংগ্রহ') }}</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
    <li class="active">{{__('মাছ সংগ্রহ') }}</li>
  </ol>
</section>
<section class="content">
  @include('common.message')
  <div class="box box-success">
<div style="padding: 50px;">
<form action="{{ route('save_fish_harvest') }}" method="POST">
    @csrf
  <div class="form-row">
        <div class="form-group col-md-12">
        <label for="inputPassword4">পুকুর নির্বাচন করুন*</label>
        <select class="form-control" id="exampleFormControlSelect1" name="pond">
        @foreach ($pond as $ponds)
        <option value="{{ $ponds->id }}">{{ $ponds->name }}</option>
        @endforeach
        </select>
        </div>
        
        <div class="form-group col-md-12">
        <label for="exampleFormControlSelect1">মাছের নাম*</label>
        <select class="form-control select2" id="exampleFormControlSelect1" name="name">
        @foreach($fish as $fishs)
        <option value="{{ $fishs->fish_name }}">{{ $fishs->fish_name }} - {{ $fishs->id }}</option>
        @endforeach
        </select>
        </div>
        <script>
        $(document).ready(function() {
        $('.select2').select2({
        placeholder: 'Select a cow', // Placeholder text
        allowClear: true, // Allow clearing the selection
        width: '100%', // Set the width of the dropdown
        });
        });
        </script>
        
        <div class="form-group col-md-12">
        <label for="inputEmail4">মাছের পরিমাণ*</label>
        <input type="text" class="form-control" id="inputEmail4" placeholder="মাছের পরিমাণ" name="qty">
        </div>
        
        <!--<div class="form-group col-md-12">-->
        <!--<label for="inputEmail4">মাছের টাকা*</label>-->
        <!--<input type="text" class="form-control" id="inputEmail4" placeholder="মাছের টাকা" name="price">-->
        <!--</div>-->
        
        
        <div class="form-group col-md-12">
        <label for="total_price">টোটাল টাকা*</label>
        <input type="text" class="form-control" id="total_price" placeholder="টোটাল টাকা" name="total_price">
        </div>
        
        <!--<div class="form-group col-md-12">-->
        <!--<label for="pay_amount">জমা টাকা*</label>-->
        <!--<input type="text" class="form-control" id="pay_amount" placeholder="জমা টাকা" name="pay_amount">-->
        <!--</div>-->
        
        <!--<div class="form-group col-md-12">-->
        <!--<label for="due_price">বাকি টাকা*</label>-->
        <!--<input type="text" class="form-control" id="due_price" placeholder="বাকি টাকা" name="due_price" readonly>-->
        <!--</div>-->
        
        <div class="form-group col-md-12">
        <label for="inputEmail4">তারিখ*</label>
        <input type="date" class="form-control" id="inputEmail4" placeholder="তারিখ" name="date" style="width: 25%;">
        </div>
  </div>
  <button type="submit" class="btn btn-primary" style="margin-left: 20px;">Save</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Script -->
<script>
    $(document).ready(function() {
        // Listen for input changes in the pay_amount field
        $('#pay_amount').on('input', function() {
            // Get the values of total_price and pay_amount
            let totalPrice = parseFloat($('#total_price').val()) || 0; // Default to 0 if empty
            let payAmount = parseFloat($(this).val()) || 0; // Default to 0 if empty

            // Calculate due_price
            let duePrice = totalPrice - payAmount;

            // Update the due_price field
            $('#due_price').val(duePrice.toFixed(2)); // Format to 2 decimal places
        });

        // Optional: Listen for changes in the total_price field as well
        $('#total_price').on('input', function() {
            let totalPrice = parseFloat($(this).val()) || 0;
            let payAmount = parseFloat($('#pay_amount').val()) || 0;
            let duePrice = totalPrice - payAmount;
            $('#due_price').val(duePrice.toFixed(2));
        });
    });
</script>

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