
<x-guest-layout>

<div class="flex pt-6 items-center">
	<a href="{{ route('users.show', $user->id) }}" alt="Voir le profil" class="px-4">
		<div style="border-radius: 50%;
					height: 80px; width: 80px; border: solid 1px #ed4832;
					background-image: url('{{ url('storage/'.$user->photo) }}');
					background-position: center;
					background-size: cover;">
		</div>
	</a>
	<h1 class="text-center" style="color: #ed4832; font-weight: bold; font-size: 30px">{{ $user->name }}</h1>
</div>

<div class="flex flex-col shadow-md p-6 text-center" style="max-width: 600px; margin: 40px; border: 1px solid #e8e1de">
	<!-- <p class="">ID : {{ $user->id }}</p>
	<p class="py-2" style="font-style: italic">{{ $user->email }}</p> -->
	<p class="">{{ $user->biography }}</p>

	@if ( $user->id == Auth::id() )
	<button class="mt-4 rounded-lg" style="background-color: #ed4832; color: white">
		<a href="{{ route('profile.edit') }}" title="Voir la publication" >Éditer mes infos</a>
	</button>
	@endif

</div>

  <!-- On parcourt la collection de Post -->
	@foreach ($posts as $post)
	<div class="flex flex-col shadow-md" style="max-width: 600px; margin: 0 40px 40px 40px">

		<!-- PHOTO + DESCRIPTION -->
		<div class="flex flex-col">
			<a href="{{ route('posts.show', $post) }}" alt="Lire l'article" >
				<img src="{{ url('storage/'.$post->img_url) }}" alt="Photo de la publication">
				<p class="p-6 text-center">{{ $post->description }}</p>
			</a>

		</div>

		@if ( $user->id == Auth::id() )

		<!-- BOUTONS MODIFIER/SUPPRIMER -->
		<div class="flex justify-center" style="margin-bottom: 20px">

			<button class="px-4 rounded-lg" style="margin: 0 8px; background-color: #ed4832; color: white">
				<!-- Lien pour voir un Post : "posts.show" -->
				<a href="{{ route('posts.show', $post) }}" title="Voir la publication" >Voir</a>
			</button>

			<button class="px-4 rounded-lg" style="margin: 0 8px; background-color: #ed4832; color: white">
				<!-- Lien pour modifier un Post : "posts.edit" -->
				<a href="{{ route('posts.edit', $post) }}" title="Modifier la publication" >Modifier</a>
			</button>

			<button class="px-4 rounded-lg" style="margin: 0 8px; background-color: #ed4832; color: white">
				<!-- Formulaire pour supprimer un Post : "posts.destroy" -->
				<form method="POST" action="{{ route('posts.destroy', $post) }}" >
					<!-- CSRF token -->
					@csrf
					<!-- <input type="hidden" name="_method" value="DELETE"> -->
					@method("DELETE")
					<input type="submit" value="Supprimer">
				</form>
			</button>
		</div>

		@endif

	</div>
	@endforeach

</x-guest-layout>
