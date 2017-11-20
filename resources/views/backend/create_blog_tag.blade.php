@extends('backend.layouts.app')

@section('content')
 
<div class="well">
 
    {{ Form::open(['route' => 'admin.blogtag.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
 
    <fieldset>
 
        <legend>Create Blog Tag</legend>
 
         @include("backend.form_blog_tag")
 
    </fieldset>
 
    {!! Form::close()  !!}
 
</div>
@stop
