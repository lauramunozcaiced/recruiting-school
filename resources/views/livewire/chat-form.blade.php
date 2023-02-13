
<div>
@auth
<div class="form">
    <input type="hidden" id="receiver" wire:model="receiver">
    <label><strong>From:</strong> {{Auth::user()->email}}</label>

    <div class="form-group">
        <label for="listUser"><strong>To:</strong></label>      
        <input type="text" class="form-control" list="Users" id="listUser" 
        placeholder="Search and choose another user..." required autocomplete="off">

        <datalist id="Users">
            @foreach ($users as $user)
                <option data-value="{{$user->id}}" value="{{$user->name}} - {{$user->email}}">
            @endforeach
        </datalist>

        @error('receiver') <small class="text-danger">{{$message}}</small> @enderror

    </div>

    <div class="form-group">
        <label for="subject"><strong>Subject:</strong></label>
        <input type="text" class="form-control" id="title ">
    </div>

   <div class="form-group">
        <label for="message"><strong>Message</strong></label>
        <textarea class="form-control"  name="message" id="message" wire:model="message" cols="30" rows="10" required></textarea>
        @error('message') <small class="text-danger">{{$message}}</small> @enderror
    </div>

    <button class="btn bg-solvoblue text-white rounded-0"  wire:click="sendMessage">Send</button>

    <div style="position: absolute;" class="alert alert-success collapse mt-3" role="alert"
    id="adviceSuccess"> Se ha enviado el mensaje
    </div>
</div>
@endauth
    <script>
        window.livewire.on('sendedMessage', function(){
            jQuery('#adviceSuccess').fadeIn("slow");
    
            setTimeout(() => {
               jQuery('#adviceSuccess').fadeOut("slow");
            }, 3000);
        })
        
        const listUser = document.getElementById('listUser');
        
        listUser.addEventListener('change',function(){
            document.querySelectorAll('#Users option').forEach(element => {
                if(element.value == listUser.value){
                    @this.set('receiver', element.getAttribute('data-value'));
                }
            });
           
        })
        
    
    </script>
</div>
