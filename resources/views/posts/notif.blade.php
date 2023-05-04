<x-guest-layout>

<h1 class="text-center p-6" style="color: #ed4832; font-weight: bold; font-size: 30px">Notifications</h1>

<div class="flex flex-col p-6" style="">

@foreach ($likes as $like)

        <div class="flex items-center justify-between" style="margin: 10px 0;">

            <div class="flex items-center">
                <!-- Photo de profil -->
                <a href="{{ route('users.show', $like->user_id) }}" alt="Voir le profil" class="">
                    <div style="border-radius: 50%;
                                height: 50px; width: 50px;
                                border: solid 1px #ed4832;
                                background-image: url('{{ url('storage/'.$like->photo) }}');
                                background-position: center;
                                background-size: cover;">
                    </div>
                </a>
            
                <!-- Notification -->
                <p class="p-6 text-center">
                    <span style="font-weight: bold">
                        <a href="{{ route('users.show', $like->user_id) }}" alt="Voir le profil" class="">
                            {{ $like->name }}
                        </a>
                    </span>
                    a liké ton post n°
                    <span style="font-weight: bold">
                        <a href="{{ route('posts.show', $like->likeable_id) }}" alt="Lire le post" class="">
                            {{ $like->likeable_id }}
                        </a>
                    </span>
                </p>
            </div>

            <div style="width: 100px">
            </div>

        </div>

@endforeach

</div>

</x-guest-layout>
