<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Charts\DashboardChart;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkRole:admin');
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $chart = new DashboardChart;
        $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());
        $posts = [];
        foreach ($days as $day) {
            $posts[] = Post::whereDate('created_at', $day)->count();
        }
        $chart->dataset('Posts', 'line', $posts);
        $chart->labels($days);

        return view('admin.dashboard', compact('chart'));
    }

    private function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];

        for ($date = $start_date; $date->lte($end_date) ; $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    public function posts()
    {
        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }

    public function postEdit($id)
    {
        $post = Post::where('id', $id)->first();
        return view('admin.postEdit', compact('post'));
    }

    public function updatePost(PostRequest $request, $id)
    {
        $post = Post::where('id', $id)->first();
        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();        

        return back()->with('success', 'Post is successfully updated!');
    }

    public function postDelete($id)
    {
        $post = Post::where('id', $id)->delete();
        return back()->with('success', 'Post is successfully deleted!');
    }

    public function comments()
    {
        $comments = Comment::all();
        return view('admin.comments', compact('comments'));
    }

    public function commentDelete($id)
    {
        Comment::where('id', $id)->delete();
        return back();
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function userEdit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.userEdit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->admin == 1) {
            $user->admin = true;
        } elseif ($request->author == 1) {
            $user->author = true;
        } else {
            $user->author = 0;
            $user->admin = 0;
        }

        $user->save();        

        return back()->with('success', 'Successfully updated!');
    }

    public function userDelete($id)
    {
        User::where('id', $id)->delete();
        return back();
    }

    // Shop Management
    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function newProduct()
    {
        return view('admin.newProduct');
    }

    public function newProductPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'thumbnail' => 'required|file',
            'description' => 'required',
            'price' => 'required|regex:/^[0-9]+(\.[0-9]?)?$/'
        ]);

        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;

        $thumbnail = $request->file('thumbnail');
        $fileName = $thumbnail->getClientOriginalName();
        $thumbnail->move('product-images', $fileName);
        $product->thumbnail = 'product-images/' . $fileName;

        $product->save();

        return back()->with('success', 'Product added successfully!');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.editProduct', compact('product'));
    }

    public function editProductPost(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'thumbnail' => 'file',
            'description' => 'required',
            'price' => 'required|regex:/^[0-9]+(\.[0-9]?)?$/'
        ]);

        $product = Product::findOrFail($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $fileName = $thumbnail->getClientOriginalName();
            $thumbnail->move('product-images', $fileName);
            $product->thumbnail = 'product-images/' . $fileName;
        }

        $product->save();

        return back()->with('success', 'Product updated successfully!');
    }
}
