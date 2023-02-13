@foreach ($applicants as $applicant)
    @switch(Auth::user()->role)
        @case('recruiter')
            @if ($applicant->visible == 'active')
                <x-applicants.card :positions="$positions" :users="$users" :applicant="$applicant" />
            @endif
        @break

        @case('customer')
            @php $showApplicant = false; @endphp
            
            @if(isset($applicant->preselections[0]) && $applicant->visible == 'active')
                @if($applicant->preselections[0]->user_id == Auth::user()->id)
                    @php $showApplicant = true; @endphp
                @endif
            @else
                @if(isset($applicant->matches[0]) && $applicant->visible == 'active')
                    @foreach ($applicant->matches as $match)
                        @if($match->position->user->id == Auth::user()->id)
                            @php $showApplicant = true; @endphp
                            @break
                        @endif
                    @endforeach
                @endif
            @endif

            @if ($showApplicant == true)
                <x-applicants.card @else active=" " @endif :positions="$positions" :users="$users"
                :applicant="$applicant" url="{{ $url }}"/>
            @endif

        @break

        @case('administrator')
            <x-applicants.list :positions="$positions" :users="$users" :applicant="$applicant" url="{{ $url }}" />
        @break

        @default
            @if (Route::currentRouteName() == 'applicants.index' || Route::currentRouteName() == 'applicants.search' || Route::currentRouteName() == 'applicants.show')
                <x-applicants.card :positions="$positions" :users="$users" :applicant="$applicant" />
            @else
                @if($applicant->visible != 'inactive')
                    <x-applicants.card :positions="$positions" :users="$users" :applicant="$applicant" />
                @endif
            @endif
        @break
    @endswitch
@endforeach

