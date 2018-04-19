@extends('layouts.default')
@section('title', $cat->name)

@section('content')
    <h1>{{ $cat->name }}</h1>
    <img src="@if($cat->logo){{ $cat->logo }}@endif">

@stop