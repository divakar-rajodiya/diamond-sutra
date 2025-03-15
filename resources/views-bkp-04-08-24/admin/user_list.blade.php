<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Number</th>
            <th scope="col">Status</th>
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
            <td>{{$user['number']}}</td>
            @if($user['status'] == 0)
            <td>Inactive</td>
            @elseif($user['status'] == 1)
            <td>Active</td>
            @elseif($user['status'] == 2)
            <td>Rejected</td>
            @else
            <td>-</td>
            @endif
        </tr>
        @endforeach
    </tbody>
    @endif
</table>