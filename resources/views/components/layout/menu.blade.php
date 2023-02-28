<nav id="nav" class="navbar">
    <button id="button-expand"><i class="ri-arrow-left-s-line"></i></button>
    <div class="logo-container">
        <a class="navbar-brand d-flex align-items-center flex-wrap" href="{{ url('/') }}">
            <img class="logo" src="{{ asset('/images/logo-bgwhite.svg') }}" > 
            <img class="logotiny" src="{{ asset('/images/logotiny.svg') }}" >
        </a>
    </div>
    @auth
    <div class="main-user user-container">
        <div class="image__profile d-flex justify-content-center align-items-center" >
            <div @if (Auth::user()->logo != null) style="background-image: url('{{ asset( Auth::user()->logo) }}');" @else style="background-image: url('{{ asset('/images/default-user-image.jpg') }}');" @endif>
            </div>
            
        </div>
        <div>
            <p class="text-name" href="#">
                @if (Auth::user()->name != null) {{ Auth::user()->name }} @else  Welcome friend @endif</p>
                    <p class="text-role">{{ Auth::user()->role }}</p>
        </div>
    </div>
   
    <div class="main-menu menu-container">
        @if (Auth::user()->role != 'applicant')
                @if (Auth::user()->role != 'data entry')
                <a @if(Route::currentRouteName() =='applicants.index') class="route-selected" @endif href="{{ route('applicants.index') }}">
                    <i class="ri-user-3-line" style="margin-right: 15px;"></i>
                    <label>Applicants</label></a>
                @endif
                

                @if (Auth::user()->role != 'administrator' && Auth::user()->role != 'customer' && Auth::user()->role != 'data entry')
                    <a class="" href="{{ route('preselections.index') }}">
                        <i class="ri-user-follow-line" style="margin-right: 15px;"></i>
                        <label>Preselected</label></a>
                @endif
                @if (Auth::user()->role == 'administrator')
                    <a @if(Route::currentRouteName() =='users.index') class="route-selected" @endif href="{{ route('users.index') }}"><img src="{{ asset('/images/user.svg') }}" width="14"><label>Users</label></a>
                    <a @if(Route::currentRouteName() =='customers.index') class="route-selected" @endif href="{{ route('customers.index') }}"><i
                            class="fa fa-building text-white" style="margin-right: 15px;"></i><label>Clients</label></a>
                @endif
                <a @if(Route::currentRouteName() =='positions.index') class="route-selected" @endif  href="{{ route('positions.index') }}" >
                    <i class="ri-briefcase-2-fill" style="margin-right: 15px;"></i>
                    <label>Positions</label></a>
                <a @if(Route::currentRouteName() =='stats.index') class="route-selected" @endif  href="{{ route('stats.index') }}" >
                    <i class="ri-bar-chart-grouped-line" style="margin-right: 15px;"></i>
                <label>Statistics</label></a>
                
                @if(true)
                <a @if(Route::currentRouteName() =='messages.index') class="route-selected" @endif  href="{{ route('messages.index','inbox') }}" >
                <i class="ri-mail-line" style="margin-right: 15px;"></i>
                <label>Messages</label></a>
                @endif
            @endif
            
    </div>
    
    <div class="logout-container">
        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
            <i class="ri-logout-box-r-line" style="margin-right: 15px;"></i>
               <label>{{ __('Logout') }}</label>
        </a>

       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
           @csrf
           </form>
       </div>
    @endauth
    
    
</nav>
