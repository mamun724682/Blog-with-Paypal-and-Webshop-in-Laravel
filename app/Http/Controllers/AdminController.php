<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;
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
}
