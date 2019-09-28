<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $orderData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderData)
    {
        $this->orderData = $orderData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = $this->orderData['email'];
        $name = $this->orderData['name'];
        $subject = "Your Order ".''.$this->orderData['product_name'].' to be'.$this->orderData['status'];
        return $this->view('email.test')
        ->from($address, $name)
        ->subject($subject);
    }
}
