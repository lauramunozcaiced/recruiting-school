@if (Route::currentRouteName() == 'applicants.index' || Route::currentRouteName() == 'applicants.search' || Route::currentRouteName() == 'applicants.show')
    @if (Auth::user()->role == 'customer')
        <div class="card-applicant__preselect pt-2">
            @php $pre = true; @endphp
            @foreach ($applicant->preselections as $preselection)
                @if ($preselection->position->user->id == Auth::user()->id)
                    @php $pre = false; @endphp
                @endif
            @endforeach
            @if ($pre == true)
                <button type="button" class="btn bg-indigo text-white rounded-0" data-toggle="modal"
                    data-target="#doPreselect{{ $applicant->id }}"><i class="fa fa-heart mr-2"></i>Preselect</button>

                <div class="modal fade" id="doPreselect{{ $applicant->id }}" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn close"data-dismiss="modal"
                                    aria-label="Close">&times;</button>
                                <x-applicants.preselectForm :positions="$positions" :applicant="$applicant" />
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <form action="{{ route('preselections.destroy', $applicant->id) }}" class="" method="post"
                    onsubmit="if(confirm('Do you want delete this preselection?')){this.form.submit()}else{return false;}">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger d-flex align-items-center rounded-0"><i
                            class="fa fa-trash mr-2"></i>Delete Preselection</button>
                </form>
            @endif
        </div>
    @endif
@endif
