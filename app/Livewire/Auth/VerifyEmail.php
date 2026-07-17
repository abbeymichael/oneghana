<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class VerifyEmail extends Component
{
    public function resend()
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard'));
        }

        auth()->user()->sendEmailVerificationNotification();
        session()->flash('message', 'Verification link sent!');
    }

    public function render()
    {
        return view('livewire.auth.verify-email')->layout('layouts.app');
    }
}
