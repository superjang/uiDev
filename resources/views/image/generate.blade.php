@extends('layouts.base')

@section('content')
<ul class="tabs tab-demo z-depth-1">
        <li class="tab"><a target="_self" class="active" href="{{ route('imageGenerate') }}">Generate</a></li>
        <li class="tab"><a target="_self" href="{{ route('imageUpload') }}">Upload</a></li>
        <li class="tab"><a target="_self" href="{{ route('listing') }}">List</a></li>
</ul>

<div class="layout col1">
        <h5 class="layout_title light">
                <i class="material-icons left">desktop_windows</i>
                IMAGE VIEWER
        </h5>
        <div id="box--image_viewer">
                <div class="row">
                        <div class="card">
                                <div class="card-image">
                                        <img src="/image/generation?width=271&height=203&bgColor=08364d" alt="">
                                        <button type="button" class="btn-floating halfway-fab waves-effect waves-light red" title="copy image path"><i class="material-icons">content_copy</i></button>
                                </div>
                                <div class="card-content">
                                        <span class="card-title">IMAGE PATH</span>
                                        <input type="text" readonly value="/image/generation?width=271&height=203&bgColor=08364d">
                                </div>
                        </div>
                </div>
        </div>
</div>

<div class="layout col2">

        <h5 class="layout_title light">
                <i class="material-icons left">tune</i>
                SET IMAGE PARAMETER
        </h5>

        <form action="{{ route('imageMake') }}" method="POST" enctype="multipart/form-data">
                {!! ! csrf_field() !!}
                <div class="input-field">
                        <input placeholder="ex) smiledelivery" id="first_name" type="text" class="validate" tabindex="2" value="@isset($data->service) {{ $data->service }} @endisset">
                        <label for="first_name" class="active">Service (directory name)</label>
                </div>

                <div class="input-field">
                        <input placeholder="ex) corner_best" id="first_name" type="text" class="validate" tabindex="2">
                        <label for="first_name" class="active">Prefix (file name prefix)</label>
                </div>

                <div class="input-field">
                        <div class="select-wrapper">
                                <select class="initialized">
                                        <option value="" disabled="" selected="">Choose Image Format</option>
                                        <option value="png">png</option>
                                        <option value="jpg">jpg</option>
                                        <option value="gif">gif</option>
                                </select>
                        </div>
                        <label>Format</label>
                </div>

                <div class="input-field">
                        <input placeholder="ex) 360" id="first_name" type="number" min="1" class="validate" tabindex="2">
                        <label for="first_name" class="active">Width (px)</label>
                </div>

                <div class="input-field">
                        <input placeholder="ex) 200" id="first_name" type="number" min="1" class="validate" tabindex="2">
                        <label for="first_name" class="active">Height (px)</label>
                </div>

                <div class="input-field">
                        <input placeholder="ex) 08364d" id="first_name" type="text" class="validate" tabindex="2">
                        <label for="first_name" class="active">Color (hex)</label>
                </div>

                <div class="input-field">
                        <p class="range-field">
                                <input type="range" value="0" min="0" max="100" />
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