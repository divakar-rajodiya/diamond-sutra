@if ($total_record > 0)
@foreach ($data as $product)
  <div class="col-6 col-lg-4 col-xl-3">
      <a href="{{url('').'/'.$product['category']['name'].'/'.$product['product_sku'].'/'.$product['default_color'].'-gold'.'/'.str_replace(' ', '-',$product['name'])}}">
          <div class="single-product-card">
              <div class="product-img">
                  @php $color = config('constant.COLOR_CODE.'.$product['default_color']);@endphp
                  <img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_'.$color.'1.webp'}}" class="image-main" alt="">
                  <img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_Model_'.$color.'.webp'}}" class="image-hover" alt="">
              </div>
              <div class="product-content">
                  <a href="{{url('').'/'.$product['category']['name'].'/'.$product['product_sku'].'/'.$product['default_color'].'-gold'.'/'.str_replace(' ', '-',$product['name'])}}" class="product-title">{{$product['name']}}</a>
                  <div class="d-flex justify-content-between align-items-center">
                      <div class="proPrice">
                          {{\General::currency_format($product['product_buy_price'])}}
                      </div>
                      <!-- <button class="like-btn @if($product['wishlist'] == 'yes') {{'fill-heart'}} @endif" data-id="{{$product['id']}}">
                                        <i class="fa-regular fa-heart"></i>
                                    </button> -->
                  </div>
              </div>
          </div>
      </a>
  </div>
  @endforeach
  @else
  <div class="col-12 col-lg-12 col-xl-12">
       <center>No Product Found!</center>   
  </div>

  @endif
