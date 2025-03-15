<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">Email</th>
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
                <td>{{$user['email']}}</td>
            </tr>
        @endforeach
    </tbody>
    @endif
</table>
