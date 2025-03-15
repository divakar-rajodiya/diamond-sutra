<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">Subcategory Name</th>
            <th scope="col">Category Name</th>
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
        @foreach($data as $sc)
        <tr>
            <td>{{$sc['name']}}</td>
            <td>{{$sc['category']['name']}}</td>
            <td>
                <button type="button" class="btn text-white" id="edit" onclick="edit(`{{$sc['id']}}`,`{{$sc['category']['id']}}`,`{{$sc['name']}}`)">Edit</button>
                <!-- <button type="button" class="btn text-white" id="delete" onclick="Delete(`{{$sc['id']}}`)">Delete</button> -->
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>