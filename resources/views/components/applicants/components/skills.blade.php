<form action="
    @if(isset(Auth::user()->applicant->skills))
        @if(count(Auth::user()->applicant->skills) > 0) 
            {{ route('applicants.update', Auth::user()->applicant) }}
        @else 
            {{ route('applicants.store') }} 
        @endif
    @else
        {{ route('applicants.store') }}
    @endif" method="post" enctype="multipart/form-data">

    @csrf
    @isset(Auth::user()->applicant->skills)
        @if (count(Auth::user()->applicant->skills) > 0)
            @method('put')
        @endif
    @endisset

    <input type="hidden" name="step" value="{{$step}}">
    <h3 class="mt-5">Skills</h3>
    <label class="mt-2">Now we want to know your job skills. 
        Add up to 10 skills that may interest us and make
         your profile more interesting.</label>
    <div class="form-group mt-3">
        <div class="skills-group">
            @if (isset(Auth::user()->applicant->skills))
                @if (count(Auth::user()->applicant->skills) > 0)
                    @foreach (Auth::user()->applicant->skills as $i => $skill)
                        <div class=" d-flex align-items-center mb-1">
                            <input type="text" class="form-control" name="skill[]" value="{{ $skill->name }}"
                                required>
                            @if ($i != 0) <a class="remove_skill btn btn-danger"
                                    href="javascript:void(0)">Delete</a> @endif
                        </div>
                    @endforeach
                @else
                    <div class="mb-1">
                        <input type="text" class="form-control" name="skill[]" required>
                    </div>
                @endif

            @endif
        </div>
        <a href="javascript:void(0)" class="add_skill btn btn-primary mt-2">Add Skill</a>
    </div>
    <button type="submit" class="btn btn-primary mt-5 form-control" >Save Data</button>
</form>
