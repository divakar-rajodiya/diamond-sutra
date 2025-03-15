
    <colgroup>
        <col style="width: 84.0312px;">
        <col style="width: 77.8438px;">
        <col style="width: 100.906px;">
        <col style="width: 84.0312px;">
        <col style="width: 73.5938px;">
        <col style="width: 78.0781px;">
        <col style="width: 80.4531px;">
        <col style="width: 132.047px;">
        <col style="width: 111.812px;">
        <col style="width: 111.812px;">
        <col style="width: 139.578px;">
        <col style="width: 86.625px;">
    </colgroup>
    <thead>
        <tr role="row">
            <th data-dt-column="0" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc dt-ordering-asc"
                aria-sort="ascending" aria-label="Shape: Activate to invert sorting" tabindex="0"><span
                    class="dt-column-title" role="button">Shape</span><span class="dt-column-order"></span></th>
            <th data-dt-column="1" rowspan="1" colspan="1" class="dt-type-numeric dt-orderable-asc dt-orderable-desc"
                aria-label="Carat: Activate to sort" tabindex="0"><span class="dt-column-title"
                    role="button">Carat</span><span class="dt-column-order"></span></th>
            <th data-dt-column="2" rowspan="1" colspan="1" class="dt-type-numeric dt-orderable-asc dt-orderable-desc"
                aria-label="Price(₹): Activate to sort" tabindex="0"><span class="dt-column-title"
                    role="button">Price(₹)</span><span class="dt-column-order"></span></th>
            <th data-dt-column="3" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc"
                aria-label="Clarity: Activate to sort" tabindex="0"><span class="dt-column-title"
                    role="button">Clarity</span><span class="dt-column-order"></span></th>
            <th data-dt-column="4" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc"
                aria-label="Cut: Activate to sort" tabindex="0"><span class="dt-column-title"
                    role="button">Cut</span><span class="dt-column-order"></span></th>
            <th data-dt-column="5" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc"
                aria-label="Color: Activate to sort" tabindex="0"><span class="dt-column-title"
                    role="button">Color</span><span class="dt-column-order"></span></th>
            <th data-dt-column="6" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc"
                aria-label="Polish: Activate to sort" tabindex="0"><span class="dt-column-title"
                    role="button">Polish</span><span class="dt-column-order"></span></th>
            <th data-dt-column="7" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc"
                aria-label="Flourescence: Activate to sort" tabindex="0"><span class="dt-column-title"
                    role="button">Flourescence</span><span class="dt-column-order"></span></th>
            <th data-dt-column="8" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc"
                aria-label="Certificate Type: Activate to sort" tabindex="0"><span class="dt-column-title"
                    role="button">Certificate Type</span><span class="dt-column-order"></span></th>
            <th data-dt-column="9" rowspan="1" colspan="1" class="dt-type-numeric dt-orderable-asc dt-orderable-desc"
                aria-label="Certificate No.: Activate to sort" tabindex="0"><span class="dt-column-title"
                    role="button">Certificate No.</span><span class="dt-column-order"></span></th>
            <th data-dt-column="10" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc"
                aria-label="Measurements: Activate to sort" tabindex="0"><span class="dt-column-title"
                    role="button">Measurements</span><span class="dt-column-order"></span></th>
            <th data-dt-column="11" rowspan="1" colspan="1" class="dt-type-numeric dt-orderable-asc dt-orderable-desc"
                aria-label="View: Activate to sort" tabindex="0"><span class="dt-column-title"
                    role="button">View</span><span class="dt-column-order"></span></th>
        </tr>
    </thead>
    @if(count($data) == 0)
    <tbody>
        <tr>
            <td class="text-center text-uppercase fw-bold text-dark" colspan="11">
                no data found
            </td>
        </tr>
    </tbody>
    @else
    <tbody>
        @php
        $i=1;
        @endphp
        @foreach($data as $r)
        <tr>
            <td class="sorting_1">{{$r['DisplayShape']}}</td>
            <td class="dt-type-numeric">{{$r['Weight']}}</td>   
            <td class="dt-type-numeric">{{$r['Price']}}</td>
            <td>{{$r['Clarity']}}</td>
            <td>{{$r['Cut']}}</td>
            <td>{{$r['Color']}}</td>
            <td>{{$r['Pol']}}</td>
            <td>{{$r['FL']}}</td>
            <td>{{$r['Cert']}}</td>
            <td class="dt-type-numeric">{{$r['CertNo']}}</td>
            <td>{{$r['Diameter']}}</td>
            <td class="dt-type-numeric"><button class="btn btn-link view-solitair-btn" data-diamond="r"
                    data-id="{{$r['RefNo']}}">View Details</button></td>
        </tr>
    
        @endforeach
        @endphp
     
    </tbody>
    @endif
    <tfoot></tfoot>