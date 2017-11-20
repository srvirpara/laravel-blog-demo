@extends('backend.layouts.app')

@section('content')
 
<div class="well">
 
    {{ Form::model($blogcategory, ['route' => ['admin.blogcategories.update', $blogcategory], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}
 
    <fieldset>
 
        <legend>Legend</legend>
 
       @include("backend.form_blog_category")
 
    </fieldset>
        
        <input type="hidden" name="id" value="{{$blogcategory->id}}">    

    {!! Form::close()  !!}
 
</div>
@stop
