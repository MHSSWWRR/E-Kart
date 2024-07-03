@extends('layout')
@section('title','E-Kart')
@section('content')

<!-- wrapper/slider -->
<div class="md:flex md:flex-row mt-2 p-5" style="background-color: #ffd1c2;">
    <div class="md:w-2/5 flex flex-col justify-center items-center">
        <h2 class="font-serif text-5xl text-gray-600 mb-4 text-center md:self-start md:text-left"> Big Sale Alert! Shop Now on E-Kart and Save Big! </h2>
        <p class="uppercase text-gray-600 tracking-wide text-center md:self-start md:text-left">Hurry, these deals won't last forever! Shop now and grab your favorites before they're gone!</p>
        <p class="uppercase text-gray-600 tracking-wide text-center md:self-start md:text-left">Shop Smart, Shop Easy.</p>
        <a href="#men" class="bg-gradient-to-r from-red-600 to-pink-500 rounded-full py-4 px-8 text-gray-50 uppercase text-xl md:self-start my-5">Shop Now</a>
    </div>
    <div class="md:w-3/5">
        <img src="https://th.bing.com/th/id/OIG1.PbWXfVbCJnWOpj.0r_DJ?w=1024&h=1024&rs=1&pid=ImgDetMain" class="w-full" />
    </div>
</div>

<!-- Category 1 -->
<div class="my-20">
    <div class="flex flex-row justify-between my-5 p-5">
        <h2 class="text-3xl ml-6" id="men">Collection</h2>
        <a href="#" class="flex flex-row text-lg hover:text-rose-400">
            View All
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
    </div>

    <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 p-5 gap-10">
        @foreach($men as $product)
        <div class="shadow-lg rounded-lg">
            <a href="detail/{{$product->id}}" style="height: 500px;">
                @if($product->variants->isNotEmpty())
                <img src="{{$product->variants->first()->image}}" class="w-full h-64 rounded-tl-lg rounded-tr-lg hover:scale-105 transition duration-300 ease-in-out" />
                @else
                <img src="default-image.jpg" class="w-full h-64 rounded-tl-lg rounded-tr-lg hover:scale-105 transition duration-300 ease-in-out" alt="No Image Available" />
                @endif
            </a>
            <div class="p-5">
                <h3 class="font-semibold text-gray-900"><a href="detail/{{$product->id}}">{{$product->name}}</a></h3>
                <div class="flex flex-col xl:flex-row justify-between">
                    @if($product->variants->isNotEmpty())
                    <span>Price: ${{ $product->variants->first()->price}}</span>
                    @else
                    <span>Price: Not Available</span>
                    @endif
                    <a class="bg-gradient-to-r from-red-600 to-pink-500 rounded-full py-2 px-4 my-2 text-sm text-white hover:bg-pink-600 hover:from-pink-600 hover:to-pink-600 flex flex-row justify-center" href="detail/{{$product->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Category 1 end-->

<!-- Category 2 -->
<div class="my-20">
    <div class="flex flex-row justify-between my-5 p-5">
        <h2 class="text-3xl ml-6" id="women"><!-- Women's Collection --></h2>
        <a href="#" class="flex flex-row text-lg hover:text-rose-400">
            <!-- View All -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
    </div>

    <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 p-5 gap-10">
        @foreach($women as $product)
        <div class="shadow-lg rounded-lg">
            <a href="detail/{{$product->id}}" style="height: 500px;">
                @if($product->variants->isNotEmpty())
                <img src="{{$product->variants->first()->image}}" class="w-full h-64 rounded-tl-lg rounded-tr-lg hover:scale-105 transition duration-300 ease-in-out" />
                @else
                <img src="default-image.jpg" class="w-full h-64 rounded-tl-lg rounded-tr-lg hover:scale-105 transition duration-300 ease-in-out" alt="No Image Available" />
                @endif
            </a>
            <div class="p-5">
                <h3 class="font-semibold text-gray-900"><a href="detail/{{$product->id}}">{{$product->name}}</a></h3>
                <div class="flex flex-col xl:flex-row justify-between">
                    @if($product->variants->isNotEmpty())
                    <span>Price: ${{ $product->variants->first()->price}}</span>
                    @else
                    <span>Price: Not Available</span>
                    @endif
                    <a class="bg-gradient-to-r from-red-600 to-pink-500 rounded-full py-2 px-4 my-2 text-sm text-white hover:bg-pink-600 hover:from-pink-600 hover:to-pink-600 flex flex-row justify-center" href="detail/{{$product->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Category 2 end-->

@endsection
