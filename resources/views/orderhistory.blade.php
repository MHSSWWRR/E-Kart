@extends('layout')
@section('title','Order History')
@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold mb-8">Order History</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- foreach($orders as $order) -->
        @foreach ($orders as $order)
        <div class="bg-white shadow-md rounded-md p-8">
            <div class="flex items-center">
                <a href="{{ route('product.detail', ['id' => $order->orderProducts->first()->variant->product->id, 'product_variant_id' => $order->orderProducts->first()->variant->id]) }}">
                    <img src="{{$order->orderProducts->first()->variant->image}}" alt="Product Image" class="w-32 h-40 object-cover mr-4 rounded-lg"></a>
                <div>
                    <h2 class="text-lg font-semibold">{{$order->orderProducts->first()->variant->product->name}}</h2>
                    <p class="text-gray-600">Price: ${{$order->orderProducts->first()->price}} </p>
                    <p class="text-gray-600">Quantity: {{$order->orderProducts->first()->quantity}} </p>
                    <p class="text-gray-600">Order Date: {{$order->orderProducts->first()->created_at->format('d M, Y')}} </p>
                    <p class="text-gray-600">Order Time: {{$order->orderProducts->first()->created_at->format('H:i')}} </p>
                </div>
            </div>
        </div>
        @endforeach
        <!-- endforeach -->



    </div>
</div>
@endsection