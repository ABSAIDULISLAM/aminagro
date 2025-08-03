@extends('layouts.layout')
@section('title', __('Animal Ledger'))
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-pie-chart"></i> {{__('Animal Ledger') }}</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
	<li class="active">{{__('Animal Ledger') }}</li>
  </ol>
</section>
<section class="content">
  <!-- Default box -->
  @include('common.message')
  @include('common.commonFunction')
  <div class="box box-success">
    <div class="box-header with-border" align="right"> <a href="{{  url('animal-statistics')  }}" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> <b> {{__('same.refresh') }}</b></a> &nbsp;&nbsp; </div>
    <div class="box-body">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading feed-heading"><i class="icon-list"></i>&nbsp;{{__('reports.animal_statistics_report') }} :</div>
          <div class="panel-body">
            <div class="row">


        <div class="col-md-12 ajax-page-bb" align="center">
        <h3><b>Animal Statistics Report</b></h3>
        </div>
        <div class="row ajax-page-pt15">
        <div class="col-md-12">
        <div class="col-md-6">       <div class="owl-carousel cm-slider owl-loaded owl-drag">
        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all; width: 612px;"><div class="owl-item active" style="width: 601.078px; margin-right: 10px;"><div class="img-thumbnail"><img src="{{asset("storage/app/public/uploads/animal")}}/{{explode("_", $all_animals->pictures)[0]}}"></div></div></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev disabled"><i class="fa fa-chevron-left"></i></button><button type="button" role="presentation" class="owl-next disabled"><i class="fa fa-chevron-right"></i></button></div><div class="owl-dots disabled"></div></div>
        </div>
        <div class="col-md-6 border paymentsttausbox">
        <table class="table table-bordered table-striped table-responsive">
        <tbody><tr>
        <td><b>Date of Birth</b></td>
            <td> @if(!empty($all_animals->DOB))
            {{date('M d, Y', strtotime($all_animals->DOB))}}
            @endif </td>
        </tr>
        <!--<tr>-->
        <!--<td><b>Animal Live Age</b></td>-->
        <!--<td>3 Days  0.10 Months</td>-->
        <!--</tr>-->
        <tr>
        <td><b>Buy Date</b></td>
            <td> @if(!empty($all_animals->buy_date))
            {{date('M d, Y', strtotime($all_animals->buy_date))}}
            @endif </td>
        </tr>
        <tr>
        <td><b>Animal Gender</b></td>
        <td>{{$all_animals->gender}}</td>
        </tr>
        <tr>
        <td><b>Animal Status</b></td>
            <td> @if($all_animals->sale_status==1)
            <label class="label label-warning lblfarm">{{__('manage_cow.sold') }}</label>
            @elseif($all_animals->sale_status==2)
            <label class="label label-danger lblfarm">{{__('Dead') }}</label>
            @else
            <label class="label label-success lblfarm">{{__('manage_cow.available') }}</label>
            @endif </td>
        </tr>
        <tr>
        <td><b>Animal Type</b></td>
        <td> @if(isset($all_animals->animal_animalType_object->type_name))
        <label class="label label-default lblfarm">{{$all_animals->animal_animalType_object->type_name}}</label>
        @endif </td>
        </tr>
        <tr>
        <td><b>Buying Price</b></td>
        <td>{{$all_animals->buying_price}}</td>
        </tr>
        <tr>
        <td><b>Sell Price</b></td>
        <td>{{ $cowSell->total_paid ?? '' }}</td>
        </tr>
        <!--<tr>-->
        <!--<td><b>Vaccine Status</b></td>-->
        <!--<td>            <label class="label label-success lblfarm">Perfect</label>-->
        <!--</td>-->
        <!--</tr>-->
        </tbody></table>
        </div>
        </div>
        </div>

        <div class="col-md-12" id="animal-details" align="center">
        <div class="row">
        <div class="col-md-12 ajax-page-bb" align="center">
        <h3><b>Daily Feed List</b></h3>
        </div>
        </div>
        </div>
        <div class="row ajax-page-pt15">
        <div class="col-md-12">
<table class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th>Item Name</th>
            <th>Item Quantity</th>
            <th>Feeding Date</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        @foreach($food as $foods)
            <tr>
                <td>{{ $foods->food_name }}</td>
                <td>{{ $foods->cow_feed_dtls_qty }} {{ $foods->cow_feed_dtls_unit }}</td>
                <td>{{ $foods->date }}</td>
                <td>
                    <div>
                        <!--<p>Food Name: {{ $foods->food_name }}</p>-->
                        <!--<p>Quantity: {{ $foods->cow_feed_dtls_qty }}</p>-->
                        <!--<p>Unit: {{ $foods->cow_feed_dtls_unit }}</p>-->
                        @if($foods->price_per_unit !== null)
                            <p>Price per Unit: {{ $foods->price_per_unit }}</p>
                            <p>Total Price: {{ $foods->total_price }}</p>
                        @else
                            <p>Price information not available.</p>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Display the total price for all records at the bottom -->
<div style="font-weight: bold; font-size: 1.2em; margin-top: 20px;">
    <p>&nbsp;Total Price for All Records: {{ number_format($totalPriceAllRecords, 2) }}</p>
</div>
        </div>
        </div>



         <div class="col-md-12" id="animal-details" align="center">
        <div class="row">
        <div class="col-md-12 ajax-page-bb" align="center">
        <h3><b>Milk Sell List</b></h3>
        </div>
        </div>
        </div>
        <div class="row ajax-page-pt15">
        <div class="col-md-12">
<table class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th>Date</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($MilkCollection as $MilkCollections)
            <tr>
                <td>{{ $MilkCollections->date }}</td>
                <td>{{ $MilkCollections->liter }}</td>
                <td>{{ $MilkCollections->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Display the total price for all records at the bottom -->
<div style="font-weight: bold; font-size: 1.2em; margin-top: 20px;">
    <p>&nbsp;Total Price for All Records: {{ number_format($totalMilkSell, 2) }}</p>
</div>
        </div>
        </div>



        <div class="col-md-12" id="animal-details" align="center">
        <div class="row">
        <div class="col-md-12 ajax-page-bb" align="center">
        <h3><b>Sale Status</b></h3>
        </div>
        </div>
        </div>
        <div class="row ajax-page-pt15">
        <div class="col-md-12">
<table class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th>Date</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
      @if($cowSell)
            <tr>
                <td>{{ $cowSell->sell_date }}</td>
                <td>{{ $cowSell->total_paid }}</td>
            </tr>
            <?php $totalSellPrice = $cowSell->total_paid; ?>
        @else
            <tr>
                <td colspan="2">No sale records found for this cow.</td>
            </tr>
            <?php $totalSellPrice = 0; ?>
        @endif
    </tbody>
</table>

<!-- Display the total price for all records at the bottom -->
<div style="font-weight: bold; font-size: 1.2em; margin-top: 20px;">
    <p>Total Price for All Records: {{ number_format($totalSellPrice, 2) }}</p>
</div>
        </div>
        </div>


        <div class="col-md-12" id="animal-details" align="center">
        <div class="row">
        <div class="col-md-12 ajax-page-bb" align="center">
        <h3><b>Profit And Loss</b></h3>
        </div>
        </div>
        </div>
<div style="font-weight: bold; font-size: 1.2em; margin-top: 20px;">
    <p>Total Price for All Records: {{ number_format($totalMilkSell + $totalSellPrice - $totalPriceAllRecords, 2) }}</p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
