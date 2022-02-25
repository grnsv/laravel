<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">О сайте</h4>
                    <p class="text-muted navbar-text">Добро пожаловать на сайт о новостях со всех концов света</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Меню</h4>
                    <nav class="navbar-dark navbar-expand-md">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{ route('index') }}" class="nav-link">Главная</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('news.index') }}" class="nav-link">Новости</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('feedbacks.index') }}" class="nav-link">Отзывы</a>
                            </li>
                            @include('inc.file')
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center">
                <strong>{{ config('app.name', 'Laravel') }}</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>
