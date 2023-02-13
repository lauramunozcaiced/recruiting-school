<div class="dashboard-header app__dashboard-header">
    @switch($title)
        @case('Applicants')
            <div class="guide-icon"><img src="{{ asset('/images/user.svg') }}" width="13"></div>
        @break
        
        @case('Preselections')
            <div class="guide-icon"><img src="{{ asset('/images/preselect.svg') }}" width="13"></div>
        @break

        @case('Statistics')
            <div class="guide-icon"><i class="fa fa-bar-chart text-white"></i></div>
        @break

        @case('Positions')
            <div class="guide-icon"><img src="{{ asset('/images/position.svg') }}" width="13"></div>
        @break

        @case('Clients')
            <div class="guide-icon"><i class="fa fa-building text-white"></i></div>
        @break

        @default
        <div class="guide-icon"><img src="{{ asset('/images/user.svg') }}" width="13"></div>
        @break
    @endswitch

    <h5>{{$title}}</h5>
    
</div>