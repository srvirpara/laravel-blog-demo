@extends('backend.layouts.app')

@section('content')
 
<div class="well">
 
    {{ Form::model($blog, ['route' => ['admin.blog.update', $blog], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}
 
    <fieldset>
 
        <legend>Legend</legend>
 
       @include("backend.form_blog")
 
    </fieldset>
        
        <input type="hidden" name="id" value="{{$blog->id}}">    

    {!! Form::close()  !!}
 
</div>
@stop
