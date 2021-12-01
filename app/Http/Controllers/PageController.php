<?php

namespace App\Http\Controllers;

use App\OnlineProduct;
use Illuminate\Http\Request;
use App\Model\OnlineStore\Category;

class PageController extends Controller
{
    public function index(){
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        //$latestProduct = OnlineProduct::orderBy('created_at', 'desc')->first();
        $products = OnlineProduct::all();
        return view('store.index', compact('categories','products'));
    }

    public function category($id){
        $category = Category::where('id','=',$id)->get();
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        $categoryProducts = OnlineProduct::where('category_id','=',$id)->orderBy('name','asc')->get();
        //$latestProduct = OnlineProduct::orderBy('created_at', 'desc')->first();
        $products = OnlineProduct::all();
        return view('store.category', compact('categoryProducts','categories','products','category'));
    }

    public function item($id){
        $item = OnlineProduct::where('id','=',$id)->get();
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        $categoryProduct = OnlineProduct::where('id','=',$id)->orderBy('name','asc')->get();
        //$latestProduct = OnlineProduct::orderBy('created_at', 'desc')->first();
        $products = OnlineProduct::all();
        return view('store.item', compact('categoryProduct','categories','products','item'));
    }

}
