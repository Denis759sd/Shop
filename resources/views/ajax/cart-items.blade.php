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
