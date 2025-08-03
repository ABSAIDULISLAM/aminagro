@extends('layouts.layout')
@section('title', __('expense.title'))
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="icon-list"></i> {{__('expense.title') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
        <li class="active">{{__('expense.title') }}</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    @include('common.message')
    <div class="box box-success">
        <div class="box-header with-border" align="right"> <a href="#saveModal" data-toggle="modal" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> <b>{{__('same.add_new') }}</b></a> <a href="{{  url('expense-list')  }}" class="btn btn-warning  btn-sm"><i class="fa fa-refresh"></i> <b>{{__('same.refresh') }}</b></a> </div>
        <div class="box-body">
            <div class="form-group">
                <div class="clearfix"></div>
            </div>
            <div class="table_scroll">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['method' => 'GET', 'class' => 'form-inline']) !!}

                        <!-- Search Bar -->
                        <div class="form-group" style="margin-right: 20px;">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="{{__('Search Placeholder')}}"
                                    value="{{ request('search') }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Purpose Filter -->
                        <div class="form-group" style="margin-right: 20px;">
                            <label for="purpose_filter" style="margin-right: 10px;">{{__('Filter By Purpose')}}:</label>
                            <select name="purpose_filter" id="purpose_filter" class="form-control">
                                <option value="">{{__('All Purposes')}}</option>
                                @foreach($allPurpose as $purpose)
                                <option value="{{ $purpose->id }}" {{ request('purpose_filter') == $purpose->id ? 'selected' : '' }}>
                                    {{ $purpose->purpose_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{__('Filter')}}</button>

                        @if(request('purpose_filter') || request('search'))
                        <a href="{{ url()->current() }}" class="btn btn-default" style="margin-left: 10px;">
                            {{__('Clear Filter')}}
                        </a>
                        @endif

                        {!! Form::close() !!}
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>{{__('expense.date') }}</th>
                            <th>{{__('expense.purpose_name') }}</th>
                            <th>{{__('expense.details') }}</th>
                            <th class="text-right">জমা</th>
                            <th class="text-right">খরচ</th>
                            <th class="action">{{__('same.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allData as $index => $data)
                        <tr>
                            <td class="text-center">{{ ($allData->currentPage() - 1) * $allData->perPage() + $index + 1 }}</td>
                            <td>{{ date('d/m/Y', strtotime($data->date)) }}</td>
                            <td>{{ $data->purpose_name }}</td>
                            <td>
                                <p>{{ $data->note . $data->food }}</p>
                            </td>
                            <td class="text-right">
                                @if($data->status == 1)
                                {{ App\Library\farm::currency($data->amount) }}
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-right">
                                @if($data->status == 0)
                                {{ App\Library\farm::currency($data->amount) }}
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-center action">
                                <div style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                                    <!--<a href="#editModal{{$data->id}}" data-toggle="modal" class="btn btn-primary btn-sm" title="{{__('same.edit') }}">-->
                                    <!--    <i class="icon-pencil"></i>-->
                                    <!--</a>-->
                                    <form action="{{ route('expense-list.destroy', $data->id) }}" method="POST" onsubmit="return confirm('{{__('same.delete_confirm') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="{{__('same.delete') }}">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </form>
                                </div>

                                <!-- Modal (keep your existing modal code here) -->
                                <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
                                    <!-- ... your existing modal code ... -->
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if($allData->isEmpty())
                        <tr>
                            <td colspan="7" align="center">
                                <h2>{{__('same.empty_row') }}</h2>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot class="font-weight-bold">
                        <tr>
                            <td colspan="4" class="text-right">মোট:</td>
                            <td class="text-right">{{ App\Library\farm::currency($totalIncome) }}</td>
                            <td class="text-right">{{ App\Library\farm::currency($totalExpense) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">নিট টাকা:</td>
                            <td colspan="2" class="text-right">{{ App\Library\farm::currency($netAmount) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                <!-- Pagination links -->
                <div class="d-flex justify-content-center">
                    {{ $allData->links() }}
                </div>
                <div align="center">{{ $allData->render() }}</div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer"> </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
    <!-- Modal -->
    <div class="modal fade" id="saveModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus-square color-green"></i> {{__('expense.add_new_purpose') }}</h4>
                </div>
                {!! Form::open(array('route' =>['expense-list.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
                <div class="modal-body">
                    <div class="form-group"> {{Form::label('purpose_id', __('expense.purpose_name').':', array('class' => 'col-md-3 control-label'))}}
                        <div class="col-md-8">
                            <select name="purpose_id" for="purpose_id" class="form-control" required>
                                <option value="">{{__('same.select') }}</option>
                                @foreach($allPurpose as $purpose)
                                <option value="{{$purpose->id}}">{{$purpose->purpose_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group"> {{Form::label('date', __('expense.date').':', array('class' => 'col-md-3 control-label'))}}
                        <div class="col-md-8">
                            <input type="text" name="date" class="form-control wsit_datepicker" required>
                        </div>
                    </div>
                    <div class="form-group"> {{Form::label('note', __('expense.details').':', array('class' => 'col-md-3 control-label'))}}
                        <div class="col-md-8">
                            <textarea name="note" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group"> {{Form::label('amount', __('expense.expense_amount').':', array('class' => 'col-md-3 control-label'))}}
                        <div class="col-md-8">
                            <input type="text" name="amount" class="form-control decimal" required>
                        </div>
                    </div>
                    <div class="form-group"> {{Form::label('amount', __('ধরণ').':', array('class' => 'col-md-3 control-label'))}}
                        <div class="col-md-8">

                            <label for="inputPassword4"></label>
                            <select class="form-control" id="exampleFormControlSelect1" name="status">
                                <option value="1">জমা</option>
                                <option value="0">খরচ</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 pull-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{__('same.close') }}</button>
                            {{Form::submit(__('same.save'),array('class'=>'btn btn-success'))}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"> </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</section>
<!-- /.content -->
@endsection
