<h6 class="mt-2 mb-1 text-uppercase font-weight-bold">My matches</h6>
<table class="table matches-table">
      <thead>
       <th>Suggested to</th>
         <th>Client</th>
         <th>Created by</th>
         <th></th>
      </thead>
      <tbody>
         @foreach ($applicant->matches as $match)
            @if ($match->user->id == Auth::user()->id)
                 <tr>
                     <td>{{ $match->position->name }}</td>
                     <td>{{ $match->position->user->name }}</td>
                     <td>{{ $match->user->name }}</td>
                     <td>
                       <div class="d-flex align-items-center">
                           <form action="{{ route('matches.destroy', $match->id) }}" method="post" onsubmit="if(confirm('Do you want delete ths match?')){this.form.submit()}else{return false;}">
                               @method('delete')
                               @csrf
                               <button type="submit" class="btn text-danger d-flex align-items-center p-2"><i
                                       class="fa fa-trash mr-1"></i>Delete</button>
                           </form>
                       </div>
                   </td>
                 </tr>
            @endif
         @endforeach
     </tbody>
 </table>
     <h6 class="mb-1 text-uppercase font-weight-bold">Other Matches</h6>
     <table class="table matches-table">
          <thead>
              <th>Suggested to</th>
              <th>Client</th>
              <th>Created by</th>
          </thead>
          <tbody>
              @foreach ($applicant->matches as $match)
                @if ($match->user->id != Auth::user()->id)
                      <tr>
                          <td>{{ $match->position->name }}</td>
                          <td>{{ $match->position->user->name }}</td>
                          <td>{{ $match->user->name }}</td>
                      </tr>
                @endif
              @endforeach
          </tbody>
     </table>
 