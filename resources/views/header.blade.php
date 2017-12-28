<nav>
    <div class="nav-wrapper">
        <a href="{{ route('index') }}" class="brand-logo">UXE</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li class="active">
                <a href="{{ route('imageGenerate') }}">
                    <i class="material-icons left">image</i>
                    IMAGE
                </a>
            </li>
            <li>
                <a href="{{ route('fontMain') }}">
                    <i class="material-icons left">text_format</i>
                    FONT
                </a>
            </li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li class="active">
                <a href="{{ route('imageGenerate') }}">
                    <i class="material-icons left">image</i>
                    IMAGE
                </a>
            </li>
            <li>
                <a href="{{ route('fontMain') }}">
                    <i class="material-icons left">text_format</i>
                    FONT
                </a>
            </li>
        </ul>
    </div>
</nav>