@if(false)
@if ($applicant->visible == 'active')
    @if (Auth::user()->role == 'recruiter' || Auth::user()->role == 'supervisor')
        @if (isset($applicant->evaluation))
            @php $mode = 'update'; @endphp
        @else
            <?php $mode = 'create'; ?>
        @endif
        <p class="pt-3 font-weight-bold">Evaluations</p>
        <div class="pt-1">
            <div class="evaluation-item">
                <!-- Check -->
                <div class="evaluation-item__text">
                    <div class="evaluation-item__check @if ($mode == 'create') nodone @else  
                    @if ($applicant->evaluation->call != null) done @else nodone @endif @endif">
                    </div>
                    <label for="">English Call</label>
                </div>
                <!-- Grade Button-->
                <button type="button" class="btn rounded-0 @if ($mode == 'create') btn-outline-danger @else
                  @if ($applicant->evaluation->call != null) btn-outline-success @else btn-outline-danger @endif @endif btn-sm"
                    data-toggle="modal" data-target="#callModal{{ $applicant->id }}">Grade</button>
                <x-applicants.evaluationForm type="call" :applicant="$applicant" label="English Call"
                    modo="{{ $mode }}" />
            </div>

            <div class="evaluation-item">
                <!-- Check -->
                <div class="evaluation-item__text">
                    <div class="evaluation-item__check @if ($mode == 'create') nodone @else  
                    @if ($applicant->evaluation->english != null) done @else nodone @endif @endif">
                    </div>
                    <label for="">English Test</label>
                </div>
                <!-- Grade Button-->
                <button type="button" class="btn rounded-0 @if ($mode == 'create') btn-outline-danger @else  
                @if ($applicant->evaluation->english != null) btn-outline-success @else btn-outline-danger @endif @endif btn-sm"
                    data-toggle="modal" data-target="#englishModal{{ $applicant->id }}">Grade</button>
                <x-applicants.evaluationForm type="english" :applicant="$applicant" label="English Test"
                    modo="{{ $mode }}" />
            </div>

            <div class="evaluation-item">
                <!-- Check -->
                <div class="evaluation-item__text">
                    <div class="evaluation-item__check @if ($mode == 'create') nodone @else  
                    @if ($applicant->evaluation->excel != null) done @else nodone @endif @endif">
                    </div>
                    <label for="">Excel Test</label>
                </div>
                <!-- Grade Button-->
                <button type="button" class="btn rounded-0 @if ($mode == 'create') btn-outline-danger @else  
                @if ($applicant->evaluation->excel != null) btn-outline-success @else btn-outline-danger @endif @endif btn-sm"
                    data-toggle="modal" data-target="#excelModal{{ $applicant->id }}">Grade</button>
                <x-applicants.evaluationForm type="excel" :applicant="$applicant" label="Excel Test"
                    modo="{{ $mode }}" />
            </div>

            <div class="evaluation-item">
                <!-- Check -->
                <div class="evaluation-item__text">
                    <div class="evaluation-item__check @if ($mode == 'create') nodone @else  
                    @if ($applicant->evaluation->powerpoint != null) done @else nodone @endif @endif">
                    </div>
                    <label for="">Powerpoint Test</label>
                </div>
                <!-- Grade Button-->
                <button type="button" class="btn rounded-0 @if ($mode == 'create') btn-outline-danger @else 
                 @if ($applicant->evaluation->powerpoint != null) btn-outline-success @else btn-outline-danger @endif 
                 @endif btn-sm"
                    data-toggle="modal" data-target="#powerpointModal{{ $applicant->id }}">Grade</button>
                <x-applicants.evaluationForm type="powerpoint" :applicant="$applicant" label="Powerpoint Test"
                    modo="{{ $mode }}" />
            </div>

        </div>
    @endif
@else
    <p class="pt-3 font-weight-bold">Evaluations</p>
    <small>Activate applicant for evaluation.</small>
@endif
@endif