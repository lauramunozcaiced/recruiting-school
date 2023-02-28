<div class="dashboard-header app__dashboard-header">
    @switch($title)
        @case('Applicants')
            <div class="guide-icon"><i class="ri-user-3-line text-white"></i></div>
        @break
        
        @case('Applicants Preselected')
            <div class="guide-icon"><i class="ri-user-follow-line text-white"></i></div>
        @break

        @case('Statistics')
            <div class="guide-icon"><i class="ri-bar-chart-grouped-line text-white"></i></div>
        @break

        @case('Positions')
            <div class="guide-icon"><i class="ri-briefcase-2-fill text-white"></i></div>
        @break

        @case('Clients')
            <div class="guide-icon"><i class="fa fa-building text-white"></i></div>
        @break

        @case('Messages')
            <div class="guide-icon"><i class="ri-mail-line text-white"></i></div>
        @break

        @default
        <div class="guide-icon"><i class="fa fa-bar-chart text-white"></i></div>
        @break
    @endswitch

    <h5>{{$title}}</h5>
    
</div>