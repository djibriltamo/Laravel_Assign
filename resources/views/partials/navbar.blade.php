<header class="flex justify-between items-center py-5">
    <div class="w-24 h-24">
        <a href="{{ route('jobs.index') }}"><img src="{{ asset('img/JOB.png') }}"></a>
    </div>
    <nav>
        <livewire:search />
        <a href="{{ route('jobs.index') }}" class="mr-5 hover:text-green-500">Nos missions</a>
        @guest
            <a href="{{ route('login') }}" class="mr-5 hover:text-green-500 ">Se connecter</a>
            <a href="{{ route('register') }}" class="mr-5 hover:text-green-500">S'inscrire</a>
        @else
            <a href="{{ route('conversations.index') }}" class="mr-5 hover:text-green-500">Mes conversations</a>

            <a href="{{ route('home') }}" class="mr-5 hover:text-green-500">
                Tableau de bord
                <span id="js-count">{{ auth()->user()->unreadNotifications->count() }}</span>
                
            </a>

            <a href="{{ route('logout') }}" class="hover:text-green-500" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se déconnecter</a>
            <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                @csrf
            </form>
        @endguest
    </nav>
</header>