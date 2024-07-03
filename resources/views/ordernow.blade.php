@extends('layout')

@section('title', 'Order Now')

@section('content')

<body class="bg-gray-100 font-sans">
  <div class="container mx-auto py-8">
    <div class="flex flex-wrap">
      <!-- Order Summary Section -->
      <div class="w-full md:w-1/2 p-4">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
          <!-- Display order summary details here -->
          <div class="grid grid-cols-1 ">
            <!-- forloop product start -->
            @foreach($cartProducts as $cart)
            @foreach($cart->cartProducts as $cartProduct)
            <div class="bg-white shadow-md rounded-md p-4" style="margin-bottom: 15px;">
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
                    <div class="flex items-center space-x-2 mt2">
                      <span class="text-gray-700 font-medium">Quantity:</span>
                      <!-- Form to submit quantity changes -->
                      <form action="{{ route('update.cart.product', $cartProduct->id) }}" method="POST">
                        @csrf
                        <!-- Input for updating quantity -->
                        <input type="hidden" name="_method" value="PATCH"> <!-- Use PATCH method for updating -->
                        <input type="number" name="quantity" value="{{ $cartProduct->quantity }}" class="border border-gray-300 rounded-lg px-2 py-1 w-16 text-center" onchange="this.form.submit()">
                        @if($cartProduct->quantity > $cartProduct->variant->quantity)

                        <h2 class="text-red-500 font-semibold">Currently Out Of Stock</h2>
                        @endif

                      </form>
                    </div>
                    <div class="flex items-center"> <!-- Added flex items-center -->
                      <span class="text-gray-700 font-bold mt-2">Total Price:</span>
                      <span class="text-gray-700 font-bold ml-1 mt-2">{{$cartProduct->variant->price * $cartProduct->quantity }}</span> <!-- Added ml-1 for margin-left -->
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
        </div>
      </div>
      <!-- Checkout Form Section -->
      <div class="w-full md:w-1/2 p-4">

        <div class="bg-white rounded-lg shadow-md p-6 ">
          <h2 class="text-xl font-semibold mb-4">Order Total</h2>
          <table class="table-auto w-full">
            <tbody>
              <tr>
                <td class="py-2 px-4 border">Subtotal</td>
                <td class="py-2 px-4 border text-right">${{$total}}</td>
              </tr>
              <tr>
                <td class="py-2 px-4 border">Shipping</td>
                <td class="py-2 px-4 border text-right">$10.00</td>
              </tr>
              <tr>
                <td class="py-2 px-4 border">Taxes</td>
                <td class="py-2 px-4 border text-right">${{$total*0.01}}</td>
              </tr>
              <tr>
                <td class="py-2 px-4 border font-semibold">Total</td>
                <td class="py-2 px-4 border text-right font-semibold">${{$total+ 10+ $total *0.01}}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mt-4">
          <h2 class="text-xl font-semibold mb-4">Shipping Address</h2>
          <!-- Address form fields here -->
          <form action="/placeorder" method="POST">
            @csrf
            <div class="mb-4">
              <label for="address" class="block text-gray-700 font-semibold mb-2">Address</label>
              <input type="text" id="address" name="address" class="form-input w-full" required>
            </div>

            <!-- Add more address fields here (e.g., address line 1, address line 2, city, state, postal code, etc.) -->
            <h2 class="text-xl font-semibold mb-4">Payment Method</h2>
            <div class="flex items-center mb-4">
              <input type="radio" id="Cash On Delivery" name="paymentMethod" value="Cash On Delivery" class="form-radio" checked>
              <label for="Cash On Delivery  " class="ml-2 text-gray-700">Cash On Delivery</label>
            </div>
            <div class="flex items-center mb-4">
              <input type="radio" id="UPI" name="paymentMethod" value="UPI" class="form-radio">
              <label for="UPI" class="ml-2 text-gray-700">UPI</label>
            </div>


            @php
            $outOfStock = false;
            @endphp

            @foreach($cartProducts as $cart)
            @foreach($cart->cartProducts as $cartProduct)
            @if($cartProduct->quantity > $cartProduct->variant->quantity)
            @php
            $outOfStock = true;
            break; // Exit the inner loop since we already found an out-of-stock item
            @endphp
            @endif
            @endforeach
            @endforeach

            @if($outOfStock)
            <p class="text-red-500 font-semibold">Please remove out of stock items from your cart before placing the order.</p>
            @else
            <button type="submit" class="bg-rose-500 text-white px-6 py-3 rounded-lg hover:bg-rose-600">Place Order</button>
            @endif



          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection