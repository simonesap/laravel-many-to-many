<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreatePostMail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Post::all();
        $datas = Post::orderBy('updated_at', 'DESC')->paginate(5);
        //$datas = Post::orderBy('updated_at', 'DESC')->get();
        $categories = Category::all();



        return view('admin.posts.index', compact('datas','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();


        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'
        ]);

        $request->validate([
            'content'
        ]);

        $request->validate([
            'image'
        ]);

        $request->validate([
            'slug'
        ]);


        $posts = $request->all();
        // dd($posts);

        $user = Auth::user();

        $post = new Post();

        // Arr::exists($posts, 'image')
        if(array_key_exists('image', $posts)){

            // if($post->image) Storage::delete($post->image);

            $image_url = Storage::put('post_images', $posts['image']);
            $posts['image'] = $image_url;
        };


        $post->fill($posts);
        //Generare slug perchè non passato nel form
        $post->slug = Str::slug($post->title, '-');
        $post->save();

        if (array_key_exists('tags', $posts)) $post->tags()->attach($posts['tags']);


        // dd(env('MAIL_USERNAME'));
        $mail = new CreatePostMail( $post );
        Mail::to($user->email)->send($mail);

        return redirect()->route('admin.posts.index', compact('post'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        // $categories = Category::all();

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $categories = Category::all();
        $tags = Tag::all();

        $post_tag_id = $post->tags->pluck('id')->toArray();
        // dd($post_tag_id);

        return view('admin.posts.edit', compact('post', 'categories','tags', 'post_tag_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title','content','image'
        ]);

        $data = $request->all();
        // dd($data);

        //Generare slug con sintassi alternativa
        $post['slug'] = Str::slug($request->title, '-');

         // Arr::exists($posts, 'image')
         if(array_key_exists('image', $data)){

            if($post->image) Storage::delete($post->image);

            $image_url = Storage::put('post_images', $data['image']);
            $data['image'] = $image_url;
        }

        $post->update($data);

        if (array_key_exists('tags', $data)) $post->tags()->sync($data['tags']);

        return redirect()->route('admin.posts.index', $post)->with('message', "Hai aggiornato con successo $post->title");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index', compact('post'))->with('message', "Hai eliminato con successo $post->title");
    }
}
