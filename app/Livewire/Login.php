<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';

    protected $rules = [
        'email' => 'required|email|min:10|max:100',
        'password' => 'required|string|min:5|max:100',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();

            $user = Auth::user();


            if ($user->role === 'siswa') {
                return redirect()->intended('/dashboard/siswa');
            } elseif ($user->role === 'guru' || $user->role === 'admin') {
                return redirect()->intended('/admin');
            } else {
                Auth::logout();
                $this->addError('email', 'Role tidak valid.');
                return;
            }
        }

        $this->addError('email', 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
