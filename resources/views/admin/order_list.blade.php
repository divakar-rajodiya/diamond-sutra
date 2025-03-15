<table class="table text-dark fs-14">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">Order Id</th>
            <th scope="col">User Name</th>
            <th scope="col">Order Total</th>
            <th scope="col">Payment Status</th>
            <th scope="col">Order Date</th>
            <th scope="col">Order Time</th>
            <th scope="col">Action</th>
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
        @foreach($data as $order)
        <tr style="vertical-align: middle;">
            <td>{{$order['order_id']}}</td>
            <td>{{$order['user']['name']}}</td>
            <td>{{$order['order_total']}}</td>
            <!--  -->
            @if($order['payment_status'] == 0)
            <td>Pending</td>
            @elseif($order['payment_status'] == 1)
            <td>Success</td>
            @elseif($order['payment_status'] == 2)
            <td>Failed</td>
            @endif
            <td>{{ date('Y-m-d',strtotime($order['created_at'])) }}</td>
            <td>{{ date('H:i A',strtotime($order['created_at'])) }}</td>
            <td>
                <a href="{{url('admin/order/detail/').'/'.$order['order_id']}}" title="View Order Details">
                    <button class="btn text-white"> <i class="fa fa-eye" aria-hidden="true"></i> </button>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>
<!-- Track Order Modal -->
<div class="modal fade" id="trackOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="trackOrderLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-light text-dark">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="trackOrderLabel">Add Tracking URL</h1>
                <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="save-tracking-form" method="post" action="">
                    <input type="hidden" name="order_status" id="order_status_val">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="form-floating w-100 mb-3">
                        <input type="text" class="form-control bg-transparent" name="order_tracking" id="order_tracking" placeholder="Enter Tracking URL">
                        <label for="category_name">Enter Tracking URL</label>
                    </div>
                    <button type="button" id="tracking-order-btn-admin" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3" onclick="ChangeStatus()">Add <span id="tracking-spinner" style="display:none"><i class="fas fa-spinner fa-spin"></i></span></button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var orderListUrl = `{{url('admin/order/list')}}`;

    function ChangeStatus() {
        $('#tracking-spinner').show();
        $("#tracking-order-btn-admin").prop("disabled", true);
        $.ajax({
            url: `{{ url('admin/order-status/update') }}`,
            method: 'POST',
            data: {
                order_status: $('#order_status_val').val(),
                update_id: $('#update_id').val(),
                order_tracking: $('#order_tracking').val(),
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                Toast(res.msg, 3000, res.flag);
                $('#tracking-spinner').hide();
                $("#tracking-order-btn-admin").prop("disabled", false);
                $("#save-tracking-form")[0].reset();
                $("#trackOrder").modal("hide");
                filterData(orderListUrl, "order-table");
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    };
    $(document).ready(function() {
        $('.order_status').change(function() {
            $(this).next().show();
            $(this).attr('disabled', 'disabled');
            var order_status = $(this).val();
            if (order_status == 2) {
                $('#order_status_val').val(order_status);
                $('#update_id').val($(this).attr('data-id'));
                $('#trackOrder').modal('show');
                $(this).next().hide();
                $(this).prop("disabled", false);
                return false;
            } else {
                $.ajax({
                    url: `{{ url('admin/order-status/update') }}`,
                    method: 'POST',
                    data: {
                        order_status: order_status,
                        update_id: $(this).attr('data-id'),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        Toast(res.msg, 3000, res.flag);
                        filterData(orderListUrl, "order-table");
                        $(this).next().hide();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });


</script>