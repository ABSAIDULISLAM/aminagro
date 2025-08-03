@extends('layouts.layout')
@section('title', __('স্থায়ী খরচ'))
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <!-- Bootstrap Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

    <section class="content-header">
        <h1><i class="icon-list"></i> {{ __('স্থায়ী খরচ') }}</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {{ __('same.home') }}</a></li>
            <li class="active">{{ __('স্থায়ী খরচ') }}</li>
        </ol>
    </section>
    <section class="content">
        @include('common.message')
        <div class="box box-success">
            <div style="padding: 50px;">
                <form action="{{ route('save-permanent-expense-distribute') }}" method="POST">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">তারিখ*</label>
                        <input type="date" class="form-control" id="inputEmail4" placeholder="তারিখ" name="date"
                            style="width: 25%;" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="inputPassword4">গ্রুপ সিলেক্ট করুন</label>
                        <select class="form-control" id="groupSelect" name="group_id">
                            <option value="">Select Group</option>
                            @foreach ($groups as $item)
                                <option value="{{ $item->id }}"> {{ $item->group_name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="inputPassword4">গরু</label>
                        <select class="form-control selectpicker" id="cowSelect" name="cow[]" multiple
                            data-live-search="true" required>
                            <!-- Options will be loaded dynamically -->
                        </select>
                    </div>


                    <input type="hidden" value="0" name="status" />
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">মূল্য*</label>
                        <input type="number" class="form-control" id="inputEmail4" placeholder="মূল্য" name="price"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-left: 20px;">Save</button>
                </form>
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
                    <h4 class="modal-title"><i class="fa fa-plus-square color-green"></i> {{ __('food_item.add_new_unit') }}
                    </h4>
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cowSelect').select2({
                placeholder: "{{ __('same.select') }}",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
    <script>
        $('#groupSelect').on('change', function() {
            var groupId = $(this).val();

            $('#cowSelect').html(''); // clear old options

            if (groupId) {
                $.ajax({
                    url: "{{ url('/get-cows-by-group') }}/" + groupId,
                    type: 'GET',
                    success: function(data) {
                        if (data.length > 0) {
                            $.each(data, function(key, cow) {
                                $('#cowSelect').append('<option value="' + cow.id + '">' + cow
                                    .id + '</option>');
                            });
                        } else {
                            $('#cowSelect').append('<option disabled>No cows found</option>');
                        }

                        $('#cowSelect').selectpicker('refresh'); // refresh for bootstrap-select
                    }
                });
            } else {
                $('#cowSelect').html('');
                $('#cowSelect').selectpicker('refresh');
            }
        });
    </script>




@endsection
