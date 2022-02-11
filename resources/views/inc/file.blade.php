<!-- Authentication Links -->
@guest
@if (Route::has('login'))
<li><a class="text-white" href="{{ route('login') }}">{{ __('Login') }}</a></li>
@endif
@else
@if (Auth::user()->is_admin)
<li><a class="text-white" href="{{ route('admin.index') }}">В админку</a></li>
@endif
<li>
    <a class="text-white" href="{{ route('logout') }}"
        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</li>
@endguest
