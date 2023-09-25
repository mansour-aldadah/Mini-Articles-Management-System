<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Auth::user())
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('articles.index') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.create') }}">{{ __('Create Article') }}</a>
                    </li>
                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('admin.articles.index') }}">{{ __('Manage Articles') }}</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ __('Language') }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>

            @if ($current == 'manage')
                <form action="{{ route('admin.articles.index') }}" method="get">
                    <div class="input-group w-100 mx-auto">
                        <input type="text" class="form-control" placeholder="Search" name="search"
                            value="{{ request('search') }}" aria-label="Search" aria-describedby="search">
                        <button class="btn btn-outline-primary" type="submit" id="search">Search</button>
                    </div>
                </form>
            @elseif($current == 'home')
                <form action="{{ route('home') }}" method="get">
                    <div class="input-group  w-100 mx-auto">
                        <input type="text" class="form-control" placeholder="Search" name="search"
                            value="{{ request('search') }}" aria-label="Search" aria-describedby="search">
                        <button class="btn btn-outline-primary" type="submit" id="search">Search</button>
                    </div>
                </form>
            @elseif($current == 'own')
                <form action="{{ route('articles.index') }}" method="get">
                    <div class="input-group w-100 mx-auto">
                        <input type="text" class="form-control" placeholder="Search" name="search"
                            value="{{ request('search') }}" aria-label="Search" aria-describedby="search">
                        <button class="btn btn-outline-primary" type="submit" id="search">Search</button>
                    </div>
                </form>
            @endif
            @if (Auth::user())
                <div class="ms-5">
                    {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                </div>
            @endif
            @if (Auth::user())
                <form action="{{ route('auth.logout') }}" method="get">
                    <button type="submit" class="btn ms-2 btn-sm btn-primary">Logout</button>
                </form>
            @elseif(!Auth::user() && url()->current() != 'http://localhost:8000/auth/login')
                <form action="{{ route('auth.login') }}" method="get">
                    <button type="submit" class="btn btn-sm ms-2 btn-primary">Login</button>
                </form>
            @endif

        </div>
    </div>
</nav>
