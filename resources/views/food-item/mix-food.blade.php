@extends('layouts.layout')
@section('title', __('Mix Food'))
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-cutlery"></i> {{__('Mix Food') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> {{__('same.home') }}</a></li>
        <li class="active">{{__('Mix Food') }}</li>
    </ol>
</section>
<section class="content">
    <!-- Default box -->
    @include('common.message')
    @include('common.commonFunction')
    <div class="box box-success"> @if(empty($single_data))
        {{ Form::open(array('route' => 'mix-food-add', 'method' => 'post', 'files' => true))  }}
        <?php $btn_name = __('same.save'); ?>
        @else
        {{ Form::open(array('route' => ['cow-feed.update',$single_data->id], 'method' => 'PUT', 'files' => true))  }}
        <?php $btn_name = __('same.update'); ?>
        @endif
        <div class="box-header with-border" align="right">
            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-floppy-o"></i> <b>{{$btn_name}} {{__('same.information') }}</b></button>
            <a href="{{  url('cow-feed/create')  }}" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> <b> {{__('same.refresh') }}</b></a> &nbsp;&nbsp;
        </div>
        <div class="box-body">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading feed-heading feed-heading"><i class="fa fa-info-circle"></i>&nbsp;{{__('cow_feed.basic_information') }} :</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">{{__('cow_feed.date') }} <span class="validate">*</span> : </label>
                                        <input type="text" name="date" class="form-control wsit_datepicker" value="{{(!empty($single_data->date))?date('m/d/Y', strtotime($single_data->date)):''}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">{{__('Name') }} <span class="validate">*</span> : </label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading feed-heading"><i class="fa fa-info-circle"></i>&nbsp;{{__('cow_feed.feed_informations') }} :</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-responsive table-bordered table-striped">
                                    <th>{{__('cow_feed.item_name') }}</th>
                                    <th>{{__('cow_feed.item_quantity') }}</th>
                                    <th>{{__('Available Unit') }}</th>
                                    <!--<th>{{__('cow_feed.feeding_time') }}</th>-->
                                    <tbody>
                                        <?php $row = 1; ?>
                                        @foreach($food_items as $food_item_data)
                                        @if(isset($single_data))
                                        <?php
                                        $checkData = DB::table('cow_feed_dtls')
                                            ->where('feed_id', $single_data->id)
                                            ->where('item_id', $food_item_data->id)
                                            ->exists();
                                        if ($checkData == true) {
                                            $savedData = DB::table('cow_feed_dtls')
                                                ->where('feed_id', $single_data->id)
                                                ->where('item_id', $food_item_data->id)
                                                ->first();
                                        }
                                        ?>
                                        @endif
                                        <tr>
                                            <td><label class="checkbox-inline">
                                                    <input type="checkbox" name="cow_feed[{{$row}}][item_id]" value="{{$food_item_data->id}}" {{(isset($checkData)?($checkData==true)?'checked':'':'')}}>
                                                    {{$food_item_data->name}} </label>
                                            </td>
                                            <td><input type="text" name="cow_feed[{{$row}}][qty]" class="form-control" )}}">
                                            </td>
                                            <td>
                                                <select name="cow_feed[{{$row}}][unit_id]" class="form-control" disabled>
                                                    <option value="">{{ __('same.select') }}</option>
                                                    @foreach($food_units as $food_unit_data)
                                                    <option value="{{$food_unit_data->id}}"
                                                        {{ $food_unit_data->name == $food_item_data->unit ? 'selected' : '' }}>
                                                        {{$food_item_data->stock}} {{$food_unit_data->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="cow_feed[{{$row}}][unit_id]" value="{{$food_units->where('name', $food_item_data->unit)->first()->id ?? ''}}">
                                            </td>
                                            <!--<td><input type="text" name="cow_feed[{{$row}}][time]" class="form-control" placeholder="{{__('cow_feed.time_example') }}" value="{{(isset($checkData)?($checkData==true)?$savedData->time:'':'')}}">-->
                                            <!--</td>-->
                                        </tr>
                                        <?php $row++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</section>
@endsection
