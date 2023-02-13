<form action="
    @if(isset(Auth::user()->applicant->studies))
        @if(count(Auth::user()->applicant->studies) > 0) 
            {{ route('applicants.update', Auth::user()->applicant) }}
        @else 
            {{ route('applicants.store') }} 
        @endif
    @else
        {{ route('applicants.store') }}
    @endif" method="post" enctype="multipart/form-data">

    @csrf
    @isset(Auth::user()->applicant->studies)
        @if (count(Auth::user()->applicant->studies) > 0)
            @method('put')
        @endif
    @endisset

    <input type="hidden" name="step" value="{{ $step }}">
    <h3 class="mt-5">Education</h3>
    <label class="mt-2">We want to know about your education.
        Add a maximum of 5 studies, from the most recent to the oldest, 
         that may interest us and make your profile more interesting.</label>
    <div class="form-group mt-3">
        <div class="studies-group">
            @if (isset(Auth::user()->applicant->studies))
                @if (count(Auth::user()->applicant->studies) > 0)
                    @foreach (Auth::user()->applicant->studies as $i => $study)
                        <div @if ($i != 0) class="mt-5" @endif>
                            <div class="d-flex w-100">
                                <div class="w-50">
                                    <label for="title">Title <b>*</b></label>
                                    <input type="text" class="form-control"
                                        name="study[{{ $i }}][title]"
                                        value="{{ $study->title }}" required>
                                </div>
                                <div class="w-50 ml-1">
                                    <label for="school">Institution <b>*</b></label>
                                    <input type="text" class="form-control"
                                        name="study[{{ $i }}][school]"
                                        value="{{ $study->school }}" required>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <select class="form-control mt-1" name="study[{{ $i }}][graduated]"
                                required>
                                    <option @if($study->graduated == 'course') selected @endif value="course">In Course</option>
                                    <option @if($study->graduated == 'graduated') selected @endif value="graduated">Graduated</option>
                                </select>
                            </div>
                            @if ($i != 0) <a href="javascript:void(0)"
                                    class="remove_study btn btn-danger mt-2" style="float: right;">Remove
                                    Education</a> @endif
                        </div>
                    @endforeach
                @else
                    <div>
                        <div class="d-flex w-100">
                            <div class="w-50">
                                <label for="title">Title <b>*</b></label>
                                <input type="text" class="form-control" name="study[0][title]" required>
                            </div>
                            <div class="w-50 ml-1">
                                <label for="school">Institution <b>*</b></label>
                                <input type="text" class="form-control" name="study[0][school]" required>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="">State <b>*</b></label>
                            <select class="form-control mt-1" name="study[0][graduated]" id="" required>
                                <option selected disabled value="">Choose an option</option>
                                <option value="course">In Course</option>
                                <option value="graduated">Graduated</option>
                            </select>
                        </div>
                    </div>
                @endif

            @endif
        </div>
        <a href="javascript:void(0)" class="add_study btn btn-primary mt-5">Add Education</a>
    </div>
    <button type="submit" class="btn btn-primary mt-5 form-control">Save Data</button>
</form>
