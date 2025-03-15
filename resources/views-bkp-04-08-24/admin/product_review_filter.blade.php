<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th>Review Image</th>
            <th>Product</th>
            <th>Username</th>
            <th>Order ID</th>
            <th>Rating</th>
            <th>Review</th>
            <th>Status</th>
            <th>Description</th>
            <th>Review Type</th>
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
        @endphp
        @foreach ($data as $r)

        <tr style="vertical-align: middle;">
            <td><img src="{{ $r['image1'] }}" height="50" width="50"><img src="{{ $r['image2'] }}" height="50" width="50"></td>
            <td>{{ $r['propduct']['product_sku'] }}</td>
            <td>{{ $r['user']['name'] }}</td>
            <td>{{ $r['order']['order_id'] ?? '' }}</td>
            <td>{{ $r['rating'] }}</td>
            <td>{{ $r['review'] }}</td>
            <td>
                @if(in_array($r['status'],['1','2']))
                    @if($r['status'] == 1)
                        Accept
                    @else
                        Decline
                    @endif
                @else
                <select class="form-select bg-transparent order_status" name="order_status" id="order_status" data-id="{{$r['id']}}">
                    <option value='0' {{ ($r['status'] == 0 ? 'selected' : '') }}>Pending</option>
                    <option value='1' {{ ($r['status'] == 1 ? 'selected' : '') }}>Accept</option>
                    <option value='2' {{ ($r['status'] == 2 ? 'selected' : '') }}>Decline</option>
                </select>
                @endif
            </td>
            <td>{{ substr($r['description'], 0, 25); }}....</td>
            <td>{{ ($r['type'] == 1 ?'Admin':'User'); }}</td>
            <td> <abbr title="{{ date('d-m-Y H:i:s', strtotime($r['created_at'])) }}">
                    <?php $ca = new Carbon($r['created_at']); ?>
                    {{ $ca->diffForHumans(Carbon::now()) }}
                </abbr></td>
            <td>
                @if($r['type'] == 1)
                    <button class="btn text-white mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Review" onclick="Editdata(`{{ $r['image1'] }}`,`{{ $r['image2'] }}`,`{{ $r['propduct']['product_sku'] }}`,`{{ $r['user']['name'] }}`,`{{ $r['order']['order_id'] ?? null }}`,`{{ $r['rating'] }}`,`{{ $r['review'] }}`,`{{ $r['description'] }}`)"> <i class="fa fa-pencil" aria-hidden="true"></i></button>
                @else
                    <button class="btn text-white mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="View Review" onclick="ViewReview(`{{ $r['image1'] }}`,`{{ $r['image2'] }}`,`{{ $r['propduct']['product_sku'] }}`,`{{ $r['user']['name'] }}`,`{{ $r['order']['order_id'] ?? null }}`,`{{ $r['rating'] }}`,`{{ $r['review'] }}`,`{{ $r['description'] }}`)"> <i class="fa fa-eye" aria-hidden="true"></i></button>
                @endif
                <button class="btn text-white mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="Delete(`{{$r['id']}}`)"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
    @endif
</table>

<script>
     var productUrl = `{{ url('admin/filter-product-review') }}`;
        $(document).ready(function() {
            $('.order_status').change(function() {
                var order_status = $(this).val();
                $.ajax({
                    url: `{{ url('admin/product-review-status') }}`,
                    method: 'POST',
                    data: {
                        order_status: order_status,
                        update_id: $(this).attr('data-id'),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        Toast(res.msg, 3000, res.flag);
                        filterData(productUrl, "order-table");
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
</script>