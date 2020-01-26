@extends('layouts.app')

@section('meta') 

<meta name="module-url" content="api/{{ Request::segment(1) }}">
<meta name="method" content="{{ Request::segment(2) }}">

@stop
