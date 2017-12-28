@extends('layouts.base')

@section('content')
        <ul class="tabs tab-demo z-depth-1">
                <li class="tab"><a href="#test5">Test 1</a></li>
                <li class="tab"><a class="active" href="#test6">Test 2</a></li>
                <li class="tab"><a href="#test7">Test 3</a></li>
                <li class="tab"><a href="#test8">Test 4</a></li>
                <li class="tab"><a href="#test8">Test 5</a></li>
                <li class="tab"><a href="#test8">Test 6</a></li>
                <li class="tab"><a href="#test8">Test 7</a></li>
                <li class="tab"><a href="#test8">Test 8</a></li>
        </ul>


<div id="box--image_viewer">
        <div class="row">
                <div class="col s12 m6">
                        <div class="card">
                                <div class="card-image">
                                        <img src="/image/generation?width=271&height=203" alt="">
                                        <button type="button" class="btn-floating halfway-fab waves-effect waves-light red" title="copy image path"><i class="material-icons">content_copy</i></button>
                                </div>
                                <div class="card-content">
                                        <span class="card-title">Image Path</span>
                                        <input type="text" readonly value="/image/generation?width=271&height=203">
                                </div>
                        </div>
                </div>
        </div>
</div>
<form action="/image/" method="POST" enctype="multipart/form-data">
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

        <div class="input-field col s6">
                <input placeholder="Placeholder" id="first_name" type="text" class="validate" tabindex="2">
                <label for="first_name" class="active">Service</label>
        </div>

        <div class="input-field col s6">
                <input placeholder="Placeholder" id="first_name" type="text" class="validate" tabindex="2">
                <label for="first_name" class="active">Prefix</label>
        </div>

        <div class="input-field col s12 m6">
                <div class="select-wrapper">
                        <span class="caret">▼</span>
                        <select class="initialized">
                                <option value="" disabled="" selected="">Choose Image Format</option>
                                <option value="png">png</option>
                                <option value="jpg">jpg</option>
                                <option value="gif">gif</option>
                        </select>
                </div>
                <label>Format</label>
        </div>

        <div class="input-field col s6">
                <input placeholder="Placeholder" id="first_name" type="text" class="validate" tabindex="2">
                <label for="first_name" class="active">Color</label>
        </div>

        <div class="input-field col s6">
                <input placeholder="Placeholder" id="first_name" type="number" class="validate" tabindex="2">
                <label for="first_name" class="active">Width</label>
        </div>

        <div class="input-field col s6">
                <input placeholder="Placeholder" id="first_name" type="number" class="validate" tabindex="2">
                <label for="first_name" class="active">Height</label>
        </div>
        {{--<div class="input-field col s6">--}}
                {{--<input id="last_name" type="text" tabindex="3">--}}
                {{--<label for="last_name" class="">Last Name</label>--}}
        {{--</div>--}}

        <div class="input-field col s12 m6">
                <p>Opacity</p>
        <p class="range-field">
                <input type="range" id="test5" min="0" max="100" />
        </p>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="action">Generate
                <i class="material-icons right">image</i>
        </button>
        <button class="btn waves-effect waves-light" type="button" name="action">Reset
                <i class="material-icons right">refresh</i>
        </button>
</form>
@endsection