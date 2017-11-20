        <!-- Name -->
        <div class="form-group">
            {!! Form::label('name', 'Category Name:', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                 {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => 'Category Name', 'required' => 'required']) }}
                <div class="checkbox">
                    {!! Form::label('checkbox', 'Status') !!}
                    {!! Form::checkbox('status') !!}
                </div>
            </div>
        </div>
 
        <!-- Submit Button -->
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
            <a href="{{route('admin.blogcategories.index')}}"><input class="btn btn-lg btn-info btn-danger" type="button" value="Cancel">
                {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
            </div>
        </div>