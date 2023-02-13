<div>
    <form action="{{ route('preselections.store') }}" method="post" class="white-bg mt-3">
        @csrf
        <div class="form-group">
            <label for="position_id">Choose the position for which you want to pre-select this user</label><br>
            <select name="position_id" class="form-control" required>
                @foreach ($positions as $position)
                    @if ($position->user_id == Auth::user()->id)
                        <option value="{{ $position->id }}">
                            {{ $position->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
        <div class="form-group text-right">
            <button type="button" class="btn btn-secondary rounded-0 mr-2"
                data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">Cancel</span>
            </button>
            <button type="submit" class="btn bg-solvoblue text-white rounded-0">Save</button>
        </div>

    </form>
</div>
