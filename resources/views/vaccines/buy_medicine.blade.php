@extends('layouts.layout')
@section('title', __('Medicine'))
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<section class="content-header">
    <h1><i class="icon-list"></i> {{__('Medicine / Vaccine') }}</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
        <li class="active">{{__('Medicine') }}</li>
    </ol>
</section>
<section class="content">
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
    @include('common.message')
    <div class="box box-success">
        <div style="padding: 50px;">
            <form action="{{ route('BuyMedicineSave') }}" method="POST">
                @csrf
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="type">Type*</label>
                        <select class="form-control" id="type" name="type">
                            <option value="14">Medicine Cost</option>
                            <option value="13">Vaccine Cost</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6" id="medicineDiv">
                        <label for="medicine">Medicines*</label>
                        <select class="form-control" id="medicine" name="medicine">
                            @foreach ($medicine as $medicines)
                            <option value="{{ $medicines->id }}">{{ $medicines->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6" id="vaccineDiv" style="display: none;">
                        <label for="vaccine">Vaccine*</label>
                        <select class="form-control" id="vaccine" name="vaccine">
                            @foreach ($vaccines as $vaccine)
                            <option value="{{ $vaccine->id }}">{{ $vaccine->vaccine_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const typeSelect = document.getElementById('type');
                            const medicineDiv = document.getElementById('medicineDiv');
                            const vaccineDiv = document.getElementById('vaccineDiv');

                            function toggleFields() {
                                const selectedValue = typeSelect.value;

                                if (selectedValue == '14') { // Medicine Cost
                                    medicineDiv.style.display = 'block';
                                    vaccineDiv.style.display = 'none';
                                } else if (selectedValue == '13') { // Vaccine Cost
                                    medicineDiv.style.display = 'none';
                                    vaccineDiv.style.display = 'block';
                                }
                            }

                            // Initial load
                            toggleFields();

                            // On change
                            typeSelect.addEventListener('change', toggleFields);
                        });
                    </script>



                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Suppliers*</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="suppliers">
                            @foreach ($supplier as $suppliers)
                            <option value="{{ $suppliers->id }}">{{ $suppliers->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Unit*</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="unit">
                            @foreach ($foodUnit as $foodUnits)
                            <option value="{{ $foodUnits->name }}">{{ $foodUnits->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Quantity*</label>
                        <input type="text" class="form-control" id="inputEmail4" placeholder="Quantity" name="quantity">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="price">Price*</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                            value="{{ isset($purchase) ? $purchase->price : old('price') }}" required min="0">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Date*</label>
                        <input type="date" class="form-control" id="inputEmail4" placeholder="Date" value="{{date('Y-m-d')}}" name="date" style="">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Description*</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary" style="margin-left: 20px;">Save</button>
                        <a href="{{ route('buy_medicine') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>


            </form>

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
