<form action="@if (isset(Auth::user()->applicant) == false) {{ route('applicants.store') }} @else {{ route('applicants.update', Auth::user()->applicant) }} @endif" method="post" enctype="multipart/form-data">
    @csrf
    @isset(Auth::user()->applicant)
        @method('put')
    @endisset
    <input type="hidden" name="step" value="{{ $step }}">
    <h3 class="mt-5">Work Experience</h3>
    <label class="mt-2">We want to know about your work experiences.
        Add a maximum of 5 experiences, from the most recent to the oldest,
         that may interest us and make your profile more interesting.</label>
    <div class="form-group mt-3">
        <div class="experience-group">
            @if (isset(Auth::user()->applicant->experiences))
                @if (count(Auth::user()->applicant->experiences) > 0)
                    @foreach (Auth::user()->applicant->experiences as $i => $experience)
                        <div @if ($i != 0) class="mt-5" @endif>
                            <div class="d-flex w-100">
                                <div class="w-50">
                                    <label for="position">Position <b>*</b></label>
                                    <input type="text" class="form-control"
                                        name="experience[{{ $i }}][position]"
                                        value="{{ $experience->position }}" required>
                                </div>
                                <div class="w-50 ml-1">
                                    <label for="company">Company <b>*</b></label>
                                    <input type="text" class="form-control"
                                        name="experience[{{ $i }}][company]"
                                        value="{{ $experience->company }}" required>
                                </div>
                            </div>
                            <div class="d-flex w-100 dates">
                                <div class="w-50">
                                    <label for="start_date">Start date <b>*</b></label>
                                    <input type="date" class="form-control start_date"
                                        name="experience[{{ $i }}][start_date]"
                                        value="{{ $experience->start_date }}" required>
                                </div>
                                <div class="w-50 ml-1">
                                    <label for="end_date">End date <b>*</b></label>
                                    <input type="date" class="form-control end_date"
                                        name="experience[{{ $i }}][end_date]"
                                        value="{{ $experience->end_date }}" required>
                                </div>
                            </div>
                            <div class="textarea">
                            <textarea class="form-control mt-1" maxlength="500" placeholder="Limited to 500 characters" name="experience[{{ $i }}][description]"
                                required>{{ $experience->description }}</textarea>
                            </div>
                            @if ($i != 0) <a href="javascript:void(0)"
                                    class="remove_experience btn btn-danger mt-2" style="float: right;">Remove
                                    Experience</a> @endif
                        </div>
                    @endforeach
                @else
                    <div>
                        <div class="d-flex w-100">
                            <div class="w-50">
                                <label for="position">Position <b>*</b></label>
                                <input type="text" class="form-control" name="experience[0][position]" required>
                            </div>
                            <div class="w-50 ml-1">
                                <label for="company">Company <b>*</b></label>
                                <input type="text" class="form-control" name="experience[0][company]" required>
                            </div>
                        </div>
                        <div class="d-flex w-100 dates">
                            <div class="w-50">
                                <label for="start_date">Start date <b>*</b></label>
                                <input type="date" class="form-control start_date" name="experience[0][start_date]" required>
                            </div>
                            <div class="w-50 ml-1">
                                <label for="end_date">End date <b>*</b></label>
                                <input type="date" class="form-control end_date" name="experience[0][end_date]" required>
                            </div>

                        </div>
                        <div class="form-group mt-2">
                            <label for="">Describe your tasks in this job <b>*</b></label>
                            <div class="textarea">
                            <textarea class="form-control mt-1" maxlength="500" placeholder="Limited to 500 characters" name="experience[0][description]" required></textarea>
                            </div>
                        </div>
                    </div>
                @endif

            @endif
        </div>
        <a href="javascript:void(0)" class="add_experience btn btn-primary mt-5">Add Experience</a>
    </div>
    <button type="submit" class="btn btn-primary mt-5 form-control">Save Data</button>
</form>
