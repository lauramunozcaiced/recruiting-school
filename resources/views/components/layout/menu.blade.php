<nav id="nav" class="navbar">
    <button id="button-expand"><img src="{{ asset('/images/expand.svg') }}"></button>
    <div class="logo-container">
        <a class="navbar-brand d-flex align-items-center flex-wrap" href="{{ url('/') }}">
            <img class="logo" src="{{ asset('/images/logo.svg') }}" width="160"> 
            <img class="logotiny" src="{{ asset('/images/logotiny.svg') }}" width="40">
        </a>
    </div>
    @auth
    <div class="main-user user-container">
        <div class="image__profile d-flex justify-content-center align-items-center" @if (Auth::user()->role == 'customer') style="background-image: url('{{ asset( Auth::user()->logo) }}'); border: 2px solid transparent; border-style: inset; background-color: white;" @else style="background-color: white;" @endif>
            @if (Auth::user()->role != 'customer')
                <label>@if (Auth::user()->name != null) {{ Auth::user()->name[0] }} @else  W @endif</label>
            @endif
        </div>
        <div>
            <p class="text-name text-white" href="#">
                @if (Auth::user()->name != null) {{ Auth::user()->name }} @else  Welcome friend @endif</p>
                    <p class="text-role text-white">{{ Auth::user()->role }}</p>
        </div>
    </div>
   
    <div class="main-menu menu-container">
        @if (Auth::user()->role != 'applicant')
                @if (Auth::user()->role != 'data entry')
                <a @if(Route::currentRouteName() =='applicants.index') class="route-selected" @endif href="{{ route('applicants.index') }}">
                    <img src="{{ asset('/images/user.svg') }}" width="14">
                    <label>Applicants</label></a>
                @endif

                @if (Auth::user()->role != 'administrator' && Auth::user()->role != 'customer' && Auth::user()->role != 'data entry')
                    <a class="" href="{{ route('preselections.index') }}">
                        <img src="{{ asset('/images/preselect.svg') }}" width="14">
                        <label>Preselected</label></a>
                @endif
                @if (Auth::user()->role == 'administrator')
                    <a @if(Route::currentRouteName() =='users.index') class="route-selected" @endif href="{{ route('users.index') }}"><img src="{{ asset('/images/user.svg') }}" width="14"><label>Users</label></a>
                    <a @if(Route::currentRouteName() =='customers.index') class="route-selected" @endif href="{{ route('customers.index') }}"><i
                            class="fa fa-building text-white" style="margin-right: 15px;"></i><label>Clients</label></a>
                @endif
                <a @if(Route::currentRouteName() =='positions.index') class="route-selected" @endif  href="{{ route('positions.index') }}" >
                    <img src="{{ asset('/images/position.svg') }}" width="14">
                    <label>Positions</label></a>
                <a @if(Route::currentRouteName() =='stats.index') class="route-selected" @endif  href="{{ route('stats.index') }}" >
                    <i class="fa fa-bar-chart text-white" style="margin-right: 15px;"></i>
                <label>Statistics</label></a>
                
                @if(false)
                <a @if(Route::currentRouteName() =='messages.index') class="route-selected" @endif  href="{{ route('messages.index') }}" >
                <i class="fa fa-envelope text-white" style="margin-right: 15px;"></i>
                <label>Messages</label></a>
                @endif
            @endif
            
    </div>
    
    
    @endauth
    <div class="logout-container">
        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
               <img src="{{ asset('/images/logout.svg') }}" width="14">
               <label>{{ __('Logout') }}</label>
        </a>

       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
           @csrf
           </form>
       </div>
    
</nav>
