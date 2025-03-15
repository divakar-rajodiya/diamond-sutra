<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Banner Image</th>
            <th scope="col">Banner Link</th>
            <th scope="col">Sort Order</th>
            <th scope="col">Actions</th>
        </tr>
</thead>
    @if(count($data) == 0)
    <tbody>
        <tr>
            <td class="text-center text-uppercase fw-bold text-dark" colspan="3">
            No data found!
            </td>
        </tr>
    </tbody>
    @else
    <tbody>
        @php
        $i=1;
        @endphp
        @foreach($data as $banner)
<<<<<<< HEAD
        <tr>
            <td>{{$banner['sort_order']}}</td>
            <td><img src="{{ $banner['image']}}" height="100" width="100"/></td>
=======
        <tr style="vertical-align: middle;">
            <td>{{$i++}}</td>
            <td><img src="{{ $banner['image'] }}" height="" width="150"></td>
>>>>>>> 3808804 (code merge)
            <td><a href="{{$banner['link']}}" target="_blank" rel="noopener noreferrer">{{$banner['link']}}</a></td>
            <td>{{$banner['sort_order']}}</td>
            <td>
                <button type="button" class="btn text-white mb-1" id="edit" onclick="edit(`{{$banner['id']}}`,`{{$banner['image']}}`,`{{$banner['sort_order']}}`,`{{$banner['link']}}`)"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                <button type="button" class="btn text-white mb-1" id="delete" onclick="Delete(`{{$banner['id']}}`)"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>