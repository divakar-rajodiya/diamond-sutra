<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">Product SKU</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Material</th>
            <th scope="col">gold 18k</th>
            <th scope="col">gold 14k</th>
            <th scope="col">Making Charges</th>
            <th scope="col">Quantity</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
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
        @foreach($data as $product)
        <tr>
            <td><a href="{{url('admin/product/detail/').'/'.$product['id']}}">{{$product['product_sku']}} </a>({{config('constant.COLOR_CODE.'.$product['default_color'])}})</td>
            <td>{{$product['name']}}</td>
            <td>{{$product['category']['name']}}</td>
            <td>{{$product['material']}}</td>
            <td>{{$product['gold_weight_18k']}}</td>
            <td>{{$product['gold_weight_14k']}}</td>
            <td>{{$product['making_charges']}}</td>
            <td>{{$product['quantity']}}</td>
            @if($product['status'] == 1)
            <td>Active</td>
            @elseif($product['status'] == 2)
            <td>Inactive</td>
            @endif
            <td>
            <!-- <i class="cursor-pointer fa-solid fa-pencil"></i><span class="p-2"></span> -->
            <i class="cursor-pointer fa-solid fa-trash" style="cursor: pointer;" onclick="Delete(`{{$product['id']}}`)"></i>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>