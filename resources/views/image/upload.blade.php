@extends('layouts.base')

@section('content')
        <ul class="tabs tab-demo z-depth-1">
                <li class="tab"><a target="_self" href="{{ route('images.generateForm') }}">Generate</a></li>
                <li class="tab"><a target="_self" class="active" href="{{ route('images.uploadForm') }}">Upload</a></li>
                <li class="tab"><a target="_self" href="{{ route('images.collection') }}">List</a></li>
        </ul>

<div class="layout col1">
        <h5 class="layout_title light">
                <i class="material-icons left">desktop_windows</i>
                IMAGE VIEWER
        </h5>
        <div id="box--image_viewer">
                <div class="row">
                        <div class="card">
                                @if (session('fileFullPath'))
                                <div class="card-image">
                                        <a href="{{ session('fileFullPath') }}" target="_blank">
                                                <img src="{{ session('fileFullPath') }}" alt="">
                                        </a>
                                        <button type="button" class="btn-floating halfway-fab waves-effect waves-light red" title="copy image path"><i class="material-icons">content_copy</i></button>
                                </div>
                                <div class="card-content">
                                        <span class="card-title">IMAGE PATH</span>
                                        <input type="text" readonly value="{{ session('fileFullPath') }}">
                                </div>
                                @else
                                        <div class="card-image">
                                                <img src="{{asset('public/images/bg_no_image.png')}}" alt="">
                                        </div>
                                        {{--<div class="card-content">--}}
                                                {{--<span class="card-title">IMAGE PATH</span>--}}
                                                {{--<input type="text" readonly value="no Image">--}}
                                        {{--</div>--}}
                                @endif
                        </div>
                </div>
        </div>
</div>

<div class="layout col2">

        <h5 class="layout_title light">
                <i class="material-icons left">cloud_upload</i>
                DUMMY IMAGE UPLOAD
        </h5>

        <form action="{{ route('images.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{--@foreach ($errors->all() as $error)--}}
                        {{--<h1>{{ $error }}</h1>--}}
                {{--@endforeach--}}
                <input type="hidden" name="createType" value="upload">
                <div class="input-field">
                        <input placeholder="ex) smiledelivery" name="service" type="text" class="validate" value="@if(old('service')){{ old('service') }}@endif">
                        <label for="first_name" class="active">Service (directory name)</label>
                </div>

                <div class="input-field">
                        <input placeholder="ex) corner_best" name="prefix" type="text" class="validate" value="@if(old('prefix')){{ old('prefix') }}@endif">
                        <label for="first_name" class="active">Prefix (file name prefix)</label>
                </div>

                <div class="input-field">
                        <div class="file-field input-field">
                                <div class="btn">
                                        <span>File</span>
                                        <input type="file" name="file" value="">
                                        {{--@isset($file) {{ $file }} @endisset--}}
                                </div>
                                <div class="file-path-wrapper">
                                    @if ($errors->has('file'))
                                        <input class="file-path validate invalid" type="text" value="">
                                    @else
                                        <input class="file-path validate" type="text" value="">
                                    @endif
                                        {{--@isset($fileName) {{ $fileName }} @endisset--}}
                                </div>
                        </div>

                        @if ($errors->has('file'))
                            <label for="first_name" class="active">Upload File (wrong)</label>
                        @else
                            <label for="first_name" class="active">Upload File</label>
                        @endif
                </div>

                <div class="box--button col2">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Upload
                                <i class="material-icons right">cloud_upload</i>
                        </button>

                        <button class="btn waves-effect waves-light" type="button" name="action">Reset
                                <i class="material-icons right">refresh</i>
                        </button>
                </div>
        </form>
</div>
@endsection

{{--<div class="input-field col s12 m6">--}}
{{--<div class="select-wrapper">--}}
{{--<span class="caret">▼</span>--}}
{{--<select class="initialized">--}}
{{--<option value="" disabled="" selected="">Choose Service</option>--}}
{{--@forelse($data['serviceList'] as $item)--}}
{{--<option value="{{$item}}">{{$item}}</option>--}}
{{--@empty--}}
{{--<option>empty</option>--}}
{{--@endforelse--}}
{{--</select>--}}
{{--</div>--}}
{{--<label>서비스명</label>--}}
{{--</div>--}}