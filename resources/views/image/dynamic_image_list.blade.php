@extends('layouts.base')

@section('content')
    <ul class="tabs tab-demo z-depth-1">
        <li class="tab"><a target="_self" href="{{ route('imageGenerate') }}">Generate</a></li>
        <li class="tab"><a target="_self" href="{{ route('imageUpload') }}">Upload</a></li>
        <li class="tab"><a target="_self" class="active" href="{{ route('listing') }}">List</a></li>
    </ul>

    {{--<ul class="collection">--}}
        {{--<li class="collection-item avatar">--}}
            {{--<i class="material-icons circle">folder</i>--}}
            {{--<span class="title">Title</span>--}}
            {{--<p>First Line <br>--}}
                {{--Second Line--}}
            {{--</p>--}}
        {{--</li>--}}
        {{--<li class="collection-item avatar">--}}
            {{--<i class="material-icons circle green">insert_chart</i>--}}
            {{--<span class="title">Title</span>--}}
            {{--<p>First Line <br>--}}
                {{--Second Line--}}
            {{--</p>--}}
        {{--</li>--}}
        {{--<li class="collection-item avatar">--}}
            {{--<i class="material-icons circle red">play_arrow</i>--}}
            {{--<span class="title">Title</span>--}}
            {{--<p>First Line <br>--}}
                {{--Second Line--}}
            {{--</p>--}}
        {{--</li>--}}
    {{--</ul>--}}

    <ul class="collection">
    @forelse($data as $item)
        <li class="collection-item avatar">
            <a href="{{ $item['current_item'] }}">
            <i class="material-icons circle">folder</i>
            <span class="title">Directory : /{{ $item['service'] }}</span>
            <p>Count : n개 <br>
                블라블라
            </p>
            </a>
        </li>
    @empty
        <li>empty directory</li>
    @endforelse
    </ul>

@endsection