<form action="@if(isset(Auth::user()->applicant) == false) {{route('applicants.store')}} @else {{route('applicants.update', Auth::user()->applicant)}} @endif" method="post" enctype="multipart/form-data">
    @csrf
    @isset(Auth::user()->applicant)
        @method('put')
    @endisset
    <input type="hidden" name="step" value="{{$step}}">
   
    <h4 class="mt-4">Basic Information</h4>
    <label class="mt-2"><strong class="text-dark">Let's get started!</strong> We want to know 
        the basics about you. </label>
    <div class="form-group">
        <input type="hidden" name="email" value="{{Auth::user()->email}}" required>
    </div>
    <div class="form-group d-flex mt-4">
        <div>
        <label for="">First Name <b>*</b></label>
        <input type="text" class="form-control" name="firstname" value="{{old('firstname', isset(Auth::user()->applicant) ? Auth::user()->applicant->firstname : '' )}}" required>
        @error('firstname')
            <p class="error-message">{{$message}}</p>
        @enderror
        </div>
        <div>
            <label for="">Last Name <b>*</b></label>
        <input type="text" class="form-control" name="lastname" value="{{old('lastname', isset(Auth::user()->applicant) ? Auth::user()->applicant->lastname : '' )}}" required>
        @error('lastname')
            <p class="error-message">{{$message}}</p>
        @enderror
        </div>
    </div>
    <div class="form-group d-flex">
        <div>
            <label for="identification">ID Number <b>*</b></label>
        <input type="text" class="form-control" id="identification" name="identification" value="{{old('identification', isset(Auth::user()->applicant) ? Auth::user()->applicant->identification : '' )}}" required>
    @error('identification')
        <p class="error-message">{{$message}}</p>
    @enderror
        </div>
        <div>
            <label for="">Cell phone <b>*</b></label>
            <input type="tel" class="form-control" name="phone" value="{{old('phone',isset(Auth::user()->applicant) ? Auth::user()->applicant->phone : '' )}}" required>
            @error('phone')
                <p class="error-message">{{$message}}</p>
            @enderror
        </div>
    </div>
    <div class="form-group mt-3">
        <label for="image">Upload a photo of yourself @if(isset(Auth::user()->applicant) == false) <b>*</b> @endif</label><br>
        <div class="avatar-visualization"  @isset(Auth::user()->applicant) style="background-image: url('{{ asset(Auth::user()->applicant->image) }}');" @endisset ></div>
        <input type="file" id="avatar" class="form-control" name="image" accept="image/jpg, image/jpeg, image/png" value="{{old('image')}}" @if(isset(Auth::user()->applicant) == false) required @endif>
        @error('image')
            <p class="error-message">{{$message}}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="location">Location <b>*</b></label>
        <input type="text" class="form-control" list="Places" id="location" name="location" value="{{old('location', isset(Auth::user()->applicant) ? Auth::user()->applicant->location : '' )}}" placeholder="Type to Search a Location..." required autocomplete="off">
        <datalist id="Places">
            <?php
            asort($locations);
            ?>
          @foreach ($locations as $location)
                <option value="{{$location['name'].', '.$location['subcountry'].', '.$location['country']}}">
          @endforeach
        </datalist>
    </div>
    <h4 class="mt-5">Professional Information</h4>
    <div class="form-group mt-3">
        <label for="">Title <b>*</b></label>
        <input type="text" class="form-control" name="title" value="{{old('title',isset(Auth::user()->applicant) ? Auth::user()->applicant->title : '' )}}" required>
        @error('title')
            <p class="error-message">{{$message}}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="aboutme">Brief description of your Professional Profile <b>*</b></label><br>
        <div class="textarea">
            <textarea class="form-control" name="aboutme" maxlength="600" required>{{old('aboutme',isset(Auth::user()->applicant) ? Auth::user()->applicant->aboutme : '' )}}</textarea>
        </div>
        @error('aboutme')
            <p class="error-message">{{$message}}</p>
        @enderror
    </div>
    <div class="form-group pt-3">
        <label for="english">English Level <b>*</b></label>
        <select class="form-control" name="english" required>
            <option disabled selected>Choose an option</option>
            <option @isset(Auth::user()->applicant) @if(Auth::user()->applicant->english == "Beginner" ) selected @endif @endisset value="Beginner">Beginner</option>
            <option @isset(Auth::user()->applicant) @if(Auth::user()->applicant->english == "Elementary" ) selected @endif @endisset value="Elementary">Elementary</option>
            <option @isset(Auth::user()->applicant) @if(Auth::user()->applicant->english == "Intermediate" ) selected @endif @endisset value="Intermediate">Intermediate</option>
            <option @isset(Auth::user()->applicant) @if(Auth::user()->applicant->english == "Upper Intermediate" ) selected @endif @endisset value="Upper Intermediate">Upper Intermediate</option>
            <option @isset(Auth::user()->applicant) @if(Auth::user()->applicant->english == "Advanced" ) selected @endif @endisset value="Advanced">Advanced</option>
            <option @isset(Auth::user()->applicant) @if(Auth::user()->applicant->english == "Proficiency" ) selected @endif @endisset value="Proficiency">Proficiency</option>
        </select>
        @error('english')
            <p class="error-message">{{$message}}</p>
        @enderror
    </div>
    
    <div class="form-group pt-3">
        <label for="cv">Upload your English CV @if(isset(Auth::user()->applicant) == false)<b>*</b> @endif</label>
        @isset(Auth::user()->applicant)
        <h6 class="mb-3"><strong>To see the CV you have already uploaded <a href="{{ asset( Auth::user()->applicant->cv) }}" target="_blank">click here.</a></strong></h6>
        @endisset
        <input type="file" name="cv" accept="application/pdf" value="{{old('cv')}}" class="form-control" @if(isset(Auth::user()->applicant) == false) required @endif>
        <small>If you have your CV in another language, please translate it before attach it.
            We only accept CVs in English, please do not upload CVs in other languages as 
            you will eventually have to update it. 
          <strong>Only accept this CV in PDF format.</strong></small><br>
        @error('cv')
            <p class="error-message">{{$message}}</p>
        @enderror
    </div>
    <div class="form-group pt-3">
        <label for="linkedin">Linkedin</label>
        <div class="d-flex align-items-center">
            <p class="m-0 text-primary">https://linkedin.com/in/</p>
            <input type="text" class="form-control ml-2" name="linkedin"  value="{{old('linkedin', isset(Auth::user()->applicant) ? Auth::user()->applicant->linkedin : '' )}}">
            @error('linkedin')
                <p class="error-message">{{$message}}</p>
            @enderror
        </div>
    </div>
    <div class="form-group pt-3">
        <label for="portfolio">URL Portfolio</label>
        <input type="text" class="form-control" name="portfolio" value="{{old('porfolio', isset(Auth::user()->applicant) ? Auth::user()->applicant->portfolio : '' )}}">
        @error('portfolio')
            <p class="error-message">{{$message}}</p>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary mt-5 form-control" >Save Data</button>
</form>