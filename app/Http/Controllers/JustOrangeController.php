<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\EventRegister;
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

    public function formRegister(Request $request)
    {

        $props['post'] = Post::where('slug', $request->slug)->first();
        $props['categories'] = Category::where('active', true)->get();
        $props['globals'] = $this->global;
        $props['posts'] = Post::where('active', true)->get();



        $data['props'] = $props;
        return Inertia::render('FormRegister', $data);
    }
    public function submitRegister(Request $request): JsonResponse
    {
        $req = $request->json()->all();
        $apikey = 'e8026508a349a3c291a02d516b479b5c21779d9d';
        $account = '172589054201386bd6d8e091c2ab4c7c7de644d37b66deffee866af';
        $phone = $req['whatsapp'];
        $phone = preg_replace('/\D+/', '', $phone);

        // Change phone number starting with 08 to 628
        if (preg_match('/^08/', $phone)) {
            $phone = preg_replace('/^08/', '628', $phone);
        }

        $message = 
"
🙏 Terima Kasih Sudah Registrasi! 🙏

Halo ".$req['nama']."! Terima kasih telah mendaftar di perlombaan Video Competition GTMotoMinds. Data Anda telah kami terima dengan detail sebagai berikut:

Nama: ".$req['nama']."\n
Alamat: ".$req['alamat']."\n
Instagram : ".$req['instagram']."\n
No. Whatsapp : ".$req['whatsapp']."\n
Kami sangat senang Anda bergabung dalam kompetisi ini! Jangan lupa untuk memberikan yang terbaik dalam video Anda. Semoga sukses dan sampai jumpa di ajang perlombaan! 🏆
\n\n
Salam,
Tim GTMotoMinds
Silakan lanjut kontak https://wa.me/6287878060008 (EDI) untuk informasi lebih lanjut.
";
       


        $events = EventRegister::updateOrCreate([
            'whatsapp' => $req['whatsapp'], 
            'instagram' => $req['instagram']
            ],
            [
                'name' => $req['nama'] , 
                'address' => $req['alamat'] ]
        );

        if($events)
        {
            $chat = [
                "secret" => $apikey, // your API secret from (Tools -> API Keys) page
                "account" => $account,
                "recipient" => $phone,
                "type" => "text",
                "message" => $message
            ];
    
            $cURL = curl_init("https://piwapi.com/api/send/whatsapp");
            curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cURL, CURLOPT_POSTFIELDS, $chat);
            $response = curl_exec($cURL);
            curl_close($cURL);
    
            $result = json_decode($response, true);
        }

        return response()->json(['success' => true], 200, [], JSON_PRETTY_PRINT);
    }
}
