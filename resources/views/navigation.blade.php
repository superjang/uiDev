<nav>
    <div class="nav-wrapper">
        <a href="{{ route('index') }}" class="brand-logo">UXE</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{ route('imageMain') }}">Image</a></li>
            <li><a href="{{ route('fontMain') }}">Font</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="{{ route('imageMain') }}">Image</a></li>
            <li><a href="{{ route('fontMain') }}">Font</a></li>
        </ul>
    </div>
</nav>