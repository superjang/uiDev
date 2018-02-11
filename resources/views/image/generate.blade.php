@extends('layouts.base')

@section('content')
<ul class="tabs tab-demo z-depth-1">
        <li class="tab"><a target="_self" class="active" href="{{ route('images.generateForm') }}">Generate</a></li>
        <li class="tab"><a target="_self" href="{{ route('images.uploadForm') }}">Upload</a></li>
        <li class="tab"><a target="_self" href="{{ route('images.collection', ['imageAddedType' => 'generated']) }}">List</a></li>
</ul>

<div class="layout col1">
        <h5 class="layout_title light">
                <i class="material-icons left">desktop_windows</i>
                IMAGE VIEWER
        </h5>
        <div id="box--image_viewer">
                <div class="row">
                        <div class="card">
                            @if (session('full_path'))
                                <div class="card-image">
                                    <a href="{{session('full_path')}}" target="_blank" title="{{ session('full_path') }}">
                                        <img src="{{session('full_path')}}" alt="">
                                    </a>
                                    <button type="button" class="btn-floating halfway-fab waves-effect waves-light red" title="copy image path"><i class="material-icons">content_copy</i></button>
                                </div>
                                <div class="card-content">
                                    {{--<span class="card-title">IMAGE PATH</span>--}}
                                    {{--<input type="text" readonly value="{{session('fileFullPath')}}">--}}
                                    <span class="card-title">IMAGE REQUEST URL</span>
                                    <input type="text" readonly value="{{session('request_path')}}">
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
                <i class="material-icons left">tune</i>
                SET IMAGE PARAMETER
        </h5>

        <form action="{{ route('images.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="image_added_type" value="generate">
                {{--<input type="hidden" name="requestFrom" value="view">--}}

                <div class="input-field">
                    <div class="select-wrapper">
                        <select class="initialized" name="site">
                            @foreach($site_list as $item)
                                @if(old('site'))
                                    <option value="{{$item}}" selected="selected">{{$item}}</option>
                                @else
                                    <option value="{{$item}}">{{$item}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <label>Site</label>
                </div>

                <div class="input-field">
                        <input placeholder="ex) smiledelivery" id="first_name" type="text" class="validate" name="service" value="{{old('service')}}">
                        <label for="first_name" class="active">Service (directory name)</label>
                </div>

                <div class="input-field">
                        <input placeholder="ex) corner_best" id="first_name" type="text" class="validate" name="tag" value="{{old('tag')}}">
                        <label for="first_name" class="active">Tag</label>
                </div>

                <div class="input-field">
                        <div class="select-wrapper">
                                <select class="initialized" name="image_format_type">
                                @foreach($image_format_type as $item)
                                        @if(old('image_format_type'))
                                                @if($item === old('image_format_type'))
                                                        <option value="{{$item}}" selected="selected">{{$item}}</option>
                                                @else
                                                        <option value="{{$item}}">{{$item}}</option>
                                                @endif
                                        @else
                                                @if($item === 'png')
                                                        <option value="{{$item}}" selected="selected">{{$item}}</option>
                                                @else
                                                        <option value="{{$item}}">{{$item}}</option>
                                                @endif
                                        @endif
                                @endforeach
                                </select>
                        </div>
                        <label>Format</label>
                </div>

                <div class="input-field">
                        @if ($errors->has('width'))
                                <input placeholder="ex) 360" id="first_name" type="number" min="1" class="validate invalid" name="width" value="{{old('width')}}">
                                <label for="first_name" class="active">Width (wrong)</label>
                        @else
                                <input placeholder="ex) 360" id="first_name" type="number" min="1" class="validate" name="width" value="{{old('width')}}">
                                <label for="first_name" class="active">Width (px)</label>
                        @endif
                </div>

                <div class="input-field">
                        @if ($errors->has('height'))
                                <input placeholder="ex) 200" id="first_name" type="number" min="1" class="validate invalid" name="height" value="{{old('height')}}">
                                <label for="first_name" class="active">Height (wrong)</label>
                        @else
                                <input placeholder="ex) 200" id="first_name" type="number" min="1" class="validate" name="height" value="{{old('height')}}">
                                <label for="first_name" class="active">Height (px)</label>
                        @endif
                </div>

                <div class="input-field">
                        <input placeholder="ex) 08364d" id="first_name" type="text" name="color" class="validate" value="{{old('color')}}">
                        <label for="first_name" class="active">Color (hex)</label>
                </div>

                <div class="input-field">
                        <p class="range-field">
                            @if(old('opacity'))
                                <input type="range" value="{{old('opacity')}}" min="0" max="100" name="opacity"/>
                            @else
                                <input type="range" value="0" min="0" max="100" name="opacity"/>
                            @endif
                        </p>
                        <label for="first_name" class="active">Opacity (%)</label>
                </div>

                <div class="box--button col2">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Generate
                                <i class="material-icons right">image</i>
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