@extends('backend.layouts.app')

@section('content')
    <div class="row">
      <div class="col-md-6">
        <h2 class="pull-left heading"><b>Blog Management</b></h2>
      </div>
      <div class="col-md-6 action-name">
        <a class="btn btn-sm btn-default pull-right" href="{{route('admin.blog.create')}}">
          <i class="fa fa-plus-square"></i> Create Blog
        </a>
      </div>
    </div>
    <table class="table table-bordered" id="blog-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Content</th>
                <th>Published At</th>
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
    $('#blog-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.blog.get') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'content', name: 'content',
                "mRender": function ( data, type, row ) {
                    return htmlspecialchars_decode(row.content);
                }
            },
            { data: 'published_at', name: 'published_at',
              "mRender": function ( data, type, row ) {
                return new Date(row.published_at).toDateString();}
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
                return '<a href="'+baseUrl+'/edit-blog/'+row.id+'">Edit</a>';},searchable: false, sortable: false
            },
            {"mRender": function ( data, type, row ) {
                return '<a href="'+baseUrl+'/delete-blog/'+row.id+'">Delete</a>';},searchable: false, sortable: false
            }
        ],
    });
});


/*Function for decode the html special character*/
function htmlspecialchars_decode (string, quoteStyle) {
      var optTemp = 0
      var i = 0
      var noquotes = false
      if (typeof quoteStyle === 'undefined') {
        quoteStyle = 2
      }
      string = string.toString()
        .replace(/&lt;/g, '<')
        .replace(/&gt;/g, '>')
      var OPTS = {
        'ENT_NOQUOTES': 0,
        'ENT_HTML_QUOTE_SINGLE': 1,
        'ENT_HTML_QUOTE_DOUBLE': 2,
        'ENT_COMPAT': 2,
        'ENT_QUOTES': 3,
        'ENT_IGNORE': 4
      }
      if (quoteStyle === 0) {
        noquotes = true
      }
      if (typeof quoteStyle !== 'number') {
        // Allow for a single string or an array of string flags
        quoteStyle = [].concat(quoteStyle)
        for (i = 0; i < quoteStyle.length; i++) {
          // Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
          if (OPTS[quoteStyle[i]] === 0) {
            noquotes = true
          } else if (OPTS[quoteStyle[i]]) {
            optTemp = optTemp | OPTS[quoteStyle[i]]
          }
        }
        quoteStyle = optTemp
      }
      if (quoteStyle & OPTS.ENT_HTML_QUOTE_SINGLE) {
        // PHP doesn't currently escape if more than one 0, but it should:
        string = string.replace(/&#0*39;/g, "'")
        // This would also be useful here, but not a part of PHP:
        // string = string.replace(/&apos;|&#x0*27;/g, "'");
      }
      if (!noquotes) {
        string = string.replace(/&quot;/g, '"')
      }
      // Put this in last place to avoid escape being double-decoded
      string = string.replace(/&amp;/g, '&')
      return string
    }
</script>
@stop