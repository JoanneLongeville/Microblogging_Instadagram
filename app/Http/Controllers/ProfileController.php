<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{   
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
    */

    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $path = $request->file('photo')->store("users");
        $request->user()->photo = $path;

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    // {
    //     // Les règles de validation
    //     $rules = [
    //         'name' => ['string', 'max:255'],
    //         'email' => ['string', 'email', 'max:255'],
    //         'biography' => ['string'],
    //     ];

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     // Si une nouvelle image est envoyée
    //     if ($request->has("photo")) {
    //         // On ajoute la règle de validation pour "photo"
    //         $rules["photo"] = 'bail|image';
    //     }

    //     $this->validate($request, $rules);

    //     // 2. On upload l'image dans "/storage/app/public/users"
    //     if ($request->has("photo")) {
    //         //On supprime l'ancienne image
    //         !is_null($user->photo) && Storage::delete($user->photo);
    //         //On stocke la nouvelle
    //         $chemin_image = $request->photo->store("users");
    //     }

    //     // 3. On met à jour les informations du User
    //     $user->update([
    //         "name" => $request->name,
    //         "email" => $request->email,
    //         "photo" => isset($chemin_image) ? $chemin_image : $user->photo,
    //         "biography" => $request->biography,
    //         'updated_at' => now()
    //     ]);

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/posts');
    }
}
