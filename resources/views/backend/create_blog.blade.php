@extends('backend.layouts.app')

@section('content')
 
<div class="well">
 
    {{ Form::open(['route' => 'admin.blog.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
 
    <fieldset>
 
        <legend>Create Blog</legend>
 
         @include("backend.form_blog")
 
    </fieldset>
 
    {!! Form::close()  !!}
 
</div>
@stop
