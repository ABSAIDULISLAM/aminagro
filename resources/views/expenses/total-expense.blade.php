@extends('layouts.layout')
@section('title', __('Report Summary'))
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa-solid fa-money-bill"></i> {{__('Report Summary') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
        <li class="active">{{__('Report Summary') }}</li>
    </ol>
</section>
<section class="content">

    <div class="box box-success">

        <form action="{{route('total-report')}}" method="get">
            <label for="">Animal Status</label>
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="" disabled selected>Filter By Own Choice</option>
                <option value="" {{ request('status') === null ? 'selected' : '' }}>All</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Available Animals</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Sold Animals</option>
                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Dead Animals</option>
            </select>
        </form>


        <div class="box-body">

            <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

            <!-- jQuery & DataTables JS -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
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

            <div class="table-responsive">
                <div class="mb-3">
                    <a href="{{ URL::to('add-permanent-expense') }}" class="btn btn-success btn-sm" data-toggle="modal">
                        <i class="fa fa-plus-square"></i> <b>Add New</b>
                    </a>
                    <button onclick="window.print()" class="btn btn-primary btn-sm ml-2">
                        <i class="fa-solid fa-print"></i> Print
                    </button>
                </div>

                <table id="cowFoodTable" class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Serial</th>
                            <th>Date</th> {{-- DOB --}}
                            <th>Tag No</th> {{-- animals.id --}}
                            <th>Purchased</th> {{-- buying_price --}}
                            <th>Expenses</th> {{-- total of all expenses --}}
                            <th>Total Cost</th> {{-- buying_price + total expenses --}}
                            <th>Sold Price</th>
                            <th>Profit</th> {{-- sold - (buying + expenses) --}}
                        </tr>
                    </thead>
                    @php
                    $totalPurches = 0;
                    $totalExpense = 0;
                    $totalcost = 0;
                    $totalSoldPrice = 0;
                    $totalProfit = 0;
                    @endphp
                    <tbody>
                        @foreach($PermanentExpense as $index => $expense)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $expense->formatted_dob }}</td>
                            <td>{{ $expense->id }}</td>
                            <td class="text-right">{{ number_format($expense->buying_price, 2) }}</td>
                            <td class="text-right">{{ number_format($expense->total_expenses, 2) }}</td>
                            <td class="text-right">{{ number_format($expense->total_cost, 2) }}</td>
                            <td class="text-right">
                                {{ $expense->sold_price !== null ? number_format($expense->sold_price, 2) : '-' }}
                            </td>
                            <td class="text-right">
                                {{ $expense->profit !== null ? number_format($expense->profit, 2) : '-' }}
                            </td>
                        </tr>
                        @php
                        $totalPurches += $expense->buying_price ?? 0;
                        $totalExpense += $expense->total_expenses ?? 0;
                        $totalcost += $expense->total_cost ?? 0;
                        $totalSoldPrice += $expense->sold_price ?? 0;
                        $totalProfit += $expense->profit ?? 0;
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-end" colspan="3">Total</th>
                            <th class="text-right">{{ number_format($totalPurches, 2) }}</th>
                            <th class="text-right">{{ number_format($totalExpense, 2) }}</th>
                            <th class="text-right">{{ number_format($totalcost, 2) }}</th>
                            <th class="text-right">{{ number_format($totalSoldPrice, 2) }}</th>
                            <th class="text-right">{{ number_format($totalProfit, 2) }}</th>
                        </tr>
                    </tfoot>

                </table>
            </div>

            <style>
                @media print {
                    #cowFoodTable_filter {
                        visibility: hidden;
                    }

                    .mb-3,
                    .dataTables_info,
                    .dataTables_paginate,
                    .main-footer {
                        visibility: hidden;
                    }
                }
            </style>
        </div>
    </div>
</section>
@endsection
