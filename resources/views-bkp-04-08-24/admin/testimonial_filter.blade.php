<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th>No</th>
            <th>Testimonial Image</th>
            <th>Client Name</th>
            <th>Client Designation</th>
            <th>Client Rating</th>
            <th>Client Message</th>
            <th>Created Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    @if(count($data) == 0)
        <tbody>
            <tr>
                <td class="text-center text-uppercase fw-bold text-dark" colspan="8">
                    No data found!
                </td>
            </tr>
        </tbody>
    @else
    <tbody>
        @php
        $i=1;
        @endphp
        @foreach ($data as $r)
        <tr style="vertical-align: middle;">
            <td>{{$i++}}</td>
            <td><img src="{{ $r['testimonial_image'] }}" height="100" width="100"></td>
            <td>{{ $r['client_name'] }}</td>
            <td>{{ $r['designation'] }}</td>
            <td>{{ $r['rating'] }}</td>
            <td>{{ substr($r['msg'], 0, 25); }}....</td>
            <td> <abbr title="{{ date('d-m-Y H:i:s', strtotime($r['created_at'])) }}">
                    <?php $ca = new Carbon($r['created_at']); ?>
                    {{ $ca->diffForHumans(Carbon::now()) }}
                </abbr></td>
            <td>
                <button class="btn text-white mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" onclick="Editdata(`{{$r['id']}}`,`{{$r['testimonial_image']}}`,`{{$r['client_name']}}`,`{{$r['designation']}}`,`{{$r['rating']}}`,`{{$r['msg']}}`)"> <i class="fa fa-pencil" aria-hidden="true"></i></button>
                <button class="btn text-white mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="Delete(`{{$r['id']}}`)"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
    @endif
</table>
