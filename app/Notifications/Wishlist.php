<?php

namespace App\Notifications;

use App\WishlistSession;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Wishlist extends Notification
{
    use Queueable;
	protected $wishlist;
	protected $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(WishlistSession $wishlist, $url)
    {
        $this->wishlist = $wishlist;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
    	$wishlist = $this->wishlist;
    	$url = $this->url;
        return (new MailMessage)
	        ->subject('Neue Wunschliste')
	        ->markdown('mail.wishlist', ['wishlist' => $wishlist, 'url' => $url]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
