<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPosts = Post::latest()->paginate(10);

        //On récupère tous les Post mais on n'en affiche que 3
        $posts = Post::latest()->paginate(3);
        $userId = Post::all();

        // On transmet les Post à la vue
        return view("posts.index", compact("posts"), compact("allPosts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.edit");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. La validation
        $this->validate($request, [
            "user_id" => 'bail|required',
            "img_url" => 'bail|required|image',
            "description" => 'bail|required|string',
        ]);

        // 2. On upload l'image dans "/storage/app/public/posts"
        $chemin_image = $request->img_url->storePublicly("posts");

        // 3. On enregistre les informations du Post
        Post::create([
            "user_id" => $request->user_id,
            "img_url" => $chemin_image,
            "description" => $request->description,
        ]);

        // 4. On retourne vers tous les posts : route("posts.index")
        return redirect(route("posts.index"));

        //dd($post->description);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // $post->like();

        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Like the specified resource.
    */
    public function like(Request $request, $id): View
    {
        $post = Post::find($id);

        $post->like();

        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Dislike the specified resource.
    */
    public function dislike(Request $request, $id): View
    {
        $post = Post::find($id);

        $post->unlike();

        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Display the notifications.
    */
 
    public function notif(Request $request, $id)
    {        
        // find posts liked by user (with Likeable package)
        //$likedPosts = Post::whereLikedBy($id)->with('likeCounter')->orderby('created_at', 'desc')->get();
                                            // ->with('likeCounter') --> highly suggested to allow eager load

        // find posts liked by user
        $likedPosts = DB::table('likeable_likes')->where('user_id', $id)->orderby('created_at', 'desc')->get();
        
        // get posts of connected user
        $userPosts = Post::where('user_id', $id)->get();
        
        // get likes except from those from connected user
        $likes = DB::table('likeable_likes')
        ->join('users', 'likeable_likes.user_id', '=', 'users.id')
        ->select('likeable_likes.*', 'users.name', 'users.photo')
        ->whereNot('user_id', $id)
        ->whereIn('likeable_id', $userPosts->pluck('id'))
        ->orderby('created_at', 'desc')
        ->get();
        
        return view("posts.notif", compact("likes"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view("posts.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
            // 1. La validation

            // Les règles de validation pour "user_id" et "description"
            $rules = [
                "user_id" => 'bail|integer',
                "description" => 'bail|string',
            ];

            // Si une nouvelle image est envoyée
            if ($request->has("img_url")) {
                // On ajoute la règle de validation pour "img_url"
                $rules["img_url"] = 'bail|image|max:1024';
            }

            $this->validate($request, $rules);

            // 2. On upload l'image dans "/storage/app/public/posts"
            if ($request->has("img_url")) {

                //On supprime l'ancienne image
                Storage::delete($post->img_url);

                $chemin_image = $request->img_url->store("posts");
            }

            // 3. On met à jour les informations du Post
            $post->update([
                "user_id" => $request->user_id,
                "img_url" => isset($chemin_image) ? $chemin_image : $post->img_url,
                "description" => $request->description
            ]);

            // 4. On affiche le Post modifié : route("posts.show")
            return redirect(route("posts.show", $post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // On supprime l'image existant
        Storage::delete($post->img_url);

        // On supprimer les informations du $post de la table "posts"
        $post->delete();

        // Redirection route "posts.index"
        return redirect(route('posts.index'));
    }
}
