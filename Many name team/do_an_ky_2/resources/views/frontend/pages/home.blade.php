@extends('frontend.layout')

@section('content')
    @include('frontend.note')
    <!-- Start Slider Area -->
    <div class="slider__container slider--one bg__cat--3">
        <div class="slide__container slider__activation__wrap owl-carousel">
            @foreach ($dataSilde as $slide)
            <!-- Start Single Slide -->
            <div class="single__slide animation__style01 slider__fixed--height">
                <div class="container">
                    <div class="row align-items__center">
                        <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                            <div class="slide">
                                <div class="slider__inner">
                                    <h1>{{$slide->slide_title}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                            <div class="slide__thumb">
                                <img src="{{$slide->image}}" alt="slider images Fashion Lifestyle">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Slide -->
            @endforeach
        </div>
    </div>
    <!-- Start Slider Area -->
    <!-- Start Product new Area -->
    <section class="htc__category__area ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">SẢN PHẨM MỚI</h2>
                    </div>
                </div>
            </div>
            <div class="htc__product__container">
                <div class="row">
                    <div class="product__list clearfix mt--30">
                        @foreach ($dataProductNews as $item)
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-6" style="height: 390px">
                            @include('frontend.libs.product')
                            </div>
                            <!-- End Single Category -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product new Area -->
    <!-- Start Banner Area -->
    @if ($dataBanner != null)
    <section class="ftr__product__area ptb--50">
        <div class="container-fluid">
            <center>
                <a href="{{$dataBanner->target}}"><img style="max-width: 100%" src="{{$dataBanner->image}}" alt="{{$dataBanner->title}}"></a>
            </center>
        </div>
    </section>
    @endif
    <!-- End Banner Area -->
    <!-- Start Blog Area -->
    <section class="ftr__product__area ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">BÀI VIẾT MỚI NHẤT</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="product__list clearfix mt--30">
                    @foreach ($dataPost as $item)
                        <!-- Start Single Category -->
                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-6" style="height: 390px">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                    <span class="sale-span">New</span>
                                    <a href="/blog/{{$item->id}}-{{Str::slug($item->post_title, '-')}}.html">
                                        <img style="max-width: 260px; height: 260px" src="{{$item->post_image}}" alt="{{$item->post_title}}">
                                    </a>
                                </div>
                                <div class="fr__product__inner" style="margin-top: -15px">
                                    <ul class="fr__pro__prize">
                                        <li><a style="font-size: 10px" href="/shop/blog/{{$item->id}}-{{Str::slug($item->post_title, '-')}}.html">Ngày đăng:
                                            @php
                                                $old_date = strtotime($item->created_at);
                                                $new_date = date('d/m/Y', $old_date);
                                                echo $new_date
                                            @endphp
                                        </a></li>
                                    </ul>
                                    <h4><a href="/blog/{{$item->id}}-{{Str::slug($item->post_title, '-')}}.html"><i style="
                                        max-width: 250px;
                                        height: 40px;
                                        line-height: 20px;
                                        word-break: break-all;
                                        display: -webkit-box;
                                        -webkit-box-orient: vertical;
                                        -moz-box-orient: vertical;
                                        -ms-box-orient: vertical;
                                        box-orient: vertical;
                                        -webkit-line-clamp: 2;
                                        -moz-line-clamp: 2;
                                        -ms-line-clamp: 2;
                                        line-clamp: 2;
                                        overflow: hidden;
                                        ">{{$item->post_title}}</i></a></h4>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Category -->
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Area -->
@endsection

@section('script')
    <script>
        $('.add_to_cart').click(function () {
            var id = $(this).data('id');
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
                success: function (data) {
                    //
                    Swal.fire(data)
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
