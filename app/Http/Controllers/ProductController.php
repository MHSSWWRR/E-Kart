<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\OrderProducts;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $men = Products::with('variants')->where('categories_id', 1)->get();
        $women = Products::with('variants')->where('categories_id', 2)->get();
        $kids = Products::with('variants')->where('categories_id', 3)->get();
        return view('index', ['men' => $men, 'women' => $women]);
    }
    public function detail($id, $product_variant_id = null)
    {
        $productVariants = Products::with('category', 'variants.size', 'variants.color')->find($id);

        // Load the selected variant if the product_variant_id is provided
        $selectedVariant = null;
        if ($product_variant_id) {
            $selectedVariant = ProductVariant::findOrFail($product_variant_id);
        } else {
            // If no specific variant is provided, select the first variant
            $selectedVariant = $productVariants->variants->first();
        }

        return view('detail', [
            'productVariants' => $productVariants,
            'selectedVariant' => $selectedVariant
        ]);
    }

    // public function detail($id)
    // {
    //     $productVariants = Products::with('category', 'variants.size', 'variants.color')->find($id);
    //     // $productVariants = ProductVariant::with('size', 'color', 'product.category')->where('product_id', $id)->get();
    //     return view('detail', ['productVariants' => $productVariants, 'selectedVariant' => $productVariants->variants->first()]);
    // }

    // public function updateVariant(Request $request, $id)
    // {
    //     $colorId = $request->input('colour_id');
    //     // Find the variant based on color and size for the given product ID
    //     $productVariants = Products::with('category', 'variants.size', 'variants.color')->find($id);
    //     $selectcolor = $productVariants->variants->where('color_id', $colorId)->first();
    //     // Return view with updated price, image, and selected variant
    //     return view('detail', [
    //         'productVariants' => $productVariants, 'selectedVariant' => $selectcolor
    //     ]);
    // }
    public function updateVariant(Request $request, $id)
    {
        // Retrieve color ID from the request
        $colorId = $request->input('colour_id');

        // Check if size ID is provided in the request
        if ($request->has('size_id')) {
            // If size ID is provided, retrieve size ID from the request

            // Find the variant based on color and size for the given product ID
            // $selectVariant = ProductVariant::where('product_id', $id)->where('color_id', $colorId)->where('size_id', $sizeId)->first();
            $productVariants = Products::with('category', 'variants.size', 'variants.color')->find($id);
            $selectVariant = $productVariants->variants->where('color_id', $request->colour_id)->where('size_id', $request->size_id)
                ->first();
            return view('detail', [
                'productVariants' => $productVariants,
                'selectedVariant' => $selectVariant
            ]);
        } else {
            // If size ID is not provided, find the variant based only on color
            $selectVariant = ProductVariant::where('product_id', $id)
                ->where('color_id', $colorId)
                ->first();
            $productVariants = Products::with('category')->find($id);
            return view('detail', [
                'productVariants' => $productVariants,
                'selectedVariant' => $selectVariant
            ]);
        }
    }

    public function add_to_cart(Request $req)
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;

            $cart = Cart::firstOrCreate(['user_id' => $userId]);

            // Check if the cart already contains the variant
            $existingCartItem = $cart->cartProducts()->where('variant_id', $req->variant_id)->first();

            if ($existingCartItem) {
                // If the cart already contains the variant, increase its quantity
                $existingCartItem->update([
                    'quantity' => $existingCartItem->quantity + $req->quantity
                ]);
            } else {
                // If the cart does not contain the variant, add it as a new cart product
                $cartProduct = new CartProduct([
                    'variant_id' => $req->variant_id,
                    'quantity' => $req->quantity,
                ]);
                $cart->cartProducts()->save($cartProduct);
            }

            return redirect('/');
            // return redirect()->back()->with('success', 'Product added successfully..');
        } else {
            return redirect('/login');
        }
    }


    static function cartItem()
    {
        $userId = Auth::user()->id;
        $cart = Cart::where('user_id', $userId)->first();
        if ($cart) {
            return $cart->cartProducts()->count();
        } else {
            return  0;
        }
    }

    public function cartlist()
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $cart = Cart::where('user_id', $userId)->first();
            if ($cart) {

                $cartProducts = Cart::where('user_id', $userId)
                    ->with('cartProducts.variant.product')
                    ->with('cartProducts.variant.color')
                    ->with('cartProducts.variant.size')
                    ->get();
                $cp = CartProduct::where('cart_id', Cart::where('user_id', $userId)->first()->id)->get();

                if ($cp->isEmpty()) {
                    // Handle case where the user's cart is empty
                    return view('cartlist', ['cartProducts' => []]);
                } else {
                    return view('cartlist', ['cartProducts' => $cartProducts]);
                }
            } else {
                // Handle case where the user's cart is empty
                return view('cartlist', ['cartProducts' => []]);
            }
        } else {
            return redirect('/login');
        }
    }
    function removeCart($id)
    {
        CartProduct::destroy($id);
        return redirect()->back();
    }
    public function updateCartProduct(Request $request, $cartProductId)
    {
        // Find the cart product by ID
        $cartProduct = CartProduct::findOrFail($cartProductId);

        // Update the quantity
        if ($request->quantity < 1) {
            CartProduct::destroy($cartProductId);
            return redirect()->back();
        }
        $cartProduct->quantity = $request->input('quantity');
        $cartProduct->save();

        return redirect()->back(); // Redirect back to the cart page
    }

    public function checkout()
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $cart = Cart::Where('user_id', $userId)->with('cartProducts.variant.product')->first();
            $cart = Cart::where('user_id', $userId)->first();
            if ($cart) {

                $cartProducts = Cart::where('user_id', $userId)
                    ->with('cartProducts.variant.product')
                    ->with('cartProducts.variant.color')
                    ->with('cartProducts.variant.size')
                    ->get();
            }
            $total = 0;
            if ($cart) {
                foreach ($cart->cartProducts as $cartProduct) {
                    // Multiply price by quantity and add to total
                    $total += $cartProduct->variant->price * $cartProduct->quantity;
                }
            }
            return view('ordernow', ['total' => $total, 'cartProducts' => $cartProducts]);
        }
    }

    public function placeorder(Request $req)
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $allCart = CartProduct::whereHas('cart', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->get();

            foreach ($allCart as $cartProduct) {
                $order = new Orders([
                    'user_id' => $userId,
                    'address' => $req->address,
                    'payment_method' => $req->paymentMethod
                ]);
                $order->save();

                $orderProduct = new OrderProducts([
                    'order_id' => $order->id,
                    'variant_id' => $cartProduct->variant_id,
                    'quantity' => $cartProduct->quantity,
                    'price' => $cartProduct->variant->price,
                ]);
                $orderProduct->save();

                // Subtract the ordered quantity from the product_variant table
                $productVariant = ProductVariant::find($cartProduct->variant_id);
                $productVariant->quantity -= $cartProduct->quantity;
                $productVariant->save();
            }
            // Delete all cart items for the user after creating orders
            Cart::where('user_id', $userId)->delete();

            // Redirect the user to the homepage
            return redirect('/');
        }
    }

    public function orderhistory()
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $orders = Orders::where('user_id', $userId)
                ->with('orderProducts.variant.product')->orderBy('created_at', 'desc')->get();
            return view('orderhistory', ['orders' => $orders]);
        } else {
            return redirect('/login');
        }
    }
}
