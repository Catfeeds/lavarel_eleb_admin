@extends('layouts.default')
@section('title','帮助')

@section('content')
    <h1>帮助</h1>
    @if($age>=18)
    已成年
    @else
    未成年
    @endif
    {{ $age }}
@stop

@php
//phpinfo();
@endphp