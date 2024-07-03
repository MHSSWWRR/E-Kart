@extends('layout')

@section('title', 'Product Detail')

@section('content')


<div class="container mx-auto py-8 mt-10">

    <div class="flex flex-wrap">

        <!-- Product Image -->
        <div class="w-full md:w-1/2 flex">
            <img src="{{ $selectedVariant->image }}" alt="Product Image" class="w-full rounded-lg">
        </div>

        <!-- Product Information -->
        <div class="w-full md:w-1/2 px-4 flex flex-col justify-center">
            <h1 class="text-3xl font-semibold mb-4 mt-5">{{ $productVariants->name }}</h1>

            <!-- Product Details -->
            <p class="mb-4">{{ $productVariants->description }}</p>

            <!-- Product Price -->
            <h2 class="text-xl font-semibold mb-2">Price: ${{ $selectedVariant->price }}</h2>

            <p class="mb-4 mt-4">Category: <span class="font-semibold">{{$productVariants->category->name}} </span></p>

            <!-- Color and Size Dropdowns -->
            <div class="mb-4">
                <label for="colour" class="block font-semibold">Color:</label>
                <form id="colour-change" action="{{ route('update.variant', ['id' =>  $productVariants->id ]) }}" method="POST">
                    @csrf
                    <select name="colour_id" id="colour-select" class="border border-gray-300 rounded-md p-10" onchange="this.form.submit()">
                        @foreach($productVariants->variants->unique('color_id') as $variant)
                        <option value="{{ $variant->color->id }}" {{$variant->id == $selectedVariant->id ? 'selected' : ''}}>
                            {{ $variant->color->color }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="mb-4">
                <label for="size" class="block font-semibold">Size:</label>
                <form id="size-change" action="{{ route('update.variant', ['id' =>  $productVariants->id ]) }}" method="POST">
                    @csrf
                    <!-- Hidden input field to pass selected color ID -->
                    <input type="hidden" name="colour_id" value="{{ $selectedVariant->color_id }}">
                    <!-- Dropdown for selecting size -->
                    <select name="size_id" id="size-select" class="border border-gray-300 rounded-md p-10" onchange="this.form.submit()">
                        @foreach($productVariants->variants->where('color_id', $selectedVariant->color_id)->unique('size_id') as $variant)
                        <option value="{{ $variant->size->id }}" {{$variant->id == $selectedVariant->id ? 'selected' : ''}}>
                            {{ $variant->size->size }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>



            <!-- Add to Cart Button -->
            <form action="/add_to_cart" method="POST">
                @csrf
                <input type="hidden" name="variant_id" value="{{$selectedVariant->id}}">

                <div class="flex items-center space-x-2 mb-6">
                    <span class="text-gray-700">Quantity:</span>
                    <input type="number" name="quantity" value="1" class="border border-gray-300 rounded-md px-2 py-1 w-16 text-center">
                </div>
                @if($variant->quantity==0)
                <h2 class="text-red-500 font-semibold "> Currently Out Of Stock </h2>


                @else
                <a class="bg-gradient-to-r from-red-600 to-pink-500 rounded-full py-4 px-8 text-gray-50   md:self-start ">
                    <button class="btn btn-primary">Add to Cart</button></a>
                @endif
            </form>
            @if(session('success'))
            <div class="bg-green-200 border-green-600 border-l-4 p-4 mb-4">
                <p class="text-green-600">{{ session('success') }}</p>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection