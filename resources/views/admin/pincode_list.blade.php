<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Pincode</th>
            <th scope="col">Region</th>
            <th scope="col">State</th>
            <th scope="col">Delivery Days</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    @if(count($data) == 0)
    <tbody>
        <tr>
            <td class="text-center text-uppercase fw-bold text-dark" colspan="10">
                no data found
            </td>
        </tr>
    </tbody>
    @else
    <tbody>
        @php
        $i=1;
        @endphp
        @foreach($data as $pincode)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$pincode['pincodes']}}</td>
            <td>{{$pincode['region']}}</td>
            <td>{{$pincode['state']}}</td>
            <td>{{$pincode['estimated_time']}}</td>
            <td>
                <button type="button" class="cursor-pointer btn text-white" id="delete" onclick="Delete(`{{$pincode['id']}}`)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>