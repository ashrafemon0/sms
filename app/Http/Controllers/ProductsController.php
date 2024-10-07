<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StudentClass;
use App\Models\StudentFeeCategory;
use App\Models\StudentFeeCategoryAmount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index()
    {
        $FeeCategory = StudentFeeCategory::with('amount')->get();
        $user = Auth::user();
        $studentClass = StudentClass::all();
        // Return the view with the fetched data
        return view('admin.backend.payment.products', compact('FeeCategory','user','studentClass'));
    }

    public function cart()
    {
        $cart = session()->get('cart', []);

        return view('admin.backend.payment.cart', compact('cart'));
    }
    public function addToCart($id)
    {
        $feeCategoryAmount = StudentFeeCategoryAmount::findOrFail($id);
        $feeCategory = $feeCategoryAmount->FeeCategory;

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "fee_category_name" => $feeCategory->name,
                "fee_category_amount" => $feeCategoryAmount->fee_category_amount,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Fee Category added to cart successfully!');
    }
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }
}
