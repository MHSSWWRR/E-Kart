@extends('layout')

@section('title', 'Shopping Cart')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold mb-8">Shopping Cart</h1>
    @if (count($cartProducts) === 0)
    <p>Your cart is empty.</p>
    @else

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- forloop product start -->
        @foreach($cartProducts as $cart)
        @foreach($cart->cartProducts as $cartProduct)
        <div class="bg-white shadow-md rounded-md p-4">
            <div class="flex justify-between">
                <a href="{{ route('product.detail', ['id' => $cartProduct->variant->product->id, 'product_variant_id' => $cartProduct->variant->id]) }}">
                    <img src="{{$cartProduct->variant->image}}" alt="" class="w-32 h-40 object-cover rounded-md"> </a>
                <div class="ml-4 flex-grow">
                    <a href="{{ route('product.detail', ['id' => $cartProduct->variant->product->id, 'product_variant_id' => $cartProduct->variant->id]) }}">
                        <h2 class="text-lg font-semibold">{{$cartProduct->variant->product->name}}</h2>
                    </a>
                    <!-- <p class="text-gray-600">{{$cartProduct->variant->product->description}}</p> -->

                    <div class="flex flex-col justify-between mt-4">
                        <div class="flex items-center"> <!-- Added flex items-center -->
                            <span class="text-gray-700 font-medium">Colour:</span>
                            <span class="text-gray-700 font-medium ml-1">{{$cartProduct->variant->color->color}}</span> <!-- Added ml-1 for margin-left -->
                        </div>
                        <div class="flex items-center"> <!-- Added flex items-center -->
                            <span class="text-gray-700 font-medium">Size:</span>
                            <span class="text-gray-700 font-medium ml-1">{{$cartProduct->variant->size->size}}</span> <!-- Added ml-1 for margin-left -->
                        </div>
                        <div class="flex items-center"> <!-- Added flex items-center -->
                            <span class="text-gray-700 font-medium">Price:</span>
                            <span class="text-gray-700 font-medium ml-1">{{$cartProduct->variant->price}}</span> <!-- Added ml-1 for margin-left -->
                        </div>
                        <!-- Displaying Quantity Input with Form -->
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-700 font-medium">Quantity:</span>
                            <!-- Form to submit quantity changes -->
                            <form action="{{ route('update.cart.product', $cartProduct->id) }}" method="POST">
                                @csrf
                                <!-- Input for updating quantity -->
                                <input type="hidden" name="_method" value="PATCH"> <!-- Use PATCH method for updating -->
                                <input type="number" name="quantity" value="{{ $cartProduct->quantity }}" class="border border-gray-300 rounded-lg px-2 py-1 w-16 text-center" onchange="this.form.submit()">
                            </form>
                        </div>


                    </div>

                </div>
            </div>
            <div class="mt-4 flex justify-end">
                <a href="/removecart/{{$cartProduct->id}}"> <button class="text-red-500 hover:text-red-600">Remove</button></a>
            </div>
        </div>
        @endforeach
        @endforeach
        <!-- for loop end product 1 end -->


    </div>
    <div class="mt-8 flex justify-end">
        <a href="checkout" class="bg-gradient-to-r from-red-600 to-pink-500 rounded-full py-4 px-8 text-gray-50   md:self-start ">Checkout</a>

    </div>
    @endif
</div>
@endsection