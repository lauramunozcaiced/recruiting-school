<div class="pt-3">
    <form action="{{ route('matches.store') }}" method="post" class="white-bg">
        @csrf
        <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="form-group">
            <label for="position_id">Choose a position to match with this user </label><br>
            <select name="position_id" class="form-control selectpicker" required>
                @foreach ($positions as $position)
                    <?php $use = true; ?>
                    @foreach ($applicant->matches as $match)
                        @if ($match->position->id == $position->id && $match->user->id == Auth::user()->id)
                            <?php $use = false; ?>
                        @endif
                    @endforeach
                    @if ($use == true)
                        <option value="{{ $position->id }}">{{ $position->name }} - {{ $position->user->name }}</option>
                    @endif
                @endforeach

            </select>
            @error('position_id')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="text-right">
            <button type="submit" class="btn bg-solvoblue rounded-0 text-white">Match</button>
        </div>
    </form>
</div>
