@isset(Auth::user()->applicant)
<form action="{{ route('applicants.update', Auth::user()->applicant) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <input type="hidden" name="step" value="{{ $step }}">
    <h3 class="mt-5">Open Positions</h3>
    <label class="mt-2">Which position would you like to apply for at Solvo? 
        Choose your preferred position, remember that if there are no open positions or you dont find your 
        preferred position, you can choose the option to "Choose Later" and 
        continue the process:</label>
    <div class="d-flex flex-wrap pt-3">
        <div class="position-choose">      
            <input type="checkbox" @if(Auth::user()->applicant->position_id == 0) checked @endif 
            id="check" data-value="0">
            <label for="check">Choose Later</label>
        </div>        
        @if (count($positions)> 0)
            @foreach ($positions as $position)
            <div class="position-choose">
                <input type="checkbox" @if(Auth::user()->applicant->position_id == $position->id) checked @endif
                 id="check-{{$position->id}}" data-value="{{$position->id}}">
                <label for="check-{{$position->id}}">{{$position->name}}</label>
            </div>
            @endforeach
        @endif
    </div>
    <input class="load-position-selected" type="hidden" name="position_id" id="position_id" value="" required>
    @error('position_id')
            <p class="error-message">{{$message}}</p>
        @enderror
    <button type="submit" class="btn btn-primary mt-5 form-control">Save Data</button>
</form>
@endisset

