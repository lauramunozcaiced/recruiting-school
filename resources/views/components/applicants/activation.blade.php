@if (Auth::user()->role == 'supervisor')
    @if (Route::currentRouteName() == 'applicants.index' || Route::currentRouteName() == 'applicants.search' || Route::currentRouteName() == 'applicants.show')
        <div class="card-applicant__visible d-flex align-items-center justify-content-center mt-2">
            <form action="{{ route('applicants.update', $applicant) }}" method="post">
                @method('put')
                @csrf
                <p class="{{ $applicant->visible }}">{{ $applicant->visible }}</p>
                <select style="background-image: url({{ asset('/images/arrow' . $applicant->visible . '.svg') }})"
                title="Change {{ $applicant->firstname }} status" type="hidden" name="visible"
                onchange="if(!confirm('Do you want change this applicant state?')){
                    for (var i = 0, l = options.length; i < l; i++) {
                    this.options[i].selected = this.options[i].defaultSelected;}
                    }else{this.form.submit()}">
                    <option @if ($applicant->visible == 'active') selected @endif value="active">Active</option>
                    <option @if ($applicant->visible == 'inactive') selected @endif value="inactive">Inactive</option>
                </select>
            </form>
        </div>       
    @endif
@endif
