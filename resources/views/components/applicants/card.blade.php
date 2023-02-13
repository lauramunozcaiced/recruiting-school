<div class="card card-{{ $applicant->id }} card-applicant">
    <div class="card-body">
        <!--Name Applicant -->
        <div class="applicants-name text-center"><p>{{ $applicant->firstname }} {{ $applicant->lastname }} </p></div>

        <!--Title Applicant -->
        <p class="applicants-title text-center">{{ $applicant->title }}</p>
        <!--Photo Applicant -->
        <div class="card-applicant__presentation d-flex justify-content-center mt-2">
            <div class="card-applicant__presentation-avatar {{ $applicant->visible }}-avatar"
                style="background-image: url('{{ asset($applicant->image) }}');">
            </div>
        </div>

        

        <!--Status (Form Activation) Applicant -->
        <x-applicants.activation :applicant="$applicant"/>

        <!--Social Buttons Applicant -->
        <div class="card-applicant__social-buttons pt-2 justify-content-center">
            <!--Linkedin Button -->
            @if (Auth::user()->role != 'customer')
                @if ($applicant->linkedin)
                    <a href="https://linkedin.com/in/{{ $applicant->linkedin }}" class="btn bg-indigo text-white"
                        target="_blank" title="Go to {{ $applicant->firstname }}'s linkedin"><i
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
            <!--Video Button -->
            @if ($applicant->video)
                <a type="button" class="btn btn-warning modalButt rounded-circle text-white" data-toggle="modal"
                    data-target="#videoModal{{ $applicant->id }}"
                    title="Watch {{ $applicant->firstname }} Video Presentation">
                    <i class="fa fa-play"></i>
                </a>
                <div class="modal fade videoModalApplicant" id="videoModal{{ $applicant->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="videoModal{{ $applicant->id }}Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" data-iframe="#iframevideoModal{{ $applicant->id }}" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if (str_contains($applicant->video, 'https://vimeo.com/'))
                                    @php
                                        $videoCode = str_replace('https://vimeo.com/', '', $applicant->video);
                                        $codes = explode("/",$videoCode);
                                    @endphp
                                    <iframe id="iframevideoModal{{ $applicant->id }}" width="560" height="315"
                                        src="https://player.vimeo.com/video/{{ $codes[0] }}?h={{$codes[1]}}"
                                        frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen >
                                    </iframe>
                                @else
                                    <div
                                        style="background-color: #000000d1; font-size: 20px; padding: 1rem 1rem .8rem;">
                                        <p class="text-white">The link used by {{ $applicant->firstname }} for the
                                            video, is not from Vimeo or it was not possible to add it. </p>
                                        <a style="width: auto;" href="{{ $applicant->video }}" target="_blank">Go to
                                            the link</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!--Send Message Button (Not Active Yet) -->
            @if (false)
                <a href="{{ $applicant->cv }}" class="btn btn-info" target="_blank"
                    title="Send {{ $applicant->firstname }} a message">
                    <img src="{{ asset('/images/message.svg') }}" width="14"></a>
            @endif
        </div>

        @if (Route::currentRouteName() == 'applicants.index' || Route::currentRouteName() == 'applicants.search' || Route::currentRouteName() == 'applicants.show')

        <!--English Information Applicant-->
            <div class="card-applicant__english pt-2">
                <p>English Level</p>
                <p>{{ $applicant->english }}</p>
            </div>

        <!--Experience Information Applicant -->
            <div class="card-applicant__experience pt-2">
                <p>Most Recent Experience</p>
                @if (isset($applicant->experiences[0]))
                    <p>{{ ucwords(strtolower($applicant->experiences[0]->position)) }} -
                        {{ ucwords(strtolower($applicant->experiences[0]->company)) }}</p>
                    <small>Since <b>{{ $applicant->experiences[0]->start_date }}</b> to<b>
                            {{ $applicant->experiences[0]->end_date }}</b></small>
                @else
                    <small>{{ $applicant->firstname }} has not completed the profile.</small>
                @endif
            </div>

        @endif

       
    </div>
    <div class="card-footer">
 <!--Flags Applicant -->
 <x-applicants.advices :applicant="$applicant"/>

 <!-- Hire Button -->
 <x-applicants.hire :applicant="$applicant" />

 @if (Route::currentRouteName() == 'applicants.index' || Route::currentRouteName() == 'applicants.search' || Route::currentRouteName() == 'applicants.show')
     <div class="d-flex flex-wrap pt-2">
 
 <!--Read More Information Applicant -->
     <x-applicants.information :applicant="$applicant" :positions="$positions"/>
 
 <!--Matches Applicant -->
         <x-applicants.match modal="{{false}}" :applicant="$applicant" :positions="$positions"/>
 
 <!--Preselect Applicant -->
         <x-applicants.preselect :applicant="$applicant" :positions="$positions"/>

     </div>
 @endif
    </div>
</div>