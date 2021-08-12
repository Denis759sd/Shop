@extends('layouts.app')

@section('title', 'Product')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/product.css">
    <link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">
@endsection

@section('content')
    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url(/images/categories.jpg)"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">{{$product->category->title}}<span>.</span></div>
                                <div class="home_text"><p>{{$product->category->description}}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->

    <div class="product_details">
        <div class="container">
            <div class="row details_row">

                <!-- Product Image -->
                <div class="col-lg-6">
                    @php
                        $image = '';

                        if (count($product->images) > 0)
                            $image = $product->images[0]['image'];
                        else
                            $image = 'product_1.jpg';
                    @endphp
                    <div class="details_image">
                        <div class="details_image_large"><img src="/images/{{$image}}" alt="{{$product->title}}"><div class="product_extra product_new"><a href="categories.html">New</a></div></div>
                        <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                            @if($image != 'product_1.jpg')
                                @foreach($product->images as $image)
                                    @if($loop->first)
                                        <div class="details_image_thumbnail active" data-image="/images/{{$image['image']}}"><img src="/images/{{$image['image']}}" alt="{{$product->title}}"></div>
                                    @else
                                        <div class="details_image_thumbnail" data-image="/images/{{$image['image']}}"><img src="/images/{{$image['image']}}" alt="{{$product->title}}"></div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col-lg-6">
                    <div class="details_content">
                        <div class="details_name" data-id="{{$product->id}}">{{$product->title}}</div>
                        @if($product->new_price != null)
                            <div class="details_discount">${{$product->price}}</div>
                            <div class="details_price">${{$product->new_price}}</div>
                        @else
                            <div class="details_price">${{$product->price}}</div>
                        @endif


                        <!-- In Stock -->
                        <div class="in_stock_container">
                            <div class="availability">Availability:</div>
                            @if($product->in_stock)
                                <span class="in_stock">In Stock</span>
                            @else
                                <span class="no_stock">No Stock</span>
                            @endif
                        </div>
                        <div class="details_text">
                            <p>{{$product->description}}</p>
                        </div>

                        <!-- Product Quantity -->
                        <div class="product_quantity_container">
                            <div class="product_quantity clearfix">
                                <span>Qty</span>
                                <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                <div class="quantity_buttons">
                                    <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                    <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                </div>
                            </div>
                            <div class="button cart_button"><a href="#">Add to cart</a></div>
                        </div>

                        <!-- Share -->
                        <div class="details_share">
                            <span>Share:</span>
                            <ul>
                                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row description_row">
                <div class="col">
                    <div class="description_title_container">
                        <div class="description_title">Description</div>
                        <div class="reviews_title"><a href="#">Reviews <span>(1)</span></a></div>
                    </div>
                    <div class="description_text">
                        <p>{{$product->description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="products_title">Related Products</div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <div class="product_grid">

                        <!-- Product -->
                        <div class="product">
                            <div class="product_image"><img src="/images/product_1.jpg" alt=""></div>
                            <div class="product_extra product_new"><a href="categories.html">New</a></div>
                            <div class="product_content">
                                <div class="product_title"><a href="product.html">Smart Phone</a></div>
                                <div class="product_price">$670</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="/js/product.js"></script>
    <script>
        $(document).ready(function () {
            $('.cart_button').click(function (event) {
                event.preventDefault()
                addToCart()
            })
        })

        function addToCart() {
            let id = $('.details_name').data('id')
            let qty = parseInt($('#quantity_input').val())

            let totalQty = parseInt($('.cart-qty').text())
            totalQty += qty
            $('.cart-qty').text(totalQty)

            $.ajax({
                url: "{{route('AddToCart')}}",
                type: "POST",
                data: {
                    id: id,
                    qty: qty
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    console.log(data);
                }
            });
        }
    </script>
@endsection
