@extends('layouts.admin')
@section('content')
@php
$product = $body['product'];
@endphp
<div class="layout-sidenav-content">
    <div class="p-4 p-md-5">
        <div class="md-form-group float-label">
            <input type="text" class="md-input d-none" name="email_broadcas" id="site_content_ck">
        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="card p-4 bg-light text-dark">
                    <h3 class="mb-4 fw-bold"></h3>
                    <form id="update_product_form" method="post" action="{{url('admin/product/update')}}" onsubmit="return false;">
                        @csrf
                        <div class="row gy-3 gy-md-4">
                            <div class="col-6">
                                <div class="form-floating w-100">
                                    <input type="hidden" name="product_id" value="{{$product['id']}}">
                                    <input type="text" class="form-control bg-transparent" id="productName" name="product_name" placeholder="Name" value="{{$product['name']}}">
                                    <label for="productName">Product Name</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <select class="form-select bg-transparent" name="category_id" id="categorySelect" aria-label="Floating label select example">
                                        @foreach($body['category'] as $category)
                                        <option value="{{$category['id']}}" {{$category['id'] == $product['category_id'] ? 'select' : ''}}>{{$category['name']}}</option>
                                        @endforeach
                                    </select>
                                    <label for="Category">Category</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="p-3 mb-3" style="border-radius: 10px;border: 1px solid rgba(0, 0, 0, 0.2)">
                                    <label for="multiple">Sub Category</label>
                                    <select class="form-select bg-transparent" name="sub_category[]" id="multiple" data-choices="data-choices" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                                        @foreach($body['sub_category'] as $sc)
                                        <option value="{{$sc['id']}}">{{$sc['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="p-3 mb-3" style="border-radius: 10px;border: 1px solid rgba(0, 0, 0, 0.2)">
                                    <label for="multiple">Related Products</label>
                                    <select class="form-select bg-transparent" name="related_products[]" id="multiple_related" data-choices="data-choices" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                                        @foreach($body['related_products'] as $p)
                                        <option value="{{$p['id']}}">{{$p['product_sku'] .' ('. $p['default_color'].')'}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control bg-transparent" placeholder="product description" name="description" id="description" style="height: 100px">{{$product['description']}}</textarea>
                                    <label for="description">Product Description</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control bg-transparent" placeholder="product colors" name="colors" id="colors" style="height: 100px">{{$product['color']}}</textarea>
                                    <label for="colors">Product Color</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control bg-transparent" placeholder="product videos" name="videos" id="videos" style="height: 100px">{{$product['video']}}</textarea>
                                    <label for="videos">Product Videos</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating w-100">
                                    <input type="number" class="form-control bg-transparent" name="gold_weight_18" id="weight" placeholder="weight" value="{{$product['gold_weight_18k']}}">
                                    <label for="weight">18K Gold Weight</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating w-100">
                                    <input type="number" class="form-control bg-transparent" name="gold_weight_14" id="weight" placeholder="weight" value="{{$product['gold_weight_14k']}}">
                                    <label for="weight">14K Gold Weight</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating w-100">
                                    <input type="number" class="form-control bg-transparent" id="weight" placeholder="weight" value="{{$product['making_charges']}}">
                                    <label for="weight">Making Charges</label>
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <div class="form-floating w-100">
                                    <input type="text" class="form-control bg-transparent" name="dimension" id="dimension" placeholder="Product Dimension" value="{{$product['dimension']}}">
                                    <label for="dimension">Product Dimension</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating w-100">
                                    <input type="text" class="form-control bg-transparent text-success" id="dimension-sample" placeholder="Product Dimension" value='{"height":0.0, "width":0.0}' readonly>
                                    <label for="diamond-sample" class="text-warning">Dimension Sample</label>
                                </div>
                            </div>

                            @php
                            $diamond = json_decode($product['diamond'],true);
                            @endphp
                            <hr>
                            <h3>Diamond</h3>
                           
                            <div class="col-md-12">
                                <div class="form-floating w-100">
                                    <input type="text" class="form-control bg-transparent" id="diamond" name="diamond" placeholder="Product Diamond" value="{{$product['diamond']}}">
                                    <label for="diamond">Product Diamond</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating w-100">
                                    <input type="text" class="form-control bg-transparent text-success" id="diamond-sample" placeholder="Product Diamond" value='[{"carat":0.000,"quantity":0,"shape":"none"}]' readonly>
                                    <label for="diamond-sample" class="text-warning">Diamond Sample</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating w-100">
                                    <input type="text" class="form-control bg-transparent text-success" id="diamond-price-sample" placeholder="Product diamond" value='[{"carat":0.000,"quantity":0,"shape":"none","price_IJ_SI":0.0, "price_GH_SI":0.0, "price_GH_VS":0.0, "price_EF_VVS":0.0}]' readonly>
                                    <label for="diamond-price-sample" class="text-warning">Diamond Sample with price</label>
                                </div>
                            </div>

                            <hr>
                            <h3>Stone</h3>
                            <div class="col-md-12">
                                <div class="form-floating w-100">
                                    <input type="text" class="form-control bg-transparent" name="stone" id="stone" placeholder="Product Stone" value="{{$product['stone']}}">
                                    <label for="stone">Product Stone</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating w-100">
                                    <input type="text" class="form-control bg-transparent text-success" id="stone-sample" placeholder="Product Stone" value='[{"carat":0.00,"quantity":5,"shape":"round","type":"Natural Pearl","price":0,"color":"white"}]' readonly>
                                    <label for="stone-sample" class="text-warning">Stone Sample</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="liked" name="is_most_liked" {{$product['is_most_liked'] ? 'checked' : ''}}>
                                        <label class="form-check-label" for="color"> Most Liked</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="selling" name="is_most_selling" {{$product['is_most_selling'] ? 'checked' : ''}}>
                                        <label class="form-check-label" for="color1"> Most Selling </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="recomended" name="is_recommended" {{$product['is_recommended'] ? 'checked' : ''}}>
                                        <label class="form-check-label" for="color2"> Recomended</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes" id="solitaire" name="is_solitaire" {{$product['is_solitaire'] == 'yes' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="color2"> Solitaire Preset</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes" id="solitaire_setting" name="solitaire_setting" {{$product['solitaire_setting'] == 'yes' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="color2"> Solitaire Setting</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button id="update_product_btn" type="button" class="btn btn-dark py-2 text-uppercase w-100 rounded-3 fw-bold">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let subcategoryData = `{{$body['subcategory']}}`;
        var getSubCategory = `{{url('admin/subcategory/get')}}`;

        let relatedData = `{{$product['related_items']}}`;
    </script>
    @endsection
    @section('footer')
    <script>
        $(document).on('click', '#update_product_btn', function() {
            $('#update_product_btn').prop('disabled', true);
            $('#update_product_form').ajaxForm(function(res) {
                Toast(res.msg, 3000, res.flag);
                $('#update_product_btn').prop('disabled', false);
            }).submit();
        })
    </script>
    @stop