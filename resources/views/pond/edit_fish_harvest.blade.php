@extends('layouts.layout')
@section('title', __('মাছ ছাড়ার রেকর্ড যুক্ত করুন'))
@section('content') 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<section class="content-header">
  <h1><i class="icon-list"></i> {{__('মাছ ছাড়ার রেকর্ড যুক্ত করুন') }}</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
    <li class="active">{{__('মাছ ছাড়ার রেকর্ড যুক্ত করুন') }}</li>
  </ol>
</section>
<section class="content">
  @include('common.message')
  <div class="box box-success">
<div style="padding: 50px;">
    <form action="{{ route('fish_harvest.update', $FishHarvest->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="pond">Pond</label>
            <select name="pond" id="pond" class="form-control">
                @foreach($ponds as $pond)
                    <option value="{{ $pond->id }}" {{ $FishHarvest->pond == $pond->id ? 'selected' : '' }}>
                        {{ $pond->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fish_name">Fish Name</label>
            <input type="text" name="name" id="fish_name" class="form-control" value="{{ $FishHarvest->name }}" required>
        </div>
        <div class="form-group">
            <label for="qty">Fish Quantity</label>
            <input type="number" name="qty" id="qty" class="form-control" value="{{ $FishHarvest->qty }}" required>
        </div>
        <!--<div class="form-group">-->
        <!--    <label for="price">Price</label>-->
        <!--    <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ $FishHarvest->price }}" required>-->
        <!--</div>-->
        <!--<div class="form-group">-->
        <!--    <label for="due_price">Due Price</label>-->
        <!--    <input type="number" step="0.01" name="due_price" id="due_price" class="form-control" value="{{ $FishHarvest->due_price }}" required>-->
        <!--</div>-->
        <!--<div class="form-group">-->
        <!--    <label for="pay_amount">Pay Amount</label>-->
        <!--    <input type="number" step="0.01" name="pay_amount" id="pay_amount" class="form-control" value="{{ $FishHarvest->pay_amount }}" required>-->
        <!--</div>-->
        <div class="form-group">
            <label for="total_price">Total Price</label>
            <input type="number" step="0.01" name="total_price" id="total_price" class="form-control" value="{{ $FishHarvest->total_price }}" required>
        </div>
        <div class="form-group">
            <label for="date">Stocking Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $FishHarvest->date }}" required style="width: 25%;">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
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