@extends('layouts.base')

@section('content')
    <ul class="tabs tab-demo z-depth-1">
        <li class="tab"><a target="_self" href="{{ route('font.collection') }}">LIST</a></li>
        <li class="tab"><a target="_self" class="active" href="{{ route('font.collection') }}">UPLOAD</a></li>
    </ul>
    font add
@endsection