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
        $this->global['settings'] = json_decode(file_get_contents(storage_path('app/settings.json')) ,true);
    }
    public function index(Request $request): \Inertia\Response
    {
        $filter = ($request->get('filter')) ? $request->get('filter') : null;
        $product = Product::filter(request(['filter','q','cat']))->with('category')->take(8)->get();

        $props['posts'] = Post::where('active', true)->orderBy('id', 'desc')->take(9)->get();
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
        $product = Product::filter(request(['filter','cat','q']))->with('category')->get();
        $props['categories'] = Category::where('active',true)->get();
        $props['products'] =$product;
        $props['globals'] = $this->global;
        $props['filter'] = $filter;
        $props['filter_query'] = request('q') ?? null;
        $props['posts'] = Post::where('active',true)->get();

        $data['props'] = $props;
        return Inertia::render('Products/index', $data);
    }
    public function getProductDetail(Request $request): \Inertia\Response
    {
        $props['product'] = Product::where('active', true)->where('slug', $request->slug)->with('category')->first();
        $props['products'] = Product::where('category_id' , $props['product']->category_id)->where('active',true)->with('category')->take(6)->get();
        $props['globals'] = $this->global;
        $props['categories'] = Category::where('active',true)->get();
        $props['posts'] = Post::where('active',true)->get();
        
        $data['props'] = $props;
        return Inertia::render('Products/detail', $data);
    }

    public function getAbout(): \Inertia\Response
    {
        $data['props'] = '';
        return Inertia::render('about',$data);
    }
    public function getContact(): \Inertia\Response
    {
        $props['settings'] = json_decode(file_get_contents(storage_path('app/settings.json')) , true);

        $data['props'] = $props;
        return Inertia::render('contact',$data);
    }

    public function getPosts(): \Inertia\Response
    {
        $props['globals'] = $this->global;
        $props['posts'] = Post::where('active',true)->get();
        $props['categories'] = Category::where('active',true)->get();
        $data['props'] = $props;
        return Inertia::render('Posts/index', $data);
    }

    public function getPostDetail(Request $request): \Inertia\Response
    {
        $props['post'] = Post::find($request->id);
        $props['categories'] = Category::where('active',true)->get();
        $props['globals'] = $this->global;

        $data['props'] = $props;
        return Inertia::render('Posts/detail',$data);
    }
}
