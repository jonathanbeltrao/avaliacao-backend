<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Favorite;

class FavoriteList extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $favorites;

    public function __construct(User $user, Array $favorites)
    {
        $this->user = $user;
        $this->favorites = $favorites;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.favorite-list')
        ->subject('Sua Lista de Favoritos Atualizada')
        ->with([
            'userName' => $this->user->name,
            'favoriteList' => $this->favorites
        ]);
    }
}
