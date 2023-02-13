<div class="view dashboard-view app__dashboard-view sesion-{{ Auth::user()->role }}">
    <div class="row">
        <div class="col-lg-5">
            <div class="card sesion-applicant-card profile-card">
                <div class="profile-avatar" @if (Auth::user()->name != null) style="background-image: url('{{ asset( Auth::user()->applicant->image) }}');" > @else ><span>W</span> @endif</div>
                    @if (Auth::user()->name != null)
                        <h2>{{ Auth::user()->applicant->firstname }} {{Auth::user()->applicant->lastname }}</h2>
                    @else
                        <h2>Welcome friend, </h2>
                        <h5 class="mt-3">This is Solvo Global's recruitment application</h5>
                        <label class="mt-2">Now, follow the steps and complete the required 
                            information to present your amazing profile to Solvo 
                            Global recruiters.</label>
                    @endif
                    @isset(Auth::user()->applicant)
                        <h5>{{ Auth::user()->applicant->title }}</h5>
                        <p class="mt-2"><i class="fa fa-map-marker mr-2"></i>{{ Auth::user()->applicant->location }}</p>

                        <!-- Flags -->
                        @isset(Auth::user()->applicant->matches)
                            @if(count(Auth::user()->applicant->matches) > 0)
                                <p class="p-1 bg-warning mt-3 mb-1 font-weight-bold">Your profile has been shown to a client<p>
                            @endif
                        @endisset
                        @isset(Auth::user()->applicant->preselections)
                            @if(count(Auth::user()->applicant->preselections) > 0)
                                <p class="p-1 bg-solvoblue mt- mb-2 text-white font-weight-bold">Your profile has a client preselection for the {{Auth::user()->applicant->preselections[0]->position->name}} position<p>
                            @endif
                        @endisset

                        <p class="mt-3">{{ Auth::user()->applicant->aboutme }}</p>
                        <div class="profile-card__social-buttons mt-3">
                            <a href="https://linkedin.com/in/{{ Auth::user()->applicant->linkedin }}"
                                class="btn bg-indigo text-white" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <a href="{{ Auth::user()->applicant->portfolio }}" class="btn btn-primary" target="_blank"><i
                                    class="fa fa-briefcase"></i></a>
                            <a href="tel:{{ Auth::user()->applicant->phone }}" class="btn btn-success"><i
                                    class="fa fa-phone"></i></a>
                        </div>

                        <!--<div class="profile-card__skills mt-3">
                            <h4>Skills</h4>
                            <div class="profile-card__skills-list d-flex">
                                @foreach (Auth::user()->applicant->skills as $skill)
                                    <p class="applicant-skill">{{ $skill->name }}</p>
                                @endforeach
                            </div>
                        </div>-->

                        @if (count(Auth::user()->applicant->experiences) > 0)
                            <div class="profile-card__experience mt-3">
                                <h4>Last Experience</h4>
                                <h5 class="mt-3"><strong>
                                    {{ ucwords(strtolower(Auth::user()->applicant->experiences[0]->position)) }}</strong> in 
                                    {{ ucwords(strtolower(Auth::user()->applicant->experiences[0]->company)) }}</h5>
                                <small><b>Since:</b> {{ Auth::user()->applicant->experiences[0]->start_date }} <b>To:</b>
                                    {{ Auth::user()->applicant->experiences[0]->end_date }}</small>
                                <p class="mt-2">{{ Auth::user()->applicant->experiences[0]->description }}</p>
                            </div>
                        @endif

                        

                    @endisset
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card sesion-applicant-card">
                    @php
                        if (isset(Auth::user()->applicant)) {
                            $BI = 'true';
                            $SK = count(Auth::user()->applicant->skills) > 0 ? 'true' : 'false';
                            $ST = count(Auth::user()->applicant->studies) > 0 ? 'true' : 'false';
                            $EX = count(Auth::user()->applicant->experiences) > 0 ? 'true' : 'false';
                            $CP = isset(Auth::user()->applicant->choose_position) > 0 ? 'true' : 'false';
                            $VD = isset(Auth::user()->applicant->video) > 0 ? 'true' : 'false';
                        } else {
                            $BI = $SK = $ST = $EX = $CP = $VD = 'false';
                        }
                        
                        $myBasicInformation = $BI == 'false' && $SK == 'false' && $ST == 'false' && $EX == 'false' && $CP == 'false' && $VD == 'false' ? 'true' : 'false';
                        $mySkills = $BI == 'true' && $SK == 'false' && $ST == 'false' && $EX == 'false' && $CP == 'false' && $VD == 'false' ? 'true' : 'false';
                        $myStudies = $BI == 'true' && $SK == 'true' && $ST == 'false' && $EX == 'false' && $CP == 'false' && $VD == 'false' ? 'true' : 'false';
                        $myExperience = $BI == 'true' && $SK == 'true' && $ST == 'true' && $EX == 'false' && $CP == 'false' && $VD == 'false' ? 'true' : 'false';
                        $myPosition = $BI == 'true' && $SK == 'true' && $ST == 'true' && $EX == 'true' && $CP == 'false' && $VD == 'false' ? 'true' : 'false';
                        $myVideo = $BI == 'true' && $SK == 'true' && $ST == 'true' && $EX == 'true' && $CP == 'true' && $VD == 'false' ? 'true' : 'false';
                        $stepsDone = $BI == 'true' && $SK == 'true' && $ST == 'true' && $EX == 'true' && $CP == 'true' && $VD == 'true' ? 'true' : 'false';
                    @endphp
                    <div class="nav nav-tabs steps">
                        <div class="step-form">
                            <button class="btn @if ($myBasicInformation=='true' ) btn-primary @endif @if ($BI == 'true') btn-success @endif" data-toggle="tab"
                                data-target="#basicInformation" type="button" aria-expanded="false"
                                aria-controls="basicInformation">
                                1
                            </button>
                            <label>Basic Data</label>
                        </div>
                        <div class="step-form">
                            <button class="btn @if ($mySkills=='true' ) btn-primary @endif @if ($SK == 'true') btn-success @endif"
                                data-toggle="tab" data-target="#Skills" @if ($BI == 'false') disabled @endif type="button" aria-expanded="false"
                                    aria-controls="Skills">
                                    2
                            </button>
                            <label>Skills</label>
                        </div>
                        <div class="step-form">
                            <button class="btn @if ($myStudies=='true' ) btn-primary @endif @if ($ST == 'true') btn-success @endif"
                                data-toggle="tab" data-target="#Education" @if ($SK == 'false') disabled @endif type="button" aria-expanded="false"
                                    aria-controls="Education">
                                    3
                            </button>
                            <label>Education</label>
                        </div>
                        <div class="step-form">
                            <button class="btn @if ($myExperience=='true' ) btn-primary @endif @if ($EX == 'true') btn-success @endif" data-toggle="tab"
                                data-target="#Experience"
                                @if ($ST == 'false') disabled @endif type="button"
                                    aria-expanded="false" aria-controls="Experience">
                                    4
                            </button>
                            <label>Experience</label>
                        </div>
                        <div class="step-form">
                            <button class="btn @if ($myPosition=='true' ) btn-primary @endif @if ($CP == 'true') btn-success @endif"
                                data-toggle="tab" data-target="#Position" @if ($EX == 'false')
                                    disabled @endif type="button" aria-expanded="false" aria-controls="Position">
                                    5
                            </button>
                            <label>Position</label>
                        </div>
                        <div class="step-form">
                            <button class="btn @if ($myVideo=='true' ) btn-primary @endif @if ($VD == 'true') btn-success
                                @endif"
                                data-toggle="tab" data-target="#Video" @if ($CP == 'false')
                                    disabled @endif type="button" aria-expanded="false" aria-controls="Video">
                                    6
                            </button>
                            <label>Video</label>
                        </div>
                        <div class="step-form">
                            <button class="btn @if ($stepsDone=='true' ) btn-primary @endif no-rounded" data-toggle="tab" data-target="#Done"
                                @if ($stepsDone == 'false')
                                disabled @endif type="button" aria-expanded="false" aria-controls="Done">
                                Done
                            </button>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade @if ($myBasicInformation=='true' ) show active @endif" id="basicInformation">
                            <x-applicants.components.basicInformation step="1" :locations="$locations">
                            </x-applicants.components.basicInformation>
                        </div>
                        <div class="tab-pane fade @if ($mySkills=='true' ) show active @endif" id="Skills">
                            <x-applicants.components.skills step="2"></x-applicants.components.skills>
                        </div>
                        <div class="tab-pane fade @if ($myStudies=='true' ) show active @endif" id="Education">
                            <x-applicants.components.studies step="3">
                            </x-applicants.components.studies>
                        </div>
                        <div class="tab-pane fade @if ($myExperience=='true' ) show active @endif" id="Experience">
                            <x-applicants.components.experiences step="4">
                            </x-applicants.components.experiences>
                        </div>
                        <div class="tab-pane fade @if ($myPosition=='true' ) show active @endif" id="Position">
                            <x-applicants.components.position step="5" :positions="$positions">
                            </x-applicants.components.position>
                        </div>
                        <div class="tab-pane fade @if ($myVideo=='true' ) show active @endif" id="Video">
                            <x-applicants.components.video step="6">
                            </x-applicants.components.video>
                        </div>
                        <div class="tab-pane fade @if ($stepsDone=='true' ) show active @endif" id="Done">
                            <div class="mt-5 text-center">
                                <div id="pie" class="pie zero">
                                    <label for="">100%</label>
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100"
                                        height="100">
                                        <circle class="pc" cx="50" cy="50" r="50"
                                            style="stroke-dashoffset: 5; transition: all 1s" ; /><!-- cf. calcul -->
                                        <circle cx="50" cy="50" r="35" style="fill: #FFF;" ; />
                                    </svg>
                                </div>
                            </div>
                            <h2 class="mt-3 text-center">You have completed your profile!</h2>
                            <label class="mt-3">You have an incredible profile! Our recruiters are
                                looking at your profile and searching for a vacancy that
                                fits you. Don't worry, you will receive a call very soon
                                to continue with your process.</label>
                            <h3 class="mt-5">Do you want to edit any part of your profile?</h3>
                            <label class="mt-3">Select the step you want to edit or choose:</label>
                            <div class="mt-3 whatedit">
                                <button class="btn btn-primary" data-toggle="tab" data-target="#basicInformation" type="button" aria-expanded="false"
                                aria-controls="basicInformation">
                                Basic Information
                                </button>
                                <button class="btn btn-primary"
                                data-toggle="tab" data-target="#Skills" type="button" aria-expanded="false"
                                    aria-controls="Skills">
                                   Skills
                                </button>
                                <button class="btn btn-primary"
                                data-toggle="tab" data-target="#Education" type="button" aria-expanded="false"
                                    aria-controls="Education">
                                    Education
                                </button>
                                <button class="btn btn-primary" data-toggle="tab"
                                data-target="#Experience" type="button"
                                    aria-expanded="false" aria-controls="Experience">
                                    Experience
                                </button>
                                <button class="btn btn-primary"
                                data-toggle="tab" data-target="#Position" type="button" aria-expanded="false" aria-controls="Position">
                                    Choose a Position
                                </button>
                                <button class="btn btn-primary" data-toggle="tab" data-target="#Video" @if ($CP == 'false')
                                    disabled @endif type="button" aria-expanded="false" aria-controls="Video">
                                    Video Presentation
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
