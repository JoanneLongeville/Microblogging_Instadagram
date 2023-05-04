<x-guest-layout>

<div class="flex flex-col shadow-md" style="max-width: 1000px; margin: 30px; border: 1px solid #e8e1de">

<!-- PHOTO + DESCRIPTION -->
<div class="flex flex-col">

	<div class="flex p-2 justify-between">
		<a href="{{ route('users.show', $post->user->id) }}" alt="Voir le profil" class="flex items-center">
			<div style="border-radius: 50%;
						height: 30px; width: 30px;
						border: solid 1px #ed4832;
						background-image: url('{{ url('storage/'.$post->user->photo) }}');
						background-position: center;
						background-size: cover;">
			</div>
			<p class="px-2" style="font-style: italic; font-size: 15px">{{ $post->user->name }}</p>
		</a>
		<!-- BOUTON LIKE -->
		<!-- Si le user connecté a déjà liké : bouton dislike -->
		@if ($post->liked(Auth::id()))
		<form method='GET' action="{{ route('posts.dislike', $post) }}">
			<input
				id="dislike"
				type='submit'
				value="{{$post->likeCount}} ❤️">
		</form>
		<!-- Si le user connecté n'a pas encore liké : bouton like -->
		@else
		<form method='GET' action="{{ route('posts.like', $post) }}">
			<input
				id="like"
				type='submit'
				value="{{$post->likeCount}} 🤍">
		</form>
		@endif
	</div>

	<div class="flex flex-col">
		<a href="{{ route('posts.show', $post) }}" alt="Lire le post" >
			<img src="{{ url('storage/'.$post->img_url) }}" alt="Photo de la publication">
			<p class="p-6 text-center">{{ $post->description }}</p>
		</a>
	</div>

</div>

</div>

</x-guest-layout>
