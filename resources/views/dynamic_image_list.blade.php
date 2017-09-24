<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('public/frameworks/semantic-ui/semantic.rtl.css') }}">
        <link rel="stylesheet" href="{{ asset('public/frameworks/semantic-ui/components/grid.rtl.css') }}">
        <link rel="stylesheet" href="{{ asset('public/frameworks/semantic-ui/components/input.rtl.css') }}">

        <title>Laravel</title>
    </head>
    <body>

    {{--<div class="ui two column stackable grid">--}}
        {{--<div class="column">--}}

            {{--<div class="ui action left icon input">--}}
                {{--<i class="search icon"></i>--}}
                {{--<input type="text" placeholder="Search...">--}}
                {{--<div class="ui teal button">Search</div>--}}
            {{--</div>--}}

            {{--<div class="ui divider"></div>--}}
            {{--<div class="ui input error">--}}
                {{--<input placeholder="Search..." type="text">--}}
            {{--</div>--}}
            {{--<div class="ui divider"></div>--}}

            {{--<div class="ui right labeled input">--}}
                {{--<input placeholder="Placeholder" type="text">--}}
                {{--<div class="ui dropdown label" tabindex="0">--}}
                    {{--<div class="text">Dropdown</div>--}}
                    {{--<i class="dropdown icon"></i>--}}
                    {{--<div class="menu" tabindex="-1">--}}
                        {{--<div class="item">Choice 1</div>--}}
                        {{--<div class="item">Choice 2</div>--}}
                        {{--<div class="item">Choice 3</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="ui divider"></div>--}}

            {{--<div class="ui transparent icon input">--}}
                {{--<input placeholder="Search..." type="text">--}}
                {{--<i class="search icon"></i>--}}
            {{--</div>--}}
            {{--<div class="ui transparent left icon input">--}}
                {{--<input placeholder="Search..." type="text">--}}
                {{--<i class="search icon"></i>--}}
            {{--</div>--}}
            {{--<div class="ui divider"></div>--}}
            {{--<div class="ui left icon input loading">--}}
                {{--<input placeholder="Loading..." type="text">--}}
                {{--<i class="search icon"></i>--}}
            {{--</div>--}}

            {{--<div class="ui icon input loading">--}}
                {{--<input placeholder="Loading..." type="text">--}}
                {{--<i class="search icon"></i>--}}
            {{--</div>--}}

        {{--</div>--}}

    {{--</div>--}}

    <a href="{{ url('/image/make',['?width=115&height=301&service=common']) }}" target="_blank">image generate</a>
        @forelse($data as $item)
            {{ $item['type'] }}
        @empty

        @endforelse
    </body>

    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/frameworks/semantic-ui/semantic.js') }}"></script>
</html>