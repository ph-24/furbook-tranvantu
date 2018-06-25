@extends('layouts.master')
@section('header')
	<h2>Add a new cat</h2>
@stop
@section('content')
{!! Form::open(['url'=>route('cats.store')]) !!}
@include('partials.forms.cat')
{!! Form::close() !!}
@stop