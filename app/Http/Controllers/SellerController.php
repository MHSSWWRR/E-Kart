<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Colors;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function dashboard()
    {
        $product =  Products::with('variants.color', 'variants.size')->where('categories_id', 1)->get();
        $productf =  Products::with('variants.color', 'variants.size')->where('categories_id', 2)->get();
        return view('seller.dashboard', ['product' => $product, 'productf' => $productf]);
    }
    public function registration()
    {
        return view('seller.register');
    }

    public function addproduct()
    {
        $cat = Categories::get();
        $color = Colors::get();
        $size = Size::get();
        return view('seller.addproduct', ['cat' => $cat, 'color' => $color, 'size' => $size]);
    }

    public function addNewProduct(Request $req)
    {
        if (Auth::user()) {
            $product = new Products([
                'categories_id' => $req->category_id,
                'name' => $req->productName,
                'description' => $req->description,
            ]);
            $product->save();

            $productVariant = new ProductVariant([
                'product_id' => $product->id,
                'color_id' => $req->color_id,
                'size_id' => $req->size_id,
                'image' => $req->imageUrl,
                'price' => $req->price,
                'quantity' => $req->quantity,
            ]);
            $productVariant->save();
            return redirect('seller/dashboard');
        } else {
            return redirect('/login');
        }
    }

    public function addproductvariant()
    {
        $Product = Products::get();
        $color = Colors::get();
        $size = Size::get();
        return view('seller.addproductvariant', ['product' => $Product, 'color' => $color, 'size' => $size]);
    }
    public function addNewProductVariant(Request $req)
    {
        $productVariant = new ProductVariant([
            'product_id' => $req->product_id,
            'color_id' => $req->color_id,
            'size_id' => $req->size_id,
            'image' => $req->imageUrl,
            'price' => $req->price,
            'quantity' => $req->quantity,
        ]);
        $productVariant->save();
        return redirect('seller/dashboard');
    }

    public function detail($id)
    {
        $productvariant = ProductVariant::with('product.category', 'color', 'size')->find($id);
        $col = Colors::get();
        $cat = Categories::get();
        $size = Size::get();
        return view('seller.productdetail', [
            'productvariant' => $productvariant,
            'categories' => $cat,
            'colors' => $col,
            'sizes' => $size,
        ]);
    }

    public function updateProductAndVariant(Request $req)
    {
        $product = Products::findOrFail($req->product_id);
        $productVariant = ProductVariant::findOrFail($req->variant_id);

        $product->name = $req->productname;
        $product->description = $req->description;

        $product->save();

        $productVariant->quantity = $req->quantity;
        $productVariant->size_id = $req->size_id;
        $productVariant->price = $req->price;
        $productVariant->color_id = $req->colour_id;
        $productVariant->image = $req->image;
        $productVariant->save();

        return redirect()->back()->with('success', 'Product Updated successfully..');
    }

    public function orders()
    {
        $orders = Orders::with('orderProducts.variant.product', 'user')->orderBy('created_at', 'desc')->get();
        return view('seller.orders', ['orders' => $orders]);
    }
}
