@extends('backend.layouts.app')

@section('content')
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Edit</th>
                <th>Delete</th>
                 
            </tr>
        </thead>
    </table>
@stop

@section('after-scripts')
<script type="text/javascript">

$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.users.get') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            {"mRender": function ( data, type, row ) {
                return '<a href="'+row.id+'">Edit</a>';}
            },
            {"mRender": function ( data, type, row ) {
                return '<a href="'+row.id+'">Delete</a>';}
            }
        ],
    });
});
</script>
@stop