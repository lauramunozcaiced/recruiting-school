@if (Route::currentRouteName() == 'applicants.index' || Route::currentRouteName() == 'applicants.search' || Route::currentRouteName() == 'applicants.show')
    @if (Auth::user()->role == 'supervisor' || Auth::user()->role == 'recruiter')
        <div class="card-applicant__match ml-2 d-flex">
            @php
                $delete = false;
                $positionsmatch = 0;
            @endphp
            @foreach ($applicant->matches as $match)
                @if ($match->user->id == Auth::user()->id)
                    @php
                        $delete = true;
                        $positionsmatch++;
                    @endphp
                @endif
            @endforeach
            @if ($positionsmatch < count($positions) && $applicant->visible == 'active')
                <button type="button" class="btn bg-solvoblue text-white rounded-0"
                    @if ($modal) data-target="#doMatchCard{{ $applicant->id }}Modal"
                    @else data-target="#doMatchCard{{ $applicant->id }}" @endif data-toggle="modal">Match</button>
                @if ($delete == true)
                    <button type="button"
                        class="btn bg-solvoblue rounded-0 text-white delete border-top-0 border-bottom-0 border-right-0 border-light "
                        data-target="#deleteMatchCard{{ $applicant->id }}"
                        data-toggle="modal">{{ count($applicant->matches) }}</button>
                @else
                    <button type="button"
                        class="btn bg-solvoblue rounded-0 text-white delete border-top-0 border-bottom-0 border-right-0 border-light"
                        disabled>{{ count($applicant->matches) }}</button>
                @endif

                <div @if ($modal) id="doMatchCard{{ $applicant->id }}Modal"@else id="doMatchCard{{ $applicant->id }}" @endif
                    class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="doMatchCard{{ $applicant->id }}Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn close"data-dismiss="modal"
                                    aria-label="Close">&times;</button>
                                <x-applicants.matchForm :positions="$positions" :applicant="$applicant" />
                            </div>
                        </div>
                    </div>
                </div>
                
            @elseif($positionsmatch >= count($positions) && $applicant->visible == 'active')
                <button type="button" class="btn btn-secondary rounded-0" disabled
                    title="No more active positions to match">Match</button>
                <button type="button"
                    class="btn btn-secondary rounded-0 delete border-top-0 border-bottom-0 border-right-0 border-light"
                    data-target="#deleteMatchCard{{ $applicant->id }}"
                    data-toggle="modal">{{ count($applicant->matches) }}</button>
            @endif
            @if ($delete == true)
                <div class="modal fade" id="deleteMatchCard{{ $applicant->id }}" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn close"data-dismiss="modal"
                                    aria-label="Close">&times;</button>
                                <x-applicants.matchDelete :applicant="$applicant" />
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    @endif
@endif
