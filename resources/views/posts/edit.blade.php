<x-guest-layout>

    <h1 class="text-center p-6" style="color: #ed4832; font-weight: bold; font-size: 30px">Créer un post</h1>

    <div class="flex justify-center" style="margin-bottom: 50px">

        <!-- Si nous avons un Post $post -->
        @if (isset($post))
    
        <!-- Le formulaire est géré par la route "posts.update" -->
        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            <!-- method field is used to tell the browser that this "post" is actually a patch request -->
            {{  csrf_field() }}

            <!-- <input type="hidden" name="_method" value="PUT"> -->
            @method('PUT')
    
        @else
    
        <!-- Le formulaire est géré par la route "posts.store" -->
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        
        @endif

            <!-- Le token CSRF -->
            @csrf
            
            <div class="py-2">
                <!-- <label for="user_id" >Ton ID</label><br/> -->
                <!-- S'il y a un $post->title, on complète la valeur de l'input -->
			    <!-- <input type="number" name="user_id" value="{{ isset($post->user_id) ? $post->user_id : old('user_id') }}"  id="user_id" placeholder="Ton ID"> -->
                <input type="hidden" name="user_id" value="{{Auth::id()}}"  id="user_id" placeholder="Ton ID">

                @error("user_id")
                <div>{{ $message }}</div>
                @enderror
            </div>

            <!-- <div>
                <x-input-label for="user_id" :value="__('User ID')" />
                <x-text-input id="user_id" class="block mt-1 w-full" type="number" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" />
                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
            </div> -->

            <!-- S'il y a une image $post->picture, on l'affiche -->
            @if(isset($post->img_url))
            <div style="margin-bottom: 20px">
                <!-- <span>Couverture actuelle</span><br/> -->
                <img src="{{ asset('storage/'.$post->img_url) }}" alt="image de couverture actuelle" style="width: 600px">
            </div>
            @endif

            <div class="py-2">
                <!-- <label for="img_url" >Ta photo</label><br/> -->
                <input type="file" name="img_url" id="img_url" >
    
                <!-- Le message d'erreur pour "img_url" -->
                @error("img_url")
                <div>{{ $message }}</div>
                @enderror
            </div>

    
            <div class="py-2">
                <!-- S'il y a un $post->content, on complète la valeur du textarea -->
			    <textarea name="description" id="description" lang="fr" rows="10" cols="70" placeholder="La description du post" >{{ isset($post->description) ? $post->description : old('description') }}</textarea>
                
                <!-- Le message d'erreur pour "description" -->
                @error("description")
                <div>{{ $message }}</div>
                @enderror
            </div>
    
            <input
                type="submit" name="valider" value="Valider" 
                class="shadow py-2 px-4 rounded"
                style="background-color: #ed4832; color: white"
            >
    
        </form>

    </div>


</x-guest-layout>
