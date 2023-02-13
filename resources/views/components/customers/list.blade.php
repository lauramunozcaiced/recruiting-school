@foreach ($users as $user)
<tr>
    <td><div style="height: 60px; width: 60px; background-image: url({{ asset($user->logo) }});
        background-size: cover; background-position:center;"></div></td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->role }}</td>
    <td>
        <div class="d-flex justify-content-end">
            <form action="{{ route('customers.destroy', $user) }}" class="mr-2" method="post" onsubmit="if(confirm('Do you want delete this client?')){this.form.submit()}else{return false;}">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-outline-danger rounded-0">Delete</button>
            </form>
            <button type="button" class="btn btn-outline-warning rounded-0" data-toggle="modal"
                    data-target="#editModal{{ $user->id }}">
                    Edit
                </button>
                
            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Edit Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <x-customers.edit :customer="$user"></x-customers.edit>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
@endforeach
