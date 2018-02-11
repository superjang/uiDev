@extends('layouts.base')

@section('content')
    <ul class="tabs tab-demo z-depth-1">
        <li class="tab"><a target="_self" class="active" href="{{ route('font.collection') }}">LIST</a></li>
        <li class="tab"><a target="_self" href="{{ route('font.collection') }}">UPLOAD</a></li>
    </ul>
    <div class="row font_helper">
        <div class="col s12">
            <h5 class="header light">
                {{--<i class="material-icons left">text_format</i>--}}
                FONTS VIEWER
            </h5>
            <ul class="font_list">
                <li>
                    <div class="col s12 m4">
                        {{--card blue-grey darken-1--}}
                        <div class="card">

                            <div class="card-action pink-text text-lighten-1 card-header">
                                <span class="card-title">NotoSansKR-DemiLight</span>
                            </div>
                            <div class="card-action card-option">
                                {{--<a href="#">This is a link</a>--}}
                                {{--<a href="#">This is a link</a>--}}

                                <div class="input-field">
                                    <p class="range-field">
                                        <input type="range" value="12" min="0" max="100" name="opacity"></span>
                                    </p>
                                    <label for="first_name" class="active">Font Size</label>
                                </div>

                                <div class="input-field">
                                    <div class="select-wrapper">
                                        <div class="select-wrapper initialized"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" value=""><ul id="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" class="dropdown-content select-dropdown "><li class=""><span>png</span></li><li class=""><span>jpg</span></li><li class=""><span>gif</span></li></ul><select class="initialized" name="type" data-select-id="2b131487-cffc-6986-d5e0-500b72c6ced0">
                                                <option value="gif">normal</option>
                                                <option value="gif">italic</option>
                                            </select></div>
                                    </div>
                                    <label>Font Style</label>
                                </div>
                                <div class="input-field">
                                    <div class="select-wrapper">
                                        <div class="select-wrapper initialized"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" value=""><ul id="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" class="dropdown-content select-dropdown "><li class=""><span>png</span></li><li class=""><span>jpg</span></li><li class=""><span>gif</span></li></ul><select class="initialized" name="type" data-select-id="2b131487-cffc-6986-d5e0-500b72c6ced0">
                                                <optgroup label="String">
                                                    <option value="gif" selected="selected">normal</option>
                                                    <option value="gif">bold</option>
                                                    <option value="gif">bolder</option>
                                                    <option value="gif">lighter</option>
                                                </optgroup>
                                                <optgroup label="Number">
                                                    <option value="png">100</option>
                                                    <option value="jpg">200</option>
                                                    <option value="gif">300</option>
                                                    <option value="gif">400</option>
                                                    <option value="gif">500</option>
                                                    <option value="gif">600</option>
                                                    <option value="gif">700</option>
                                                    <option value="gif">800</option>
                                                    <option value="gif">900</option>
                                                </optgroup>
                                            </select></div>
                                    </div>
                                    <label>Font Weight</label>
                                </div>
                            </div>
                            <div class="card-content grey-text text-darken-4 card-text_view" style="font-size:30px;">
                                {{--<span class="card-title">Card Title</span>--}}
                                <p>ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
                                <p>1234567890</p>
                                <p>가나다라마바사아자차카타파하</p>
                                <p>~!@#$%^&*()_+</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="col s12 m4">
                        {{--card blue-grey darken-1--}}
                        <div class="card">

                            <div class="card-action pink-text text-lighten-1 card-header">
                                <span class="card-title">NotoSansKR-Medium</span>
                            </div>
                            <div class="card-action card-option">
                                {{--<a href="#">This is a link</a>--}}
                                {{--<a href="#">This is a link</a>--}}

                                <div class="input-field">
                                    <p class="range-field">
                                        <input type="range" value="12" min="0" max="100" name="opacity"></span>
                                    </p>
                                    <label for="first_name" class="active">Font Size</label>
                                </div>

                                <div class="input-field">
                                    <div class="select-wrapper">
                                        <div class="select-wrapper initialized"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" value=""><ul id="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" class="dropdown-content select-dropdown "><li class=""><span>png</span></li><li class=""><span>jpg</span></li><li class=""><span>gif</span></li></ul><select class="initialized" name="type" data-select-id="2b131487-cffc-6986-d5e0-500b72c6ced0">
                                                <option value="gif">normal</option>
                                                <option value="gif">italic</option>
                                            </select></div>
                                    </div>
                                    <label>Font Style</label>
                                </div>
                                <div class="input-field">
                                    <div class="select-wrapper">
                                        <div class="select-wrapper initialized"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" value=""><ul id="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" class="dropdown-content select-dropdown "><li class=""><span>png</span></li><li class=""><span>jpg</span></li><li class=""><span>gif</span></li></ul><select class="initialized" name="type" data-select-id="2b131487-cffc-6986-d5e0-500b72c6ced0">
                                                <optgroup label="String">
                                                    <option value="gif" selected="selected">normal</option>
                                                    <option value="gif">bold</option>
                                                    <option value="gif">bolder</option>
                                                    <option value="gif">lighter</option>
                                                </optgroup>
                                                <optgroup label="Number">
                                                    <option value="png">100</option>
                                                    <option value="jpg">200</option>
                                                    <option value="gif">300</option>
                                                    <option value="gif">400</option>
                                                    <option value="gif">500</option>
                                                    <option value="gif">600</option>
                                                    <option value="gif">700</option>
                                                    <option value="gif">800</option>
                                                    <option value="gif">900</option>
                                                </optgroup>
                                            </select></div>
                                    </div>
                                    <label>Font Weight</label>
                                </div>
                            </div>
                            <div class="card-content grey-text text-darken-4 card-text_view" style="font-size:11px;">
                                {{--<span class="card-title">Card Title</span>--}}
                                <p>ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
                                <p>1234567890</p>
                                <p>가나다라마바사아자차카타파하</p>
                                <p>~!@#$%^&*()_+</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="col s12 m4">
                        {{--card blue-grey darken-1--}}
                        <div class="card">

                            <div class="card-action pink-text text-lighten-1 card-header">
                                <span class="card-title">Roboto</span>
                            </div>
                            <div class="card-action card-option">
                                {{--<a href="#">This is a link</a>--}}
                                {{--<a href="#">This is a link</a>--}}

                                <div class="input-field">
                                    <p class="range-field">
                                        <input type="range" value="12" min="0" max="100" name="opacity"></span>
                                    </p>
                                    <label for="first_name" class="active">Font Size</label>
                                </div>

                                <div class="input-field">
                                    <div class="select-wrapper">
                                        <div class="select-wrapper initialized"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" value=""><ul id="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" class="dropdown-content select-dropdown "><li class=""><span>png</span></li><li class=""><span>jpg</span></li><li class=""><span>gif</span></li></ul><select class="initialized" name="type" data-select-id="2b131487-cffc-6986-d5e0-500b72c6ced0">
                                                <option value="gif">normal</option>
                                                <option value="gif">italic</option>
                                            </select></div>
                                    </div>
                                    <label>Font Style</label>
                                </div>
                                <div class="input-field">
                                    <div class="select-wrapper">
                                        <div class="select-wrapper initialized"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" value=""><ul id="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" class="dropdown-content select-dropdown "><li class=""><span>png</span></li><li class=""><span>jpg</span></li><li class=""><span>gif</span></li></ul><select class="initialized" name="type" data-select-id="2b131487-cffc-6986-d5e0-500b72c6ced0">
                                                <optgroup label="String">
                                                    <option value="gif" selected="selected">normal</option>
                                                    <option value="gif">bold</option>
                                                    <option value="gif">bolder</option>
                                                    <option value="gif">lighter</option>
                                                </optgroup>
                                                <optgroup label="Number">
                                                    <option value="png">100</option>
                                                    <option value="jpg">200</option>
                                                    <option value="gif">300</option>
                                                    <option value="gif">400</option>
                                                    <option value="gif">500</option>
                                                    <option value="gif">600</option>
                                                    <option value="gif">700</option>
                                                    <option value="gif">800</option>
                                                    <option value="gif">900</option>
                                                </optgroup>
                                            </select></div>
                                    </div>
                                    <label>Font Weight</label>
                                </div>
                            </div>
                            <div class="card-content grey-text text-darken-4 card-text_view">
                                {{--<span class="card-title">Card Title</span>--}}
                                <p>ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
                                <p>1234567890</p>
                                <p>가나다라마바사아자차카타파하</p>
                                <p>~!@#$%^&*()_+</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="col s12 m4">
                        {{--card blue-grey darken-1--}}
                        <div class="card">

                            <div class="card-action pink-text text-lighten-1 card-header">
                                <span class="card-title">Noto Sans Korean</span>
                            </div>
                            <div class="card-action card-option">
                                {{--<a href="#">This is a link</a>--}}
                                {{--<a href="#">This is a link</a>--}}

                                <div class="input-field">
                                    <p class="range-field">
                                        <input type="range" value="12" min="0" max="100" name="opacity"></span>
                                    </p>
                                    <label for="first_name" class="active">Font Size</label>
                                </div>

                                <div class="input-field">
                                    <div class="select-wrapper">
                                        <div class="select-wrapper initialized"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" value=""><ul id="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" class="dropdown-content select-dropdown "><li class=""><span>png</span></li><li class=""><span>jpg</span></li><li class=""><span>gif</span></li></ul><select class="initialized" name="type" data-select-id="2b131487-cffc-6986-d5e0-500b72c6ced0">
                                                <option value="gif">normal</option>
                                                <option value="gif">italic</option>
                                            </select></div>
                                    </div>
                                    <label>Font Style</label>
                                </div>
                                <div class="input-field">
                                    <div class="select-wrapper">
                                        <div class="select-wrapper initialized"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" value=""><ul id="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" class="dropdown-content select-dropdown "><li class=""><span>png</span></li><li class=""><span>jpg</span></li><li class=""><span>gif</span></li></ul><select class="initialized" name="type" data-select-id="2b131487-cffc-6986-d5e0-500b72c6ced0">
                                                <optgroup label="String">
                                                    <option value="gif" selected="selected">normal</option>
                                                    <option value="gif">bold</option>
                                                    <option value="gif">bolder</option>
                                                    <option value="gif">lighter</option>
                                                </optgroup>
                                                <optgroup label="Number">
                                                    <option value="png">100</option>
                                                    <option value="jpg">200</option>
                                                    <option value="gif">300</option>
                                                    <option value="gif">400</option>
                                                    <option value="gif">500</option>
                                                    <option value="gif">600</option>
                                                    <option value="gif">700</option>
                                                    <option value="gif">800</option>
                                                    <option value="gif">900</option>
                                                </optgroup>
                                            </select></div>
                                    </div>
                                    <label>Font Weight</label>
                                </div>
                            </div>
                            <div class="card-content grey-text text-darken-4 card-text_view">
                                {{--<span class="card-title">Card Title</span>--}}
                                <p>ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
                                <p>1234567890</p>
                                <p>가나다라마바사아자차카타파하</p>
                                <p>~!@#$%^&*()_+</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="col s12 m4">
                        {{--card blue-grey darken-1--}}
                        <div class="card">

                            <div class="card-action pink-text text-lighten-1 card-header">
                                <span class="card-title">Noto Sans Korean</span>
                            </div>
                            <div class="card-action card-option">
                                {{--<a href="#">This is a link</a>--}}
                                {{--<a href="#">This is a link</a>--}}

                                <div class="input-field">
                                    <p class="range-field">
                                        <input type="range" value="12" min="0" max="100" name="opacity"></span>
                                    </p>
                                    <label for="first_name" class="active">Font Size</label>
                                </div>

                                <div class="input-field">
                                    <div class="select-wrapper">
                                        <div class="select-wrapper initialized"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" value=""><ul id="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" class="dropdown-content select-dropdown "><li class=""><span>png</span></li><li class=""><span>jpg</span></li><li class=""><span>gif</span></li></ul><select class="initialized" name="type" data-select-id="2b131487-cffc-6986-d5e0-500b72c6ced0">
                                                <option value="gif">normal</option>
                                                <option value="gif">italic</option>
                                            </select></div>
                                    </div>
                                    <label>Font Style</label>
                                </div>
                                <div class="input-field">
                                    <div class="select-wrapper">
                                        <div class="select-wrapper initialized"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" value=""><ul id="select-options-2b131487-cffc-6986-d5e0-500b72c6ced0" class="dropdown-content select-dropdown "><li class=""><span>png</span></li><li class=""><span>jpg</span></li><li class=""><span>gif</span></li></ul><select class="initialized" name="type" data-select-id="2b131487-cffc-6986-d5e0-500b72c6ced0">
                                                <optgroup label="String">
                                                    <option value="gif" selected="selected">normal</option>
                                                    <option value="gif">bold</option>
                                                    <option value="gif">bolder</option>
                                                    <option value="gif">lighter</option>
                                                </optgroup>
                                                <optgroup label="Number">
                                                    <option value="png">100</option>
                                                    <option value="jpg">200</option>
                                                    <option value="gif">300</option>
                                                    <option value="gif">400</option>
                                                    <option value="gif">500</option>
                                                    <option value="gif">600</option>
                                                    <option value="gif">700</option>
                                                    <option value="gif">800</option>
                                                    <option value="gif">900</option>
                                                </optgroup>
                                            </select></div>
                                    </div>
                                    <label>Font Weight</label>
                                </div>
                            </div>
                            <div class="card-content grey-text text-darken-4 card-text_view">
                                {{--<span class="card-title">Card Title</span>--}}
                                <p>ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
                                <p>1234567890</p>
                                <p>가나다라마바사아자차카타파하</p>
                                <p>~!@#$%^&*()_+</p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>


@endsection