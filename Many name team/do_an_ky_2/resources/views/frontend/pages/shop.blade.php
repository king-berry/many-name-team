@extends('frontend.layout')

@section('content')
    <!-- Start Product Grid -->
    <section class="htc__product__grid bg__white ptb--100">

        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">
                    <div class="htc__product__rightidebar">
                        <!-- Start Product View -->
                        <div class="row">
                            <div class="shop__grid__view__wrap">
                                <div class="single-grid-view tab-pane fade in active clearfix" id="show-filter">
                                    @foreach ($data as $item)
                                        <!-- Start Single Product -->
                                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-6" style="height: 390px">
                                            @include('frontend.libs.product')
                                        </div>
                                        <!-- End Single Product -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- End Product View -->
                    </div>
                    <!-- Start Pagenation -->
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="htc__pagenation">
                                {{$data->render()}}
                            </ul>
                        </div>
                    </div>
                    <!-- End Pagenation -->
                </div>
                <div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 col-sm-12 col-xs-12 smt-40 xmt-40">
                    <div class="htc__product__leftsidebar">
                        <!-- Start Category Area -->
                        <div class="htc__category">
                            <h4 class="title__line--4">Loại Sản Phẩm</h4>
                            <ul class="ht__cat__list">
                                @foreach ($dataCategory as $item)
                                <li><a href="/shop/category/{{$item->category_id}}">{{$item->category_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Category Area -->
                        <!-- Start Category Area -->
                        <div class="htc__category">
                            <h4 class="title__line--4">BỘ SƯU TẬP</h4>
                            <ul class="ht__cat__list">
                                @foreach ($dataBrand as $item)
                                <li><a href="/shop/brand/{{$item->brand_id}}">{{$item->brand_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Category Area -->
                        <!-- Start Best Sell Area -->
                        <div class="htc__recent__product">
                            <h2 class="title__line--4">Khuyến mãi</h2>
                            <div class="htc__recent__product__inner">
                                @foreach ($dataProductSales as $item)
                                <!-- Start Single Product -->
                                <div class="htc__best__product">
                                    <div class="htc__best__pro__thumb">
                                        <a href="/shop/product/{{$item->product_id}}-{{Str::slug($item->product_name, '-')}}.html">
                                            <img style="max-width: 100px; height: 120px" src="{{$item->product_image}}" alt="small product">
                                        </a>
                                    </div>
                                    <div class="htc__best__product__details">
                                        <h2><a href="/shop/product/{{$item->product_id}}-{{Str::slug($item->product_name, '-')}}.html">{{$item->product_name}}</a></h2>
                                        <ul class="rating">
                                            Giảm: {{$item->product_sale}}%
                                        </ul>
                                        <ul  class="pro__prize">
                                            <li>{{number_format($item->product_price_sell)}} $</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Single Product -->
                                @endforeach

                            </div>
                        </div>
                        <!-- End Best Sell Area -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Grid -->
@endsection


@section('script')
    <script>
        $('#sort').change(function(){
            var sort_by = $(this).val()
            // alert(sort_by)
            if(sort_by){
                window.location = sort_by
            }
            return false
        })

        $('.add_to_cart').click(function () {
            var id = $(this).data('id');
            // alert(id);
            var _token = $('input[name=_token]').val();
            var cart_product = $('.cart_product_' + id).val();
            var cart_price = $('.cart_price_' + id).val();
            var cart_price_sale = $('.cart_price_sale_' + id).val();
            var cart_amount = $('.cart_amount_' + id).val();
            var cart_quantity = $('.cart_quantity_' + id).val();
            var cart_image = $('.cart_image_' + id).val();

            $.ajax({
                url: 'add_to_cart',
                method: 'POST',
                data: {
                    _token: _token,
                    cart_id: id,
                    cart_product: cart_product,
                    cart_price: cart_price,
                    cart_price_sale: cart_price_sale,
                    cart_amount: cart_amount,
                    cart_quantity: cart_quantity,
                    cart_image: cart_image,
                },
                success: function () {
                    //
                    Swal.fire('Thêm giỏ hàng thành công')
                    //
                }
            })

        })

        $('.handle_wishlist').click(function(){
            var product_id = $(this).data('product_id');
            var _token = $('input[name=_token]').val();

            $.ajax({
                url: 'handle-wishlist',
                method: 'POST',
                data: {
                    _token: _token,
                    product_id: product_id,
                },
                success: function(data){
                    Swal.fire(data)
                }
            })
        })
    </script>
@endsection
