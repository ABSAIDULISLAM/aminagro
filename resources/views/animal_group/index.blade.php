@extends('layouts.layout')
@section('title', __('Animal Groups'))

@section('content')
    <div class="container">
        <h3 class="text-left">Animal Groups</h3>
        <div class="text-right" style="margin-bottom: 10px;">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Create Group</button>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Validation Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="font-size: 13px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Group Name</th>
                    <th>Cows</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alldata as $key => $group)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $group->group_name }}</td>
                        <td>
                            @foreach ($group->animals as $cow)
                                <span class="label label-success">{{ $cow->id }}</span>
                            @endforeach
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                onclick="editGroup({{ $group->id }}, '{{ $group->group_name }}', {{ json_encode($group->animals->pluck('id')) }})"
                                data-toggle="modal" data-target="#editModal">
                                Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <form action="{{ route('animal-group.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Group</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Group Name</label>
                        <select name="group_id" id="" class="form-control ">
                            @foreach ($groups as $item)
                                <option value="{{ $item->id }}">{{ $item->group_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Cows</label>
                        <select name="cow_ids[]" id="edit_cow_ids" class="form-control select2" multiple>
                            @foreach ($cows as $cow)
                                <option value="{{ $cow->id }}">{{ $cow->id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <form action="{{ route('animal-group.update') }}" method="POST" class="modal-content">
                @csrf
                <input type="hidden" name="group_id" id="edit_group_id">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Group</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Group Name</label>
                        <input type="text" id="edit_group_name" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Select Cows</label>
                        <select name="cow_ids[]" id="edit_cow_ids_two" class="form-control cowselect select2" multiple>
                            @foreach ($cows as $cow)
                                <option value="{{ $cow->id }}" >{{ $cow->id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>

        <script>
            // initialize select2 on page load
            $(document).ready(function() {
                $('#edit_cow_ids_two').select2({
                    dropdownParent: $('#editModal') // fixes select2 inside Bootstrap modal
                });
            });

            function editGroup(id, name, cowIds) {
                $('#edit_group_id').val(id);
                $('#edit_group_name').val(name);

                // Clear previous selections and set new ones
                $('#edit_cow_ids_two').val(cowIds).trigger('change');
            }

            // Optional: clear modal data when closed
            $('#editModal').on('hidden.bs.modal', function() {
                $('#edit_group_id').val('');
                $('#edit_group_name').val('');
                $('#edit_cow_ids_two').val(null).trigger('change');
            });
        </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#edit_cow_ids').select2({
                placeholder: "{{ __('same.select') }}",
                allowClear: true,
                width: '100%'
            });
            $('#edit_cow_ids_two').select2({
                placeholder: "{{ __('same.select') }}",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
    <script>
        function editGroup(id, name, cowIds) {
            document.getElementById('edit_group_id').value = id;
            document.getElementById('edit_group_name').value = name;

            var select = document.getElementById('edit_cow_ids');
            for (var i = 0; i < select.options.length; i++) {
                select.options[i].selected = cowIds.includes(parseInt(select.options[i].value));
            }
        }
    </script>
@endsection
