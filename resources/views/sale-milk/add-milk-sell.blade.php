@extends('layouts.layout')
@section('title', __('Sale Milk'))
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="icon-list"></i> {{__('Sale Milk') }}</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
    <li class="active">{{__('Sale Milk') }}</li>
  </ol>
</section>
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
          <h4 class="modal-title"><i class="fa fa-plus-square color-green"></i> {{__('Sale Milk') }}</h4>
        </div>
        {!! Form::open(array('route' =>['sale-milk.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="col-md-12">
                  <label for="milk_account_number">{{__('sale_milk.account_no') }} <span class="validate">*</span> : </label>
                  <select name="milk_account_number" id="milk_account_number_0" class="form-control milk_account_number" onchange="calculateSaleMilk(0, this)" required>
                    <option value="">{{__('same.select') }}</option>
                     @foreach($milkData as $milkDataInfo)
                    <option value="{{$milkDataInfo->account_number}}" data-stock="{{$milkDataInfo->liter}}" data-price="{{$milkDataInfo->liter_price}}"> {{$milkDataInfo->account_number}} [ Date - {{date('M d, Y', strtotime($milkDataInfo->date))}}] [Collected Milk {{$milkDataInfo->liter}} Liter] </option>
                     @endforeach
                  </select>
                </div>
              </div>
              <div class="panel panel-default" id="view-stock-info">
                <div class="panel-body">
                  <h4><u><b>{{__('sale_milk.account_information') }}</b></u></h4>
                  <div class="col-md-12 row">
                    <!--<div class="col-md-6 row" id="milk-in-stock" align="center">-->
                    <!--  <div class="available">{{__('sale_milk.available') }} : <span></span> {{__('sale_milk.liter') }}</div>-->
                    <!--</div>-->
                    <div class="col-md-6 row" id="milk-in-stock" align="center" style="color: green; font-size: 15px;">
                        <div id="response"></div>
                    </div>
                    <div class="col-md-3 row" id="stock-paid" align="center">
                      <div class="paid">{{__('sale_milk.paid') }} : <span></span></div>
                    </div>
                    <div class="col-md-3 row" id="stock-due" align="right">
                      <div class="due">{{__('sale_milk.due') }} : <span></span></div>
                    </div>
                  </div>
                  
                  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".milk_account_number").change(function () {
            var accountNumber = $(this).val(); // Get selected account number

            if (accountNumber) {
                $.ajax({
                    url: "{{ route('ajax-test') }}", // Ensure this route exists
                    type: "GET",
                    data: { account: accountNumber }, // Send account number
                    success: function (response) {
                        if (response.success) {
                            // Display the remaining quantity returned from the server
                            $("#response").html("Available: " + response.remaining_quantity + " Liters");
                        } else {
                            // Show an error message if no data is found
                            $("#response").html(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", error);
                    }
                });
            }
        });
    });
</script>


                </div>
              </div>
              <!--<div class="form-group">-->
              <!--  <div class="col-md-12">-->
              <!--    <label for="supplier_id">{{__('sale_milk.supplier') }} : </label>-->
              <!--    <select name="supplier_id" id="supplier_id_0" class="form-control" onchange="loadSupplierData(0)">-->
              <!--      <option value="">{{__('same.select') }}</option>-->
              <!--              @foreach($supplierArr as $supplierData)-->
              <!--      <option value="{{$supplierData->id}}" data-name="{{$supplierData->name}}" data-email="{{$supplierData->mail_address}}" data-phn_number="{{$supplierData->phn_number}}" data-address="{{$supplierData->present_address}}"> {{$supplierData->name}} [ Company: {{$supplierData->company_name}}] </option>-->
              <!--              @endforeach-->
              <!--    </select>-->
              <!--  </div>-->
              <!--</div>-->
              <div class="form-group">
                <div class="col-md-6">
                  <label for="name">{{__('sale_milk.name') }} <span class="validate">*</span> : </label>
                  <input type="text" name="name" id="name_0" class="form-control" required >
                </div>
                <div class="col-md-6">
                  <label for="contact">{{__('sale_milk.contact') }} : </label>
                  <input type="text" name="contact" id="contact_0" class="form-control" >
                </div>
              </div>
              <!--<div class="form-group">-->
              <!--  <div class="col-md-12">-->
              <!--    <label for="email">{{__('sale_milk.email') }} <span class="validate">*</span> : </label>-->
              <!--    <input type="text" name="email" id="email_0" class="form-control" required >-->
              <!--  </div>-->
              <!--</div>-->
              <div class="form-group">
                <div class="col-md-12">
                  <label for="address">{{__('sale_milk.address') }} : </label>
                  <textarea name="address" id="address_0" class="form-control"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6">
                  <label for="litter">{{__('sale_milk.liter') }} <span class="validate">*</span> : </label>
                  <input type="text" name="litter" id="liter_0" onkeyup="calculateSaleMilk(0)" class="form-control decimal" required >
                </div>
                <div class="col-md-6">
                  <label for="rate">{{__('sale_milk.price_litre') }} : </label>
                  <input type="text" name="rate" id="liter_price_0" onkeyup="calculateSaleMilk(0)" class="form-control" required readonly >
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6">
                  <label for="total_amount">{{__('sale_milk.total') }} : </label>
                  <input type="text" name="total_amount" id="total_0" class="form-control" required readonly>
                </div>
                <div class="col-md-6">
                  <label for="paid">{{__('sale_milk.paid') }} <span class="validate">*</span> : </label>
                  <input type="text" name="paid" id="paid_0" onkeyup="calculateSaleMilk(0)" class="form-control decimal" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label for="due">{{__('sale_milk.due') }} : </label>
                  <input type="text" name="due" id="due_0" class="form-control" readonly>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12" align="right">
                  <!--<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> {{__('same.close') }} </button>-->
                  <button type="submit" name="save" class="btn btn-success btn-sm"> {{__('same.save') }} </button>
				  <button type="submit" name="invoice" class="btn btn-warning btn-sm"> {{__('sale_milk.generate_invoice') }} </button>
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
  <input type="hidden" id="hdnStockUrl" value="{{URL::to('get-stock-status')}}" />
</section>
<!-- /.content -->
@endsection 