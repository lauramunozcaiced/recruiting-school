
@if (Route::currentRouteName() == 'applicants.index' || Route::currentRouteName() == 'applicants.search' || Route::currentRouteName() == 'applicants.show')
    <div class="pt-2 d-flex">
        @if (Auth::user()->role != 'customer')
            <div class="card-applicant__advice pt-2">
                @if (count($applicant->preselections) > 0)
                    <div class="rounded-0" style="padding: .1rem .2rem; background-color: #F8DA1A;  "><small
                            style="font-weight: 600">Preselection Process</small></div>
                @else
                    <div style="padding: .1rem .2rem; visibility: hidden; "><small style="font-weight: 600">No
                            Preselection</small></div>
                @endif
            </div>
        @endif
    </div>

@elseif(Route::currentRouteName() == 'preselections.index' || Route::currentRouteName() == 'preselections.search')
    <div>
        @foreach ($applicant->preselections as $preselection)
            <p class="pt-3">Preselected for <strong>{{ $preselection->position->name }}</strong> by
                <strong>{{ $preselection->position->user->name }}</strong></p>
        @endforeach
    </div>
@endif
