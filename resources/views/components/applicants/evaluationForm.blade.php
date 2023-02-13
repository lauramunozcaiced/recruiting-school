<div class="modal fade" id="{{$type}}Modal{{ $applicant->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">&times;</button>
                <div class="pt-3">
                    <form @if($modo == 'create') action="{{ route('evaluations.store') }}" @else action="{{ route('evaluations.update',$applicant) }}" @endif method="post" class="white-bg">
                        @csrf
                        @if ($modo == 'update')
                            @method('put')
                        @endif
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
                        <div class="form-group">
                            <label for="grade">Enter the grade corresponding to the <strong>{{$label}}</strong></label>
                            <input type="text" name="grade" class="form-control" value="{{old('grade', isset($applicant->evaluation) ? $applicant->evaluation[$type] : '' )}}" required>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn bg-solvoblue rounded-0 text-white">Save Grade</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
