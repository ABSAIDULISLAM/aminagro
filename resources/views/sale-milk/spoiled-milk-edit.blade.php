@extends('layouts.layout')
@section('title', __('Spoiled Milk'))
@section('content') 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<section class="content-header">
  <h1><i class="icon-list"></i> {{__('Spoiled Milk') }}</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
    <li class="active">{{__('Spoiled Milk') }}</li>
  </ol>
</section>
<section class="content">
  @include('common.message')
  <div class="box box-success">
<div style="padding: 50px;">
<form action="{{ route('spoiled_milk.update', $spoiledMilk->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="form-group col-md-12">
            <label for="quantity">Quantity*</label>
            <input type="text" class="form-control" id="quantity" placeholder="Quantity" 
                   name="quantity" value="{{ old('quantity', $spoiledMilk->quantity) }}" required>
            @error('quantity')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <!--<div class="form-group col-md-12">-->
        <!--    <label for="account">Account No*</label>-->
        <!--    <select class="form-control select2" id="account" name="account" required>-->
        <!--        <option value="">Select Account</option>-->
        <!--        @foreach($CollectMilk as $CollectMilks)-->
        <!--            <option value="{{ $CollectMilks->account_number }}" -->
        <!--                {{ old('account', $spoiledMilk->account) == $CollectMilks->account_number ? 'selected' : '' }}>-->
        <!--                {{ $CollectMilks->account_number }}-->
        <!--            </option>-->
        <!--        @endforeach-->
        <!--    </select>-->
        <!--    @error('account')-->
        <!--        <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->
        
        <div class="form-group col-md-12">
            <label for="date">Date*</label>
            <input type="date" class="form-control" id="date" name="date" 
                   value="{{ old('date', $spoiledMilk->date) }}" required>
            @error('date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group col-md-12">
            <label for="price">Price*</label>
            <input type="text" class="form-control" id="price" placeholder="Price" 
                   name="price" value="{{ old('price', $spoiledMilk->price) }}" required>
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group col-md-12">
            <label for="description">Description*</label>
            <textarea class="form-control" id="description" rows="3" 
                      name="description" required>{{ old('description', $spoiledMilk->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="{{ route('spoiled_milk_list') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select an account',
            allowClear: true,
            width: '100%',
        });
        
        // Initialize datepicker if needed
        $('#date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
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