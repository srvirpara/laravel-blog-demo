@extends('backend.layouts.app')

@section('content')
 
<div class="well">
 
    {{ Form::open(['route' => 'admin.blogcategories.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
 
    <fieldset>
 
        <legend>Create Blog Category</legend>
 
         @include("backend.form_blog_category")
 
    </fieldset>
 
    {!! Form::close()  !!}
 
</div>
@stop
