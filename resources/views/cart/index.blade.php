@extends('layouts.app')

@section('title', 'Cart')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/cart.css">
    <link rel="stylesheet" type="text/css" href="/styles/cart_responsive.css">
@endsection

@section('content')
    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url(images/cart.jpg)"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="breadcrumbs">
                                    <ul>
                                        <li><a href="{{route('Home')}}">Home</a></li>
                                        <li>Shopping Cart</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Info -->

    <div class="cart_info">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Column Titles -->
                    <div class="cart_info_columns clearfix">
                        <div class="cart_info_col cart_info_col_product">Product</div>
                        <div class="cart_info_col cart_info_col_price">Price</div>
                        <div class="cart_info_col cart_info_col_quantity">Quantity</div>
                        <div class="cart_info_col cart_info_col_total">Total</div>
                    </div>
                </div>
            </div>

            <div class="row cart_items_row">
                <div class="col">
                    <!-- Cart Item -->
                    @foreach($items as $item)
                        <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                            <!-- Name -->
                            <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_item_image">
                                    <div><img src="images/{{$item->attributes->image}}" alt=""></div>
                                </div>
                                <div class="cart_item_name_container">
                                    <div class="cart_item_name"><a href="{{route('ShowProduct', [$item->attributes->category, $item->id])}}">{{$item->name}}</a></div>
                                </div>
                            </div>
                            <!-- Price -->
                            <div class="cart_item_price">${{$item->price}}</div>
                            <!-- Quantity -->
                            <div class="cart_item_quantity">
                                <div class="product_quantity_container">
                                    <div class="product_quantity clearfix">
                                        <span>Qty</span>
                                        <input id="quantity_input" type="text" pattern="[0-9]*" value="{{$item->quantity}}">
                                        <div class="quantity_buttons">
                                            <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                            <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total -->
                            <div class="cart_item_total">${{$item->price * $item->quantity}}</div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="row row_cart_buttons">
                <div class="col">
                    <div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
                        <div class="button continue_shopping_button"><a href="{{route('Home')}}">Continue shopping</a></div>
                        <div class="cart_buttons_right ml-lg-auto">
                            <div class="button clear_cart_button" data-items=""{{$items}}><a href="">Clear cart</a></div>
                            <div class="button update_cart_button"><a href="#">Update cart</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row_extra">
                <div class="col-lg-4">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="/js/cart.js"></script>
    <script>
        $(document).ready(function () {
            $('.clear_cart_button').click(function (event) {
                event.preventDefault()
                deleteCart()
            })
        })

        function deleteCart() {
            $('.cart-qty').text(0)

            $.ajax({
                url: "{{route('ClearCart')}}",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.cart_item').html(data)
                }
            });
        }
    </script>
@endsection

