<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Gym;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'age' => ['required', 'integer', 'min:13', 'max:120'],
            'gender' => ['required', 'in:male,female,other'],
            'matching_enabled' => ['boolean'],
            'gym_name' => ['required', 'string', 'max:255'],
            'gym_prefecture' => ['required', 'string', 'max:255'],
            'gym_city' => ['required', 'string', 'max:255'],
            'gym_address' => ['required', 'string', 'max:255'],
        ]);

        // ジムの検索または作成
        $gym = Gym::firstOrCreate([
            'name' => $request->gym_name,
            'prefecture' => $request->gym_prefecture,
            'city' => $request->gym_city,
            'address' => $request->gym_address,
        ]);

        // ユーザーIDの生成（重複チェック付き）
        do {
            $userId = 'USR' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        } while (User::where('user_id', $userId)->exists());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_id' => $userId,
            'age' => $request->age,
            'gender' => $request->gender,
            'matching_enabled' => $request->boolean('matching_enabled', false),
            'gym_id' => $gym->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
