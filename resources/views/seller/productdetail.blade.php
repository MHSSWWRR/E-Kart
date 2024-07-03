@extends('layout')

@section('title', 'Product Detail')

@section('content')


<div class="container mx-auto py-8 mt-10">

    <div class="flex flex-wrap">

        <!-- Product Image -->
        <div class="w-full md:w-1/2 flex" style="height: fit-content;">
            <img id="productImage" src="{{ $productvariant->image }}" alt="Product Image" class="w-full h-18 rounded-lg  ">
        </div>

        <!-- Product Information -->
        <div class="w-full md:w-1/2 px-4 flex flex-col justify-center">
            <form action="/seller/editproduct" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PATCH"> <!-- Use PATCH method for updating -->
                <input type="hidden" name="variant_id" value="{{$productvariant->id}}">
                <input type="hidden" name="product_id" value="{{$productvariant->product->id}}">


                <!-- Product Name -->
                <label for="productname" class="block font-semibold">Name:</label>
                <input type="text" id="productname" name="productname" value="{{ $productvariant->product->name }}" class="border border-gray-300 rounded-md p-2 mb-4 w-3/4">

                <!-- Product Description -->
                <label for="description" class="block font-semibold">Description:</label>
                <textarea id="description" name="description" class="border border-gray-300 rounded-md p-2 w-3/4 mb-4" rows="4">{{ $productvariant->product->description }}</textarea>

                <!-- Product Price -->
                <label for="price" class="block font-semibold">Price:</label>
                <input type="number" id="price" name="price" value="{{ $productvariant->price }}" class="border border-gray-300 rounded-md p-2 mb-4 w-3/4">

                <!-- Category -->
                <label for="category" class="block font-semibold">Category:</label>
                <select name="category_id" id="category" class="border border-gray-300 rounded-md px-5 w-1/2 mb-4">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $productvariant->product->category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>

                <!-- Color and Size Dropdowns -->
                <div class="mb-4">
                    <label for="colour" class="block font-semibold">Color:</label>
                    <select name="colour_id" id="colour" class="border border-gray-300 rounded-md px-8 ">
                        @foreach ($colors as $color)
                        <option value="{{ $color->id }}" {{ $color->id == $productvariant->color_id ? 'selected' : '' }}>
                            {{ $color->color }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="size" class="block font-semibold">Size:</label>
                    <select name="size_id" id="size" class="border border-gray-300 rounded-md p-2 px-8">
                        @foreach ($sizes as $size)
                        <option value="{{ $size->id }}" {{ $size->id == $productvariant->size_id ? 'selected' : '' }}>
                            {{ $size->size }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Quantity -->
                <label for="quantity" class="block font-semibold">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="{{$productvariant->quantity}}" class="border border-gray-300 rounded-md p-2 mb-4">

                <!-- Product Image -->
                <label for="image" class="block font-semibold">Image Url:</label>
                <input type="text" id="image" name="image" value="{{ $productvariant->image }}" class="border border-gray-300 rounded-md p-2 mb-4 w-3/4" onchange="updateImage(this.value)">

                <!-- Submit Button -->
                <button type="submit" class="bg-gradient-to-r from-red-600 to-pink-500 rounded-full py-4 px-8 text-gray-50 md:self-start">
                    Update Product
                </button>
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

<script>
    function updateImage(imageUrl) {
        document.getElementById('productImage').src = imageUrl;
    }
</script>