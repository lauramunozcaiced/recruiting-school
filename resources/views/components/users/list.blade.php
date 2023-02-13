@foreach ($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>
        <td>
            <div class="d-flex justify-content-end">
                @if (Auth::user()->id != $user->id)
                    <form action="{{ route('users.destroy', $user) }}" class="mr-2" method="post" onsubmit="if(confirm('Do you want delete this user?')){this.form.submit()}else{return false}">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger rounded-0">Delete</button>
                    </form>
                @endif
                <button type="button" class="btn btn-outline-warning rounded-0" data-toggle="modal"
                    data-target="#editModal{{ $user->id }}">
                    Edit
                </button>

                <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <x-users.edit :user="$user"></x-users.edit>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
@endforeach
