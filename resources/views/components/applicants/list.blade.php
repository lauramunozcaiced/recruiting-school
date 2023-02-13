
<tr>
    <td><div style="height: 60px; width: 70px; background-image: url({{ asset($applicant->image) }});
        background-size: cover; background-position:center;"></div></td>
    <td>{{ $applicant->firstname }} {{ $applicant->lastname }}</td>
    <td>{{ $applicant->identification }}</td>
    <td>{{ $applicant->title }}</td>
    <td>{{ $applicant->email }}</td>
    <td>{{ $applicant->location }}</td>
    <td>
        <form action="{{ route('applicants.destroy', $applicant->id) }}"  method="post" onsubmit="if(confirm('Do you want delete this applicant?')){this.form.submit()}else{return false}">
        @method('delete')
        @csrf
        <input type="hidden" name="view" value="list">
        <button type="submit" class="btn btn-outline-danger rounded-0">Delete</button>
        </form>
    </td>
</tr>
        