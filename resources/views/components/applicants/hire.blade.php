@if (Route::currentRouteName() == 'preselections.index' || Route::currentRouteName() == 'preselections.search' || Route::currentRouteName() == 'preselections.show')
    @if($applicant->visible != 'hired')    
        <div class="card-applicant__visible d-flex align-items-center mt-2">
            <form action="{{ route('applicants.update', $applicant) }}" method="post" onsubmit="if(confirm('Do you want hire this applicant?')){this.form.submit()}else{return false}">
                @method('put')
                @csrf
                <input type="hidden" name="visible" value="hired"/>
                <button type="submit" class="btn btn-secondary rounded-0" ></i>Hire</button>
            </form>
        </div>
    @else
        <p class="mt-2 bg-success p-1 text-white">The applicant is hired</p>
    @endif       
@endif