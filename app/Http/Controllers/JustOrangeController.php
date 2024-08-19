<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JustOrangeController extends Controller
{
    public $global;
    public function __construct()
    {
        $this->global['current_url'] = url()->current();
        $this->global['base_url'] = url('/');
        $this->global['settings'] = json_decode(file_get_contents(storage_path('app/settings.json')), true);
        $this->global['no_whatsapp'] = $this->global['settings']['no_whatsapp'];
        $this->global['wa_message'] = $this->global['settings']['wa_message'];
    }
    public function index(Request $request): \Inertia\Response
    {
        $filter = ($request->get('filter')) ? $request->get('filter') : null;
        $product = Product::filter(request(['filter', 'q', 'cat']))->with('category')->take(8)->get();

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
        $product = Product::filter(request(['filter', 'cat', 'q']))->with('category')->get();
        $props['categories'] = Category::where('active', true)->get();
        $props['products'] = $product;
        $props['globals'] = $this->global;
        $props['filter'] = $filter;
        $props['filter_query'] = request('q') ?? null;
        $props['posts'] = Post::where('active', true)->get();

        $data['props'] = $props;
        return Inertia::render('Products/index', $data);
    }
    public function getProductDetail(Request $request): \Inertia\Response
    {
        $props['product'] = Product::where('active', true)->where('slug', $request->slug)->with('category')->first();
        $props['products'] = Product::where('category_id', $props['product']->category_id)->where('active', true)->with('category')->take(6)->get();
        $props['globals'] = $this->global;
        $props['categories'] = Category::where('active', true)->get();
        $props['posts'] = Post::where('active', true)->get();

        // Cek apakah session sudah ada
        $viewedProducts = session()->get('viewed_products', []);
        $product = Product::where('active', true)->where('slug', $request->slug)->with('category')->first();
        // Jika produk belum pernah dilihat oleh user
        if (!in_array($product->id, $viewedProducts)) {
            $product->views += 1;
            $product->save();

            // Tambahkan produk ke session
            session()->push('viewed_products', $product->id);
        }

        $data['props'] = $props;
        return Inertia::render('Products/detail', $data);
    }

    public function getAbout(): \Inertia\Response
    {
        $props['settings'] = json_decode(file_get_contents(storage_path('app/settings.json')), true);
        $props['categories'] = Category::where('active', true)->get();
        $props['globals'] = $this->global;

        $data['props'] = $props;
        return Inertia::render('about', $data);
    }
    public function getContact(): \Inertia\Response
    {
        $props['settings'] = json_decode(file_get_contents(storage_path('app/settings.json')), true);
        $props['categories'] = Category::where('active', true)->get();
        $props['globals'] = $this->global;

        $data['props'] = $props;
        return Inertia::render('contact', $data);
    }

    public function getPosts(): \Inertia\Response
    {
        $props['globals'] = $this->global;
        $props['posts'] = Post::where('active', true)->get();
        $props['categories'] = Category::where('active', true)->get();
        $data['props'] = $props;
        return Inertia::render('Posts/index', $data);
    }

    public function getPostDetail(Request $request): \Inertia\Response
    {
        $props['post'] = Post::where('slug', $request->slug)->first();
        $props['categories'] = Category::where('active', true)->get();
        $props['globals'] = $this->global;
        $props['posts'] = Post::where('active', true)->get();



        $data['props'] = $props;
        return Inertia::render('Posts/detail', $data);
    }

    public function submitContact(Request $request): JsonResponse
    {
        $req = $request->json()->all();
        $contact = new Contact();
        $contact->name = $req['nama'];
        $contact->email = $req['email'];
        $contact->phone = $req['whatsapp'];
        $contact->title = $req['judul'];
        $contact->message = $req['pesan'];
        $contact->save();

        return response()->json(['success' => true], 200, [], JSON_PRETTY_PRINT);
    }
}
