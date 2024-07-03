<footer class="bg-gray-50 py-6">
    <div class="container mx-auto flex justify-between items-center px-4">
        <div>
            <!-- <h1 class="text-gray-800 text-lg font-bold">E-Kart</h1> -->
            <p class="text-gray-500"> © 2024 E-Kart. All Rights Reserved.</p>
        </div>
        <div class="md:flex space-x-4 sm:col sm:justify-end">
            <a href="/about" class="text-gray-400 hover:text-rose-400 transition duration-300">About</a>
            @if(Auth::user() && Auth::User()->usertype=='seller')
            @else
            <a href="/seller/registration" class="text-gray-400 hover:text-rose-400 transition duration-300">Seller</a>
            @endif
        </div>
    </div>
</footer>