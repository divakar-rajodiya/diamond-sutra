<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">Category Name</th>
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
        @foreach($data as $category)
        <tr>
            <td>{{$category['name']}}</td>
            @if($category['status'] == 1)
            <td>Active</td>
            @elseif($category['status'] == 0)
            <td>Inactive</td>
            @endif
            <td>
                <button type="button" class="btn text-white" id="edit" onclick="edit(`{{$category['id']}}`,`{{$category['name']}}`,`{{$category['status']}}`)">Edit</button>
                <!-- <button type="button" class="btn text-white" id="delete" onclick="Delete(`{{$category['id']}}`)">Delete</button> -->
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>