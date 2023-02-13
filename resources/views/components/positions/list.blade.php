<tr>
    <td>{{$position->name}}</td>
    <td>{{$position->english}}</td>
    <td class="description">{{$position->description}}</td>
    <td><div style="height: 60px; width: 60px; background-image: url({{ asset($position->user->logo) }});
      background-size: cover; background-position:center;"></div></td>
    @if (Auth::user()->role == "administrator" || Auth::user()->role == "data entry" || Auth::user()->role == "recruiter")
    <td class="visible">{{$position->visible}}</td>
    <td>
        <div class="d-flex justify-content-end">
          @if (Auth::user()->role != "recruiter")
          <form action="{{route('positions.destroy', $position)}}" class="mr-2" method="post">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-outline-danger rounded-0">Delete</button>
        </form> 
          @endif
            

           <button type="button" class="btn btn-outline-warning rounded-0" data-toggle="modal" 
           data-target="#editModal{{$position->id}}">Edit</button>
        
          <div class="modal fade" id="editModal{{$position->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5>Edit Position</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <x-positions.edit :position="$position" :customers="$customers"></x-positions.edit>
                </div>
              </div>
            </div>
          </div>
        </div>
       </td>
    @endif
</tr>