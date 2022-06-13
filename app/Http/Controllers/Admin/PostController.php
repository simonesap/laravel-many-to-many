<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

use Illuminate\Support\Str;

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
        // $datas = Post::orderBy('updated_at', 'DESC')->paginate(4)->get();
        $datas = Post::orderBy('updated_at', 'DESC')->get();
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

        return view('admin.posts.create', compact('categories'));
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

        $post = new Post();

        $post->fill($posts);

        //Generare slug perchè non passato nel form
        $post->slug = Str::slug($post->title, '-');

        $post->save();

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

        return view('admin.posts.edit', compact('post', 'categories'));
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

        //Generare slug con sintassi alternativa
        $post['slug'] = Str::slug($request->title, '-');

        $post->update($data);

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
