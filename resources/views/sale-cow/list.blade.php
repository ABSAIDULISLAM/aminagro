@extends('layouts.layout')
@section('title', __('cow_sale.title'))
@section('content')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery (required by DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<section class="content-header">
  <h1><i class="icon-list"></i> {{__('cow_sale.title') }}</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
    <li class="active">{{__('cow_sale.title') }}</li>
  </ol>
</section>
<section class="content"> @include('common.message')
  <div class="box box-success">
    <div class="box-header with-border" align="right"> <a href="{{  url('sale-cow/create')  }}" class="btn btn-success btn-sm" data-toggle="modal"> <i class="fa fa-plus-square"></i> <b>{{__('same.add_new') }}</b> </a> <a href="{{URL::to('sale-cow')}}" class="btn btn-warning btn-sm"> <i class="fa fa-refresh"></i> <b>{{__('same.refresh') }}</b> </a> </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
            <form method="GET" action="{{ route('sale-cow.index') }}" class="form-inline mb-3">
            <div class="form-group mr-2">
            <label for="start_date" class="mr-2">Start Date:</label>
            <input type="date" class="form-control" id="start_date" name="start_date"
            value="{{ $start_date ?? '' }}">
            </div>
            <div class="form-group mr-2">
            <label for="end_date" class="mr-2">End Date:</label>
            <input type="date" class="form-control" id="end_date" name="end_date"
            value="{{ $end_date ?? '' }}">
            </div>
            <button type="submit" class="btn btn-primary mr-2">
            <i class="fa fa-filter"></i> Filter
            </button>
            <a href="{{ route('sale-cow.index') }}" class="btn btn-default">
            <i class="fa fa-refresh"></i> Reset
            </a>
            </form>
          <div class="form-group">
            <div class="table-responsive">
             <table id="cowSalesTable" class="table table-bordered table-striped table-responsive">
                <thead>
                  <tr>
                    <th>#{{__('same.invoice') }}</th>
                    <th>#{{__('Animal ID') }}</th>
                    <th>{{__('cow_sale.date') }}</th>
                    <th>{{__('cow_sale.customer_name') }}</th>
                    <th>{{__('cow_sale.customer_phone') }} </th>
                    <th>{{__('cow_sale.customer_email') }} </th>
                    <th>{{__('cow_sale.address') }} </th>
                    <th>{{__('cow_sale.total_price') }}</th>
                    <th>{{__('cow_sale.total_paid') }}</th>
                    <th>{{__('cow_sale.due') }}</th>
                    <th>{{__('cow_sale.note') }}</th>
                    <th>{{__('same.action') }}</th>
                  </tr>
                </thead>
                <tbody>

                @foreach($allData as $saleinfo)
                <?php
				  	$total_paid = $saleinfo->collectPayments()->sum('pay_amount');
			 		$total_due = (float)$saleinfo->total_price - (float)$total_paid;
				  ?>
				   <?php  $cowInfo = DB::table('cow_sale_dtls')->where('sale_id', $saleinfo->id)->get(); ?>
                <tr>
                  <td><label class="label label-default lblfarm">000{{$saleinfo->id}}</label></td>
<td>
  @foreach($cowInfo as $cowInfoData)
    <label class="label label-default lblfarm">{{ $cowInfoData->cow_id }}</label>
  @endforeach
</td>
                  <td>{{date('M d, Y', strtotime($saleinfo->date))}}</td>
                  <td>{{$saleinfo->customer_name}}</td>
                  <td>{{$saleinfo->customer_number}}</td>
                  <td>{{$saleinfo->email}}</td>
                  <td>{{$saleinfo->address}}</td>
                  <td><label class="label label-success lblfarm">{{ App\Library\farm::currency($saleinfo->total_price)}}</label></td>
                  <td><label class="label label-warning lblfarm">{{ App\Library\farm::currency($total_paid)}}</label></td>
                  <td><label class="label label-danger lblfarm">{{ App\Library\farm::currency($total_due)}}</label></td>
                  <td><a href="#view{{$saleinfo->id}}" class="btn btn-info btn-xs" data-toggle="modal"> <i class="fa fa-info-circle"></i> </a>
                    <!-- Modal Start -->
                    <div class="modal fade" id="view{{$saleinfo->id}}" tabindex="-1" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-info-circle edit-color"></i> {{__('cow_sale.note') }}</h4>
                          </div>
                          <div class="modal-body">
                            <p class="text-equal">{{$saleinfo->note}}</p>
                          </div>
                          <div class="modal-footer"></div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                  </td>
                  <td><!-- Modal Start -->
                    <div class="modal fade" id="cow{{$saleinfo->id}}" tabindex="-1" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-info-circle edit-color"></i> {{__('cow_sale.cow_details') }}</h4>
                          </div>
                          <div class="modal-body">
                            <?php  $cowInfo = DB::table('cow_sale_dtls')->where('sale_id', $saleinfo->id)->get(); ?>
                            <table class="table table-bordered table-striped table-responsive">
                              	<th>{{__('cow_sale.image') }}</th>
                                <th>{{__('cow_sale.cow_no') }}</th>
                                <th>{{__('cow_sale.stall_no') }}</th>
                                <th>{{__('cow_sale.gender') }}</th>
                                <th>{{__('cow_sale.weight') }} ({{__('same.kg') }})</th>
                                <th>{{__('cow_sale.height') }} ({{__('same.inch') }})</th>
                              <tbody>
@foreach($cowInfo as $cowInfoData)
  <?php
      if($cowInfoData->cow_type == 1) {
          $dataInfo = DB::table('animals')
              ->leftJoin('sheds', 'sheds.id', 'animals.shade_no')
              ->where('animals.id', $cowInfoData->cow_id)
              ->select('animals.*', 'sheds.shed_number')
              ->first();
      } else {
          $dataInfo = DB::table('calf')
              ->leftJoin('sheds', 'sheds.id', 'calf.shade_no')
              ->where('calf.id', $cowInfoData->cow_id)
              ->select('calf.*', 'sheds.shed_number')
              ->first();
      }
  ?>

  @if($dataInfo)  {{-- Check if $dataInfo is not null before using it --}}
  <tr>
    <td>
      @if(!empty($dataInfo->pictures) && file_exists('storage/app/public/uploads/animal/'.explode('_', $dataInfo->pictures)[0]))
        <img src='{{ asset("storage/app/public/uploads/animal") }}/{{ explode("_", $dataInfo->pictures)[0] }}' class="img-thumbnail" width="100px">
      @else
        <img src='{{ asset("public/custom/img/noImage.jpg") }}' class="img-thumbnail" width="100px">
      @endif
    </td>
    <td>000 {{ $dataInfo->id }}</td>
    <td>{{ $dataInfo->shed_number }}</td>
    <td>{{ $dataInfo->gender }}</td>
    <td>{{ $dataInfo->weight }}</td>
    <td>{{ $dataInfo->height }}</td>
  </tr>
                               @else
  <tr>
    <td colspan="6" class="text-center text-danger">No data found for Cow ID: {{ $cowInfoData->cow_id }}</td>
  </tr>
  @endif

@endforeach

                              </tbody>

                            </table>
                          </div>
                          <div class="modal-footer"></div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <div class="form-inline">
                      <div class = "input-group"> <a target="_blank" href="{{URL::to('sale-invoice')}}/{{$saleinfo->id}}" class="btn btn-default btn-xs" title="{{__('same.invoice') }}"><i class="icon-doc"></i></a> </div>

                      <form action="{{ url('animal-monitor-statistics-leg') }}" method="POST" target="_blank" style="display:inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $dataInfo->id }}">
                            <button type="submit" class="btn btn-info btn-xs" title="Ledger">
                                <i class="fa-solid fa-money-bill"></i>
                            </button>
                        </form>

                      <div class = "input-group"> <a href="#cow{{$saleinfo->id}}" class="btn btn-primary btn-xs" data-toggle="modal" title="{{__('same.view') }}"><i class="icon-eye"></i></a> </div>
                      <div class = "input-group"> <a href="{{ route('sale-cow.edit', $saleinfo->id) }}" class="btn btn-success btn-xs" title="{{__('same.edit') }}"><i class="icon-pencil"></i></a> </div>
                      <div class = "input-group"> {{Form::open(array('route'=>['sale-cow.destroy',$saleinfo->id],'method'=>'DELETE'))}}
                        <button type="submit" confirm="Are you sure you want to delete this information ?" class="btn btn-danger btn-xs confirm" title="{{__('same.delete') }}"><i class="icon-trash"></i></button>
                        {!! Form::close() !!} </div>
                    </div></td>
                </tr>
                @endforeach
                </tbody>

              </table>


            <script>
  $(document).ready(function() {
    $('#cowSalesTable').DataTable({
      responsive: true,
      paging: true,
      searching: true,
      ordering: true,
      columnDefs: [
        { orderable: false, targets: [-1, -2] } // Disable sorting on the last two columns (note & actions)
      ],
      language: {
        search: "{{ __('search') }}",
        lengthMenu: "{{ __('show') }} _MENU_ {{ __('entries') }}",
        info: "{{ __('showing') }} _START_ {{ __('to') }} _END_ {{ __('of') }} _TOTAL_ {{ __('entries') }}",
        paginate: {
          first: "{{ __('first') }}",
          last: "{{ __('last') }}",
          next: "{{ __('next') }}",
          previous: "{{ __('previous') }}"
        }
      }
    });
  });
            </script>
              <div class="col-md-12" align="center"> {{$allData->render()}} </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer"> </div>
  </div>
</section>
@endsection
