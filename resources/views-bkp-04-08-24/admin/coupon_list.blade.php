<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Coupon Name</th>
            <th scope="col">Discount Type</th>
            <th scope="col">Discount</th>
            <th scope="col">Expiry Time</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    @if(count($data) == 0)
    <tbody>
        <tr>
            <td class="text-center text-uppercase fw-bold text-dark" colspan="6">
            No data found!
            </td>
        </tr>
    </tbody>
    @else
    <tbody>
        @php
        $i = 1;
        @endphp
        @foreach($data as $coupon)
        <tr style="vertical-align: middle;">
            <td>{{$i++}}</td>
            <td>{{$coupon['coupon']}}</td>
            @if($coupon['discount_type'] == 1)
            <td>Percentage</td>
            @elseif($coupon['discount_type'] == 0)
            <td>Flat</td>
            @endif
            <td>{{$coupon['amount']}}</td>
            <td>{{$coupon['expiry_date']}}</td>
            @if($coupon['status'] == 1)
            <td><b>Active</b></td>
            @elseif($coupon['status'] == 0)
            <td><b>Inactive</b></td>
            @endif
            <td>
                <button type="button" class="btn text-white mb-1" id="edit" onclick="edit(`{{$coupon['id']}}`,`{{$coupon['coupon']}}`,`{{$coupon['discount_type']}}`,`{{$coupon['amount']}}`,`{{$coupon['expiry_date']}}`,`{{$coupon['status']}}`)"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                <button type="button" class="btn text-white mb-1" id="delete" onclick="Delete(`{{$coupon['id']}}`)"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>