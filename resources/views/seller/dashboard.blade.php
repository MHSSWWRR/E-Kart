@extends('layout')
@section('title','Seller Dashboard')
@section('content')

<body class=" font-sans">
    <div class=" md:flex md:flex-row mt-2 p-5" style="background-color: #ffd1c2;">
        <div class="md:w-2/5 flex flex-col items-center justify-center h-screen">
            <div class="text-center mb-8">
                <h1 class="font-serif text-5xl text-gray-700 mb-4">Welcome Seller !</h1>
                <h2 class="text-2xl font-serif  text-gray-600 mb-6">
                    "Attention Sellers! Accelerate Your Sales Journey with E-Kart's Dynamic Seller Platform - Where Growth Knows No Bounds!"
                </h2>
                <a href="/seller/addproduct" class="mb-5 bg-gradient-to-r from-red-600 to-pink-500 rounded-full py-4 px-8 text-gray-50 uppercase text-xl  my-5 ">Start Selling</a>

            </div>
        </div>
        <div class="md:w-3/5">
            <img src="https://th.bing.com/th/id/OIG2.6AcBBR4Bbwy9YQRkPsRL?pid=ImgGn" alt="">
        </div>
    </div>
    <!-- men categories -->
    <div class="p-8" style="background-color: #ffd1c2;">
        @foreach($product as $singleProduct)
        <div class="flex flex-col bg-gray-100 shadow-md m-7 mb-10 p-4 rounded-lg mt-10 ">
            <h2 class="text-3xl font-bold mb-4 text-center">{{ $singleProduct->name }}</h2>
            <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 p-5 gap-10">
                @foreach($singleProduct->variants as $productVariant)
                <div class="bg-white shadow-md rounded-md overflow-hidden">
                    <div class="h-28 bg-gray-200 flex items-center justify-center">
                        <a href="/seller/productdetail/{{$productVariant->id}}"><img src="{{ $productVariant->image }}" alt="{{ $productVariant->color_id }} - {{ $productVariant->size_id }}" class="h-full max-w-full max-h-full object-cover hover:scale-105 transition duration-300 ease-in-out"></a>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $productVariant->color->color }} - {{ $productVariant->size->size }}</h3>
                        <p class="text-gray-700">Price: {{ $productVariant->price }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>


    <!-- female categories -->

    <div class="p-8" style="background-color: #ffd1c2;">
        @foreach($productf as $singleProduct)
        <div class="flex flex-col bg-gray-100 shadow-md m-7 mb-10 p-4 rounded-lg mt-10 ">
            <h2 class="text-3xl font-bold mb-4 text-center">{{ $singleProduct->name }}</h2>
            <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 p-5 gap-10">
                @foreach($singleProduct->variants as $productVariant)
                <div class="bg-white shadow-md rounded-md overflow-hidden">
                    <div class="h-28 bg-gray-200 flex items-center justify-center">
                        <a href="/seller/productdetail/{{$productVariant->id}}"><img src="{{ $productVariant->image }}" alt="{{ $productVariant->color_id }} - {{ $productVariant->size_id }}" class="h-full max-w-full max-h-full object-cover hover:scale-105 transition duration-300 ease-in-out"></a>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $productVariant->color->color }} - {{ $productVariant->size->size }}</h3>
                        <p class="text-gray-700">Price: {{ $productVariant->price }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>


</body>

@endsection