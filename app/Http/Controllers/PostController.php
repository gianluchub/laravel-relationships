<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\InfoPost;
use App\Tag;
use App\Image;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostController extends Controller
{
    private $postValidation = [
        'title' => 'required|string|max:150',
        'subtitle' => 'required|string|max:100',
        'text' => 'required|string',
        'author' => 'required|string|max:60',
        'img_path' => 'required|string|max:255',
        'publication_date' => 'required|date'
     ];   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select * from posts;
        $posts = Post::all();
        // dd($posts);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $images = Image::all();
        return view('posts.create', compact('tags', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $data["slug"] = Str::slug($data["title"]);

        $request->validate($this->postValidation);

        // creazione e salvataggio del post    
        $post = new Post();
        $post->fill($data);
        $postSaveResult = $post->save();

        // creazione e salvataggio postInfo
        $data["post_id"] = $post->id;
        $infoPost = new InfoPost();
        $infoPost->fill($data);
        $infoPostSaveResult = $infoPost->save();

        if($postSaveResult && !empty($data["tags"])) {
            $post->tags()->attach($data["tags"]);
        }

        if($postSaveResult && !empty($data["images"])) {
            $post->images()->attach($data["images"]);
        }

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post ' . $post->name . ' creato correttamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $now = new Carbon();
        // dump($now->toDateString());

        $adesso = Carbon::now();    
        dump($adesso->toDateTimeString());
        // $oggi = Carbon::today();
        // dump($oggi->toDateTimeString());
        $ieri = Carbon::yesterday();
        // dump($ieri->toDateTimeString());
        dump($ieri->format('l d/m/Y'));

        $lezioneDiIeri = Carbon::create(2021, 2, 22, 9, 30, 0, 'Europe/Rome');
        dump("IERI: ". $lezioneDiIeri->format('l d/m/Y H:i:s'));
        dump("In italiano: ". $lezioneDiIeri->locale('ja')->isoFormat('dddd DD/MM/YYYY'));

        $dopodomani = Carbon::createFromFormat("d-m-Y", "25-02-2021");
        dump("DOPODOMANI: " . $dopodomani->format('l d/m/Y H:i:s'));

        dump($lezioneDiIeri->lt($dopodomani));
        dump($lezioneDiIeri->isSameWeek($dopodomani));

        dump($lezioneDiIeri->diffInMinutes($dopodomani));
        return view('posts.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $images = Image::all();
        return view('posts.edit', compact('post', 'tags', 'images'));
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
        $data = $request->all();
        $data["slug"] = Str::slug($data["title"]);

        $request->validate($this->postValidation);

        $post->update($data);

        $infoPost = $post->infoPost;
        // $infoPost = InfoPost::where('post_id', $post->id)->first();
        // $data["post_id"] = $post->id;
        $infoPost->update($data);

        if(empty($data["tags"])) {
            $post->tags()->detach();
        } else {
            $post->tags()->sync($data["tags"]);
        }

        if(empty($data["images"])) {
            $post->images()->detach();
        } else {
            $post->images()->sync($data["images"]);
        }

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post ' . $post->name . ' aggiornato correttamente!');
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

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post ' . $post->name . ' cancellato correttamente!');
    }
}
