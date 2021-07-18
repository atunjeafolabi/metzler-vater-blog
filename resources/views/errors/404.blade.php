@extends('errors::illustrated-layout')

@section('title', __($exception->getMessage() ?: 'Not Found'))
@section('code', '404')
@section('message', __($exception->getMessage() ?: 'Not Found'))
@section('back-button')
    <small><a href="{{route('index')}}">Go back</a></small>
@endsection

