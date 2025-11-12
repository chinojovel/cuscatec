<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $order_id;

    public function __construct($name, $order_id)
    {
        $this->name = $name;
        $this->order_id = $order_id;
    }

    public function build()
    {
        return $this->markdown('emails.order.created')
                    ->subject('Customer Order Created')
                    ->with([
                        'name' => $this->name,
                        'order_id' => $this->order_id,
                    ]);
    }
}
