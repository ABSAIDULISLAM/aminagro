@extends('layouts.layout')
@section('title', __('Medicine'))
@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <section class="content-header">
        <h1><i class="icon-list"></i> {{ __('Medicine') }}</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {{ __('same.home') }}</a></li>
            <li class="active">{{ __('Medicine') }}</li>
        </ol>
    </section>
    <section class="content">
        @include('common.message')
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
        <div class="box box-success">
            <div style="padding: 50px;">
                <form
                    action="{{ isset($purchase) ? route('medicine_purchases.update', $purchase->id) : route('medicine_purchases.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($purchase))
                        @method('PUT')
                    @endif

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="type">Type*</label>
                            <select class="form-control" id="type" name="type">
                                <option value="14" @if (isset($purchase) && $purchase->purpose_id == 14) selected @endif>Medicine Cost
                                </option>
                                <option value="13" @if (isset($purchase) && $purchase->purpose_id == 13) selected @endif>Vaccine Cost
                                </option>
                            </select>
                        </div>

                        <!-- ✅ Corrected: Medicine Div -->
                        <div class="form-group col-md-12" id="medicineDiv"
                            style="{{ isset($purchase) && $purchase->type == 13 ? 'display: none;' : '' }}">
                            <label for="medicine">Medicines*</label>
                            <select class="form-control" id="medicine" name="medicine">
                                @foreach ($medicines as $medicine)
                                    <option value="{{ $medicine->id }}" @if (isset($purchase) && $purchase->medicine == $medicine->id) selected @endif>
                                        {{ $medicine->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ✅ Corrected: Vaccine Div -->
                        <div class="form-group col-md-12" id="vaccineDiv"
                            style="{{ isset($purchase) && $purchase->type == 14 ? 'display: none;' : '' }}">
                            <label for="vaccine">Vaccine*</label>
                            <select class="form-control" id="vaccine" name="vaccine">
                                @foreach ($vaccines as $vaccine)
                                    <option value="{{ $vaccine->id }}" @if (isset($purchase) && $purchase->medicine == $vaccine->id) selected @endif>
                                        {{ $vaccine->vaccine_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const typeSelect = document.getElementById('type');
                                const medicineDiv = document.getElementById('medicineDiv');
                                const vaccineDiv = document.getElementById('vaccineDiv');

                                function toggleFields() {
                                    const selectedType = typeSelect.value;
                                    medicineDiv.style.display = selectedType === '14' ? 'block' : 'none';
                                    vaccineDiv.style.display = selectedType === '13' ? 'block' : 'none';
                                }
                                toggleFields(); // Initial
                                typeSelect.addEventListener('change', toggleFields); // On change
                            });
                        </script>

                        <div class="form-group col-md-6">
                            <label for="suppliers">Supplier*</label>
                            <select class="form-control" id="suppliers" name="suppliers" required>
                                <option value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" @if (isset($purchase) && $purchase->suppliers == $supplier->id) selected @endif>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="form-group col-md-6">
                            <label for="medicine">Medicine*</label>
                            <select class="form-control" id="medicine" name="medicine" required>
                                <option value="">Select Medicine</option>
                                @foreach ($medicines as $medicine)
                                    <option value="{{ $medicine->id }}">
                                        {{ $medicine->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Unit*</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="unit">
                                @foreach ($foodUnit as $foodUnits)
                                <option value="{{ $foodUnits->name }}" @if (isset($purchase) && $purchase->unit == $foodUnits->name) selected
                                @endif>{{ $foodUnits->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="price">Price*</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price"
                                value="{{ isset($purchase) ? $purchase->price : old('price') }}" required min="0">
                        </div>


                        <div class="form-group col-md-4">
                            <label for="quantity">Quantity*</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                value="{{ isset($purchase) ? $purchase->quantity : old('quantity') }}" required
                                min="1">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date">Purchase Date*</label>
                            <input type="date" class="form-control" id="date" name="date"
                                value="{{ isset($purchase) ? $purchase->date : old('date') }}" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="description">{{ isset($purchase) ? $purchase->description : old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($purchase) ? 'Update' : 'Save' }}
                        </button>
                        <a href="{{ route('medicine_purchases') }}" class="btn btn-secondary">Cancel</a>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus-square color-green"></i>
                        {{ __('food_item.add_new_unit') }}</h4>
                </div>
                {!! Form::open(['route' => ['food-item.store'], 'class' => 'form-horizontal', 'method' => 'POST']) !!}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="name">{{ __('food_item.name') }} <span class="validate">*</span> : </label>
                            <input type="text" class="form-control" value="" name="name"
                                placeholder="{{ __('food_item.name') }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" align="right">
                    <button type="button" class="btn btn-default btn-sm"
                        data-dismiss="modal">{{ __('same.close') }}</button>
                    {{ Form::submit(__('same.update'), ['class' => 'btn btn-success btn-sm']) }}
                </div>
                {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection
