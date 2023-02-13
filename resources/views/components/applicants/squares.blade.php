<div class="card card-{{ $applicant->id }} card-applicant">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8 column">
                <div class="card-applicant__personal">
                    <h4 class="applicants-name">{{ $applicant->firstname }} {{ $applicant->lastname }}</h4>
                    <p class="applicants-title">{{ $applicant->title }}</p>
                </div>
                <div class="card-applicant__experience mt-2">
                    <h6>Last Experience</h6>
                    @if(isset($applicant->experiences[0]))
                    <div class="d-flex">
                        <p>{{ ucwords(strtolower($applicant->experiences[0]->position)) }} - </p>
                        <p>{{ ucwords(strtolower($applicant->experiences[0]->company)) }}</p>
                    </div>
                    <small><b>Since:</b> {{ $applicant->experiences[0]->start_date }} <b>To:</b>
                        {{ $applicant->experiences[0]->end_date }}</small>
                    @else
                        <small>The applicant has not completed his profile.</small>
                    @endif
                </div>
                <div class="card-applicant__experience mt-2">
                    <h6>Last Education</h6>
                    @if(isset($applicant->studies[0]))
                    <div>
                        <p>{{ ucwords(strtolower($applicant->studies[0]->title)) }}</p>
                        <p>{{$applicant->studies[0]->school}}</p>
                    </div>
                    @else
                        <small>The applicant has not completed his profile.</small>
                    @endif
                </div>
                <div class="card-applicant__social-buttons mt-3">
                    <div>
                        @if (Auth::user()->role != 'customer')
                            <a href="https://linkedin.com/in/{{ $applicant->linkedin }}"
                                class="btn bg-indigo text-white" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <a href="{{ $applicant->portfolio }}" class="btn btn-primary" target="_blank"><i
                                    class="fa fa-briefcase"></i></a>
                            <a href="tel:{{ $applicant->phone }}" class="btn btn-success"><i
                                    class="fa fa-phone"></i></a>
                        @endif

                        <a href="{{ $applicant->video }}" class="btn btn-danger" target="_blank"><i
                                class="fa fa-youtube"></i></a>
                    </div>
                    <a href="{{ asset($applicant->cv) }}" class="btn btn-primary notrounded"
                        target="_blank">Full Profile</a>
                </div>
                <div class="mt-3">
                    <h6>Evaluation</h6>
                    <x-applicants.components.evaluation :applicant="$applicant" view="squares">
                    </x-applicants.components.evaluation>
                </div>


            </div>
            <div class="col-lg-4 column bg-gray d-flex flex-column justify-content-between">
                <div>
                    <div class="card-applicant__image">
                        <div class="card-applicant__image-avatar"
                            style="background-image: url('{{ asset( $applicant->image) }}');"></div>
                    </div>
                    <x-applicants.components.advices :applicant="$applicant" url="$url">
                    </x-applicants.components.advices>
                    <div class="card-applicant__initial">
                        <x-applicants.components.activation :applicant="$applicant" view="squares">
                            </x-applicants-components.activation>
                    </div>
                </div>
                <div>
                    <div class="card-applicant__matches d-flex justify-content-center">
                        @if (Auth::user()->role == 'customer')
                            <button type="button" class="btn btn-primary"
                                data-target="#seemyMatch{{ $applicant->id }}" data-toggle="modal">Matches</button>

                            <div class="modal fade" id="seemyMatch{{ $applicant->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Matches</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($applicant->matches as $match)
                                                @if ($match->position->user->id == Auth::user()->id)
                                                    <div class="d-flex justify-content-between pt-2 pb-3">
                                                        <div>
                                                            <h6><strong>Position: </strong></h6>
                                                            <p>{{ $match->position->name }}</p>
                                                        </div>
                                                        <div>
                                                            <h6><strong>Recruiter: </strong></h6>
                                                            <p>{{ $match->user->name }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    <x-applicants.components.match :applicant="$applicant" :positions="$positions"
                        url="{{ $url }}" view="squares"></x-applicants.components.match>
                    <x-applicants.components.preselect :applicant="$applicant" :positions="$positions"
                        url="{{ $url }}" view="squares"></x-applicants.components.preselect>
                </div>
            </div>
        </div>
    </div>
</div>
