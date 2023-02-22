@if (Auth::user()->role != 'customer')
<!-- Button -->
<button class="btn btn-secondary rounded-0 readMoreButton" data-target="#readMoreModal{{ $applicant->id }}">
    Read More
</button>
<!-- Modal -->
<div class="readMoreModal" id="readMoreModal{{ $applicant->id }}">
    <div class=" d-flex h-100 overflow-auto">
        <!-- Button Close -->
        <button data-iframe="#iframe{{ $applicant->id }}" class="closereadMore rounded-0 position-absolute p-4 btn close"
            style="right: 0px; z-index:2;" data-target="#readMoreModal{{ $applicant->id }}">&times;</button>
        <!-- Content -->
        <div class="col-lg-6 col-sm-12 p-4 bg-white h-100  d-flex flex-column justify-content-center">
            <div class="card-applicant__presentation d-flex">
                <!--Photo Applicant -->
                <div class="card-applicant__presentation d-flex align-items-center mr-3">
                    <div class="card-applicant__presentation-avatar {{ $applicant->visible }}-avatar"
                        style="background-image: url('{{ asset($applicant->image) }}');">
                    </div>
                </div>

                <div>
                <!--Name Applicant -->
                    <div class="applicants-name"><p>{{ $applicant->firstname }} {{ $applicant->lastname }} </p></div>

                <!--Title Applicant -->
                    <p class="applicants-title">{{ $applicant->title }} @foreach ($positions as $position)
                            @if ($applicant->choose_position == $position->id)
                                looking for {{ $position->name }}
                            @endif
                        @endforeach
                    </p>

                <!--Status (Form Activation) Applicant -->
                    <x-applicants.activation :applicant="$applicant" view="card"/>

                <!--Social Buttons Applicant -->
                    <div class="card-applicant__social-buttons pt-2">
                        <!--Linkedin Button -->
                        @if (Auth::user()->role != 'customer')
                            @if ($applicant->linkedin)
                                <a href="https://linkedin.com/in/{{ $applicant->linkedin }}"
                                    class="btn bg-indigo text-white" target="_blank"
                                    title="Go to {{ $applicant->firstname }}'s linkedin"><i
                                        class="fa fa-linkedin"></i>
                                </a>
                            @endif
                        @endif
                        <!--Resume Button -->
                        <a href="{{ $applicant->cv }}" class="btn btn-danger" target="_blank"
                            title="See {{ $applicant->firstname }}'s resume">
                            <img src="{{ asset('/images/acrobat.svg') }}" width="14">
                        </a>
                        <!--Phone Button-->
                        @if (Auth::user()->role != 'customer')
                            <a href="tel:{{ $applicant->phone }}" class="btn btn-success"
                                title="Call {{ $applicant->firstname }}"><i class="fa fa-phone"></i>
                            </a>
                        @endif
                         <!--Send Message Button (Not Active Yet) -->   
                        @if (false)
                                <a href="{{ $applicant->cv }}" class="btn btn-info" target="_blank"
                                    title="Send {{ $applicant->firstname }} a message">
                                    <img src="{{ asset('/images/message.svg') }}" width="14">
                                </a>
                        @endif
                    </div>
                </div>
            </div>

            <!--About me Applicant -->
            <p class="applicants-aboutme pt-3">{{ $applicant->aboutme }}</p>

            <!--English Information Applicant-->
            <div class="card-applicant__english pt-3">
                <p>English Level</p>
                <p class="">{{ $applicant->english }}</p>
            </div>

            <!--Experience Information Applicant -->
            <div class="card-applicant__experience pt-3">
                <p>Most Recent Experience</p>
                @if (isset($applicant->experiences[0]))
                    <p>{{ ucwords(strtolower($applicant->experiences[0]->position)) }} -
                        {{ ucwords(strtolower($applicant->experiences[0]->company)) }} </p>
                    <small>Since <b>{{ $applicant->experiences[0]->start_date }}</b> to<b>
                            {{ $applicant->experiences[0]->end_date }}</b></small>
                    <p class="pt-2">{{ $applicant->experiences[0]->description }}</p>
                @else
                    <small>The applicant has not completed his profile.</small>
                @endif
            </div>

            <!--Education Information Applicant -->
            <div class="card-applicant__experience pt-3">
                <p>Highest level of Education</p>
                @if (isset($applicant->studies[0]))
                    <p>{{ ucwords(strtolower($applicant->studies[0]->title)) }}</p>
                    <p>{{ $applicant->studies[0]->school }}</p>
                @else
                    <small>The applicant has not completed his profile.</small>
                @endif
            </div>

            <!--Skills Applicant -->
            <div class="card-applicant__skills pt-3">
                <p>Skills</p>
                <div class="card-applicant__skills-list d-flex pt-1">
                    @if (isset($applicant->skills[0]))
                        @foreach ($applicant->skills as $skill)
                            <p class="applicant-skill">{{ $skill->name }}</p>
                        @endforeach
                    @else
                        <small>The applicant has not completed his profile.</small>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 border-left p-4 h-100 bg-gray d-flex flex-column justify-content-center">
            <div>
            <!--Video Applicant -->
            @php
             $data = buildUrlVideo($applicant->video);
            @endphp
            @if ($data[1])
                <div class="d-flex justify-content-center position-relative">
                    <div id="posteriframe{{ $applicant->id }}" class="position-absolute posterVideo"
                        data-iframe="#iframe{{ $applicant->id }}"
                        style=" background-image: url({{ asset('images/poster.jpg') }}); "></div>
                    <iframe id="iframe{{ $applicant->id }}" width="560" height="315"
                        src="{{$data[0]}}"
                        frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen ></iframe>

                </div>
            @else
                <p>The link used by {{ $applicant->firstname }} for the video, is not from youtube or it was not
                    possible to add it.<br> <a href="{{ $applicant->video }}" target="_blank">Go to the link</a> </p>
            @endif
        </div>
            <!--Flags Applicant -->
            <x-applicants.advices :applicant="$applicant"/>

            <!--Evaluations Applicant -->
            <x-applicants.evaluation :applicant="$applicant"/>

            <div class="d-flex justify-content-end pt-5 pb-3">
                <!--Matches Applicant -->
                <x-applicants.match modal="{{ true }}" :applicant="$applicant" :positions="$positions"/>
                
                <!--Preselect Applicant -->
                <x-applicants.preselect :applicant="$applicant" :positions="$positions"/>
            </div>
        </div>
    </div>
</div>
@endif