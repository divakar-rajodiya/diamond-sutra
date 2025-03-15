<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Message</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    @if(count($data) == 0)
        <tbody>
            <tr>
                <td class="text-center text-uppercase fw-bold text-dark" colspan="4">
                    no data found
                </td>
            </tr>
        </tbody>
    @else
    <tbody>
        @foreach($data as $user)
            <tr>
                <td>{{$user['name']}}</td>
                <td>{{$user['email']}}</td>
                <td>{{$user['message']}}</td>
                <td>{{explode('T',$user['created_at'])[0]}}</td>
                <td>
                     <i class="cursor-pointer fa-solid fa-trash" onclick="Delete(`{{$user['id']}}`)"></i>
                </td>
            </tr>
        @endforeach
    </tbody>
    @endif
</table>
