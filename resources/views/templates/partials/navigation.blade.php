<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">VKroke</a>
        </div>
        <div class="collapse navbar-collapse">
            @if (Auth::check()) 
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home') }}">Timeline</a></li>
                <li><a href="{{ route('friend.index') }}">Друзья</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search" action="{{ route('search.results') }}">
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="Найти человека">
                </div>
                <button type="submit" class="btn btn-primary">Поиск</button>
            </form>
            @endif 
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check()) 
                <li><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">{{ Auth::user()->getNameOrUsername() }}</a></li>
                <li><a href="{{ route('profile.edit') }}">Настройки</a></li>
                <li><a href="{{ route('auth.signout') }}">Выйти</a></li>
                @else 
                <li><a href="{{ route('auth.signup') }}">Зарегистрироваться</a></li>
                <li><a href="{{ route('auth.signin') }}">Войти в систему</a></li>
                @endif 
            </ul>
        </div>
    </div>
</nav>
      