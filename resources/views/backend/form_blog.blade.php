<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.blogs.title'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', isset($blog->title)?$blog->title:"", ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.blogs.title'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('categories', trans('validation.attributes.backend.blogs.category'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        @if(isset($blog->blog_category_id) && !empty($blog->blog_category_id))
            {{ Form::select('categories', $blogCategories, $blog->blog_category_id, ['class' => 'form-control box-size custom_select', 'required' => 'required']) }}
        @else
            {{ Form::select('categories', $blogCategories, null, ['class' => 'form-control  box-size custom_select', 'required' => 'required']) }}
        @endif
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('publish_datetime', trans('validation.attributes.backend.blogs.publish'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            @if(!empty($blog->published_at))
                {{ Form::text('publish_datetime', \Carbon\Carbon::parse($blog->published_at)->format('Y-m-d H:i:s'), ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('validation.attributes.backend.blogs.publish'), 'required' => 'required', 'id' => 'datetimepicker1']) }}
            @else
                {{ Form::text('publish_datetime', null, ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('validation.attributes.backend.blogs.publish'), 'required' => 'required', 'id' => 'datetimepicker1']) }}
            @endif
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('content', trans('validation.attributes.backend.blogs.content'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.blogs.content')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group form-group-lg">
        {{ Form::label('tags', trans('validation.attributes.backend.blogs.tags'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        @if(!empty($selectedtags))
           {{ Form::select('tags[]', $blogTags, $selectedtags, ['class' => 'form-control tags custom_select box-size', 'required' => 'required', 'multiple' => 'multiple']) }}
        @else
            {{ Form::select('tags[]', $blogTags, null, ['class' => 'form-control tags custom_select box-size', 'required' => 'required', 'multiple' => 'multiple']) }}
        @endif
        </div><!--col-lg-3-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('meta_title', trans('validation.attributes.backend.blogs.meta-title'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('meta_title', null, ['class' => 'form-control box-size ', 'placeholder' => trans('validation.attributes.backend.blogs.meta-title')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('slug', trans('validation.attributes.backend.blogs.slug'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('slug', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.blogs.slug'), 'disabled' => 'disabled']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('meta_keywords', trans('validation.attributes.backend.blogs.meta_keyword'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('meta_keywords', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.blogs.meta_keyword')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('meta_description', trans('validation.attributes.backend.blogs.meta_description'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('meta_description', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.blogs.meta_description')]) }}
        </div><!--col-lg-3-->
    </div><!--form control-->

      <!-- Submit Button -->
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <a href="{{route('admin.blog.index')}}"><input class="btn btn-lg btn-info btn-danger" type="button" value="Cancel">
                {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
            </div>
        </div>
</div>

@section("after-scripts")
    <script type="text/javascript">

        $('.custom_select').select2({
          placeholder: 'Select an option'
        });
        
        //For Blog datetimepicker for publish_datetime
        $('#datetimepicker1').datetimepicker();

        //changing slug on blur event
        $("#name").on('blur',function()
        {
            url = $(this).val();
            var csrf_token = $('#csrf_token_header').val();
            if(url !== '')
            {
                $.ajax({
                    type:"POST",
                    url : "{{route('admin.generate.slug')}}",
                    data : {text:url,_token:csrf_token},
                    success : function(data) {
                      $('#slug').val( "{{url('/')}}" + '/' + data);
                    }
                });
            }
        });
    </script>
@endsection