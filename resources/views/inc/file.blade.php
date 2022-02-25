<!-- Authentication Links -->
@guest
@if (Route::has('login'))
<li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
</li>
@endif
@else
@if (Auth::user()->is_admin)
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.index') }}">В админку</a>
</li>
@endif
<li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</li>
@endguest
