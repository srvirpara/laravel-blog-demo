@extends('backend.layouts.app')

@section('content')
    <div class="row">
      <div class="col-md-6">
        <h2 class="pull-left heading"><b>Blog Tags Management</b></h2>
      </div>
      <div class="col-md-6 action-name">
        <a class="btn btn-sm btn-default pull-right" href="{!! route('admin.blogtag.create') !!}">
          <i class="fa fa-plus-square"></i> Create Blog Tag
        </a>
      </div>
    </div>
    <table class="table table-bordered" id="blog-tag-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Status</th>
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
    $('#blog-tag-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.blogtag.get') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'status', name: 'status',"mRender": function ( data, type, row ) {
                    if(row.status == 1){
                        return '<span class="label label-success">Active</span>';
                    }else{
                         return '<span class="label label-danger">Inactive</span>';
                    }
                }
            },
            { data: 'created_at', name: 'created_at',
                "mRender": function ( data, type, row ) {
                return new Date(row.created_at).toDateString();}
            },
            { data: 'updated_at', name: 'updated_at',
                "mRender": function ( data, type, row ) {
                return new Date(row.updated_at).toDateString();}
            },
            {"mRender": function ( data, type, row ) {
                return '<a href="'+baseUrl+'/edit-blog-tag/'+row.id+'">Edit</a>';},searchable: false, sortable: false
            },
            {"mRender": function ( data, type, row ) {
                return '<a href="'+baseUrl+'/delete-blog-tag/'+row.id+'">Delete</a>';},searchable: false, sortable: false
            }
        ],
    });
});
</script>
@stop