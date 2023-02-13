@isset(Auth::user()->applicant)
<form action="{{ route('applicants.update', Auth::user()->applicant) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    
    <input type="hidden" name="step" value="{{ $step }}">
    <h3 class="mt-5">Video Presentation</h3>
    <label class="mt-2">Amazing! Almost done, we want hear and see you.
       Paste your link video presentation of youtube, for do this video 
       follow this video test:</label>

    <div style="border: 1px solid gray; height: 215px; width: 460px; 
    display: flex; justify-content: center; align-items: center; 
    padding: 1rem; margin: 2rem 0;">VIDEO EXPLANATION</div>
    <label for="video">Add a Video Presentation <b>*</b></label>
    <div class="form-group">
        <input type="text" class="form-control video_field" name="video" value="{{old('video',isset(Auth::user()->applicant->video) ? Auth::user()->applicant->video : '')}}" required>
        @error('video')
            <p class="error-message">{{$message}}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary mt-5 form-control">Save Data</button>
</form>
@endisset

