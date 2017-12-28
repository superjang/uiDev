@extends('layouts.base')

@section('content')
        <ul class="tabs tab-demo z-depth-1">
                <li class="tab"><a target="_self" href="{{ route('imageGenerate') }}">Generate</a></li>
                <li class="tab"><a target="_self" class="active" href="{{ route('imageUpload') }}">Upload</a></li>
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
                                        <img src="/public/images/uploads/homeshopping/20171227101436176676_0_0.jpg" alt="">
                                        <button type="button" class="btn-floating halfway-fab waves-effect waves-light red" title="copy image path"><i class="material-icons">content_copy</i></button>
                                </div>
                                <div class="card-content">
                                        <span class="card-title">IMAGE PATH</span>
                                        <input type="text" readonly value="/public/images/uploads/homeshopping/20171227101436176676_0_0.jpg">
                                </div>
                        </div>
                </div>
        </div>
</div>

<div class="layout col2">

        <h5 class="layout_title light">
                <i class="material-icons left">cloud_upload</i>
                IMAGE UPLOAD
        </h5>

        <form action="{{ route('imageMake') }}" method="POST" enctype="multipart/form-data">
                {!! ! csrf_field() !!}

                <div class="input-field">
                        <input placeholder="ex) smiledelivery" type="text" class="validate" value="@isset($data->service) {{ $data->service }} @endisset">
                        <label for="first_name" class="active">Service (directory name)</label>
                </div>

                <div class="input-field">
                        <input placeholder="ex) corner_best" type="text" class="validate" value="@isset($data->prefix) {{ $data->prefix }} @endisset">
                        <label for="first_name" class="active">Prefix (file name prefix)</label>
                </div>

                <div class="input-field">
                        <div class="file-field input-field">
                                <div class="btn">
                                        <span>File</span>
                                        <input type="file">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>
                        <label for="first_name" class="active">Upload File</label>
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