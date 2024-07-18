<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class JustOrangeController extends Controller
{
    public $global;
    public function __construct()
    {
        $this->global['current_url'] = url()->current();
        $this->global['base_url'] = url('/');
        $this->global['no_whatsapp'] = env('NO_WHATSAPP');
        $this->global['wa_message'] = env('WA_MESSAGE');
    }
    public function index(Request $request): \Inertia\Response
    {
        $filter = ($request->get('filter')) ? $request->get('filter') : null;
        switch ($filter) {
            case 'all':
                $product =  Product::where('active', true)->orderBy('created_at', 'desc')->take(8)->with('category')->get();
                break;
            case 'new':
                $product = Product::where('active', true)->orderBy('id', 'desc')->take(8)->with('category')->get();
                break;
            case 'populer':
                $product =  Product::where('active', true)->orderBy('views', 'desc')->take(8)->with('category')->get();
                break;
            case 'desc_harga':
                $product =  Product::where('active', true)->orderBy('price', 'desc')->take(8)->with('category')->get();
                break;
            case 'asc_harga':
                $product =  Product::where('active', true)->orderBy('price', 'asc')->take(8)->with('category')->get();
                break;
            default:
                $product =  Product::where('active', true)->orderBy('id', 'desc')->take(8)->with('category')->get();
                break;
        }

        $props['posts'] = Post::where('active', true)->orderBy('id', 'desc')->take(8)->get();
        $props['categories'] = Category::where('active', true)->orderBy('id', 'desc')->get();
        $props['services'] = Service::all();
        $props['testimonials'] = Testimonial::take(6)->get();
        $props['products'] = $product;
        $props['globals'] = $this->global;
        $props['filter'] = $filter;


        $data['props'] = $props;
        return Inertia::render('justorange-default', $data);
    }

    /*---------------------------------- PRODUCT ------------------------------ */
    public function getProducts(Request $request): \Inertia\Response
    {
        $filter = ($request->get('filter')) ? $request->get('filter') : 'all';
        switch ($filter) {
            case 'all':
                $product =  Product::where('active', true)->orderBy('created_at', 'desc')->with('category')->get();
                break;
            case 'new':
                $product = Product::where('active', true)->orderBy('id', 'desc')->with('category')->get();
                break;
            case 'populer':
                $product =  Product::where('active', true)->orderBy('views', 'desc')->with('category')->get();
                break;
            case 'desc_harga':
                $product =  Product::where('active', true)->orderBy('price', 'desc')->with('category')->get();
                break;
            case 'asc_harga':
                $product =  Product::where('active', true)->orderBy('price', 'asc')->with('category')->get();
                break;
            case 'category':
                $product = Product::where('active',true)->where('category_id',$request->get('cat'))->with('category')->get();
                break;
            case 'search':
                $query = $request->get('query');
                $product = Product::where('active',true)->where('title','LIKE',"%$query%")->orWhere('content','LIKE',"%$query%")->with('category')->get();
                break;
            default:
                $product =  Product::where('active', true)->orderBy('id', 'desc')->with('category')->get();
                break;
        }
        $props['categories'] = Category::where('active',true)->get();
        $props['products'] =$product;
        $props['globals'] = $this->global;
        $props['filter'] = $filter;

        $data['props'] = $props;
        return Inertia::render('Products/index', $data);
    }
    public function getProductDetail(Request $request): \Inertia\Response
    {
        $props['product'] = Product::where('active', true)->where('slug', $request->slug)->with('category')->first();
        $props['products'] = Product::where('category_id' , $props['product']->category_id)->where('active',true)->with('category')->take(6)->get();
        $props['globals'] = $this->global;
        $props['categories'] = Category::where('active',true)->get();
        
        $data['props'] = $props;
        return Inertia::render('Products/detail', $data);
    }
}
