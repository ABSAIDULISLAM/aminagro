@extends('layouts.layout')
@section('title', __('Dead Animal'))
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa-solid fa-cow"></i> {{__('Dead Animal') }}</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
	<li class="active">{{__('Dead Animal') }}</li>
  </ol>
</section>
<section class="content">
  <!-- Default box -->
  @include('common.message')
  @include('common.commonFunction')
  <div class="box box-success"> @if(empty($single_data))
    <!--{{ Form::open(['route' => 'addFoodsave', 'method' => 'get', 'files' => true]) }}-->
    <?php $btn_name = __('same.save'); ?>
    @else
    {{  Form::open(array('route' => ['cow-feed.update',$single_data->id], 'method' => 'PUT', 'files' => true))  }}
    <?php $btn_name = __('same.update'); ?>
    @endif
    <!--<div class="box-header with-border" align="right">-->
    <!--  <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-floppy-o"></i> <b>{{$btn_name}} {{__('same.information') }}</b></button>-->
    <!--  <a href="{{  url('cow-feed/create')  }}" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> <b> {{__('same.refresh') }}</b></a> &nbsp;&nbsp; </div>-->
    <div class="box-body">
<!--      <div class="col-md-8 col-md-offset-2" style="margin-left:0px; width: 100%;">-->
<!--        <div class="panel panel-default">-->
<!--          <div class="panel-heading feed-heading feed-heading"><i class="fa fa-info-circle"></i>&nbsp;{{__('Search By Date') }} :</div>-->
<!--          <div class="panel-body">-->
<!--            <div class="row">-->
<!--              <div class="col-md-12">-->
      <!--          <div class="col-md-4">-->
      <!--            <div class="form-group">-->
      <!--              <label for="shed_no">{{__('cow_feed.stall_no') }} <span class="validate">*</span> : </label>-->

      <!--            </div>-->
      <!--          </div>-->
<!--<form action="{{ route('CowFeedReportSearch') }}" method="POST">-->
<!--    @csrf-->
<!--    <div class="col-md-6">-->
<!--        <div class="form-group">-->
<!--            <label for="date">{{ __('cow_feed.date') }} <span class="validate">*</span> : </label>-->
<!--            <input type="date" name="fdate" class="form-control wsit_datepicker" value="{{ !empty($single_data->date) ? date('Y-m-d', strtotime($single_data->date)) : '' }}" required>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-6">-->
<!--        <div class="form-group">-->
<!--            <label for="date">{{ __('cow_feed.date') }} <span class="validate">*</span> : </label>-->
<!--            <input type="date" name="tdate" class="form-control wsit_datepicker" value="{{ !empty($single_data->date) ? date('Y-m-d', strtotime($single_data->date)) : '' }}" required>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-4">-->
<!--        <div class="form-group">-->
<!--            <input type="submit" class="btn" value="Filter"/>-->
<!--        </div>-->
<!--    </div>-->
<!--</form>-->

<!--                @if ($errors->any())-->
<!--                <div class="alert alert-danger">-->
<!--                <ul>-->
<!--                @foreach ($errors->all() as $error)-->
<!--                <li>{{ $error }}</li>-->
<!--                @endforeach-->
<!--                </ul>-->
<!--                </div>-->
<!--                @endif-->
                <!--<div class="col-md-12">-->
                <!--  <div class="form-group">-->
                <!--    <label for="note">{{__('cow_feed.note') }} : </label>-->
                <!--    <textarea name="note" class="form-control">{{(!empty($single_data->note))?$single_data->note:''}}</textarea>-->
                <!--  </div>-->
                <!--</div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    
    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <!-- DataTables Initialization -->
    <script>
    $(document).ready(function () {
    $('#cowFoodTable').DataTable({
    "paging": true,        // Enable pagination
    "lengthChange": false, // Show entries dropdown
    "searching": true,     // Enable search box
    "ordering": true,      // Enable sorting
    "info": true,          // Show info
    "autoWidth": false     // Adjust column width
    });
    });
    </script>

<table id="cowFoodTable" class="table table-bordered">
<a href="{{URL::to('add-dead-cow')}}" class="btn btn-success btn-sm" data-toggle="modal"> <i class="fa fa-plus-square"></i> <b>Add New</b> </a> &nbsp;
<button onclick="window.print()" class="btn btn-primary">Print <i class="fa-solid fa-print"></i> </button>
  <thead>
    <tr>
      <th>#</th>
      <th>Cow</th>
      <th>Description</th>
      <th>Price</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach($DeadAnimal as $index => $DeadAnimals)
    <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $DeadAnimals->cow }}</td>
      <td>{{ $DeadAnimals->description }}</td>
      <td>{{ $DeadAnimals->price }}</td>
      <td>{{ $DeadAnimals->date }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<style>
    @media print {
  body {
    visibility: hidden;
  }
  #cowFoodTable {
    visibility: visible;
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>
    </div>
    {!! Form::close() !!} </div>
</section>
@endsection 