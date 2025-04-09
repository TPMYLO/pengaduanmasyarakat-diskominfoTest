<div class="app-sidebar">
    <div class="logo">
        <a href="{{ $appset->url }}" class="logo-icon"><span class="logo-text">{{ $appset->name }}</span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="#">
                <img src="{{ asset('avatar.png') }}">
                <span class="user-info-text">{{ explode(' ', auth()->user()->name)[0] }}<br><span
                        class="user-state-info">Logged
                        as Admin</span></span>
            </a>
        </div>
    </div>

    <div class="app-menu">
        <ul class="accordion-menu">
            <x-dashboard.single-sidebar :routes="['dashboard']" label="Dashboard" icon="dashboard" />
        </ul>
        <div class="text-center d-flex justify-content-center p-3">
            <button type="button" class="btn btn-danger" style="width: 100%; margin: 0;"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="material-icons">logout</i>Keluar
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>
