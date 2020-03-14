<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Charts\DashboardChart;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkRole:author');
        $this->middleware('auth');
	}

    public function dashboard()
    {
        $comments = Comment::all();
        $todayComments = $comments->where('created_at', '>=', Carbon::today());


        $chart = new DashboardChart;
        $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());
        $posts = [];
        foreach ($days as $day) {
            $posts[] = Post::whereDate('created_at', $day)->where('user_id', Auth::id())->count();
        }
        $chart->dataset('Posts', 'line', $posts);
        $chart->labels($days);


    	return view('author.dashboard', compact('comments', 'todayComments', 'chart'));
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
    	return view('author.posts');
    }

    public function newPost()
    {
        return view('author.newPost');
    }

    public function storePost(PostRequest $request)
    {
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();        

        return back()->with('success', 'Post is successfully created!');
    }

    public function postEdit($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        return view('author.postEdit', compact('post'));
    }

    public function updatePost(PostRequest $request, $id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();        

        return back()->with('success', 'Post is successfully updated!');
    }

    public function postDelete($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->delete();
        return back()->with('success', 'Post is successfully deleted!');
    }

    public function comments()
    {
        $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();
        $comments = Comment::whereIn('post_id', $posts)->get();
    	return view('author.comments', compact('comments'));
    }
}
