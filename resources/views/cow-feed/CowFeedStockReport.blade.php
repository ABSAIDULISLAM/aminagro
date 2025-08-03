@extends('layouts.layout')
@section('title', __('cow_feed.title_entry'))
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-cutlery"></i> {{__('cow_feed.title_entry') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
        <li class="active">{{__('cow_feed.title_entry') }}</li>
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
        {{ Form::open(array('route' => ['cow-feed.update',$single_data->id], 'method' => 'PUT', 'files' => true))  }}
        <?php $btn_name = __('same.update'); ?>
        @endif

        <div class="box-body">
            <!-- DataTables CSS -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

            <!-- jQuery & DataTables JS -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <!-- DataTables Initialization -->
            <script>
                $(document).ready(function() {
                    $('#cowFoodTable').DataTable({
                        "paging": true, // Enable pagination
                        "lengthChange": false, // Show entries dropdown
                        "searching": true, // Enable search box
                        "ordering": true, // Enable sorting
                        "info": true, // Show info
                        "autoWidth": false // Adjust column width
                    });
                });
            </script>

            <table id="cowFoodTable" class="table table-bordered table-hover">
                <button onclick="window.print()" class="btn btn-primary mb-3">Print <i class="fa-solid fa-print"></i></button>
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Food Name</th>
                        <th>Unit</th>
                        <th>Current Stock</th>
                        <th>Unit Price</th>
                        <th>Total Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($food_report as $index => $food)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $food->name }}</td>
                        <td>{{ $food->unit }}</td>
                        <td>{{ number_format($food->stock, 2) }}</td>
                        <td>
                            @if($food->price !== null)
                            {{ number_format($food->price, 2) }}
                            @else
                            N/A
                            @endif
                        </td>
                        <td>
                            @if($food->total_value !== null)
                            {{ number_format($food->total_value, 2) }}
                            @else
                            N/A
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <!-- Rest of your view remains the same -->
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
        {!! Form::close() !!}
    </div>
</section>
@endsection
