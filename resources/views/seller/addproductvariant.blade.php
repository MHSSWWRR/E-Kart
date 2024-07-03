@extends('layout')
@section('title','Add Variant')
@section('content')

<body class="bg-white-100 font-sans">
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Add Product Variant</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Product Variants</h3>
                <form action="addNewProductVariant" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <div>
                            <label for="product" class="block text-sm font-medium leading-6 text-gray-900">Product</label>
                            <select id="product" name="product_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rose-500 sm:text-sm sm:leading-6" required>
                                @foreach($product as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="color" class="block text-sm font-medium leading-6 text-gray-900">Color</label>
                            <select id="color" name="color_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rose-500 sm:text-sm sm:leading-6" required>
                                @foreach($color as $color)
                                <option value="{{$color->id}}">{{$color->color}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="size" class="block text-sm font-medium leading-6 text-gray-900">Size</label>
                            <select id="size" name="size_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rose-500 sm:text-sm sm:leading-6" required>
                                @foreach($size as $size)
                                <option value="{{$size->id}}">{{$size->size}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="imageUrl" class="block text-sm font-medium leading-6 text-gray-900">Image URL</label>
                            <input type="text" id="imageUrl" name="imageUrl" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rose-500 sm:text-sm sm:leading-6" required>
                        </div>
                        <div>
                            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                            <input type="number" id="price" name="price" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rose-500 sm:text-sm sm:leading-6" required>
                        </div>
                        <div>
                            <label for="quantity" class="block text-sm font-medium leading-6 text-gray-900">Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rose-500 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>
                    <button class="bg-rose-500 text-white px-6 py-3 mt-4 rounded-md hover:bg-rose-600">Add Variant</button>
                </form>
            </div>
            <!-- Add more buttons or actions as needed -->
        </div>
    </div>
</body>
@endsection