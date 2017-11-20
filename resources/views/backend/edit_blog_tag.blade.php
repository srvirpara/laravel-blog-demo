@extends('backend.layouts.app')

@section('content')
 
<div class="well">
 
    {{ Form::model($blogtag, ['route' => ['admin.blogtag.update', $blogtag], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}
 
    <fieldset>
 
        <legend>Legend</legend>
 
       @include("backend.form_blog_tag")
 
    </fieldset>
        
        <input type="hidden" name="id" value="{{$blogtag->id}}">    

    {!! Form::close()  !!}
 
</div>
@stop
