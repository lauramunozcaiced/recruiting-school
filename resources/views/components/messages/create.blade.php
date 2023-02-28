@auth
<form id="messagesCreateForm" method="POST" action="{{ route('messages.store') }}" class="white-bg">
    @csrf
    <!-- Sender Field -->
    <div class="form-group ">
        <div>
            <input type="hidden" name="mode" value="{{$mode}}">
            <input type="hidden" name="sender" value="{{Auth::user()->id}}" required>
        </div>
    </div>

    <!-- Receiver Field -->
    <div class="form-group"> 
        <label for="receiver"><strong>To:</strong></label>
        <br>
        <select class="selectize-select" name="receiver" style="width: 100%"required>
            <option value="">Search a user to send</option>
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
            @endforeach
        </select>

        @error('receiver')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror

    </div>

    <!-- Subject Field -->
    <div class="form-group">
        <label for="subject"><strong>{{__('Subject')}}</strong></label>
        <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject"
                value="{{ old('subject') }}" required autocomplete="off" autofocus> 
        @error('subject') <small class="text-danger">{{$message}}</small> @enderror
    </div>

    <!-- Body Field -->
    <div class="form-group">
        <label for="message"><strong>Message</strong></label>
        <br>
        <input style="height:0; border:none; outline:none; width: 0;" type="text" name="message" id="quillMessage" required>
        <div id="quillEditor"></div>
       
        @error('message') <small class="text-danger">{{$message}}</small> @enderror
    </div>
    
    <div class="form-group text-right">
        <div>
            <button type="submit" class="btn bg-solvoblue text-white rounded-0">
                {{ __('Save') }}
            </button>
        </div>
    </div>

    <script>
        let quill = new Quill('#quillEditor',{
            modules: {
                toolbar: true
            },
            theme: "snow"
        });
        
        document.getElementById("quillEditor").addEventListener("focusout", function(){
            if(quill.root.innerHTML != '' && quill.root.innerHTML != '<p><br></p>'){
                document.getElementById('quillMessage').value = quill.root.innerHTML;
            }
        })

    </script>
    
</form>

@endauth

    