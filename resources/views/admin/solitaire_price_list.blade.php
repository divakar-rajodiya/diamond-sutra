<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">Clarity</th>
            <th scope="col">Carat</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    @if(count($data) == 0)
    <tbody>
        <tr>
            <td class="text-center text-uppercase fw-bold text-dark" colspan="6">
                no data found
            </td>
        </tr>
    </tbody>
    @else
    <tbody>
        @foreach($data as $solitaire_price)
        <tr>
            <td>{{config('constant.'.$solitaire_price['clarity'])}}</td>
            <td>{{$solitaire_price['carat']}}</td>
            <td>{{$solitaire_price['price']}}</td>   
            <td>
                <button type="button" class="btn text-white" id="edit" onclick="edit(`{{$solitaire_price['id']}}`,`{{$solitaire_price['price']}}`,`{{config('constant.'.$solitaire_price['clarity']).' - '. $solitaire_price['carat']}}`)">Edit</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>