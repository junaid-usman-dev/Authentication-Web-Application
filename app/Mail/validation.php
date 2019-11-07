<?php

namespace App\Mail;

use App\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class validation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The customer instance.
     *
     * @var Customer
     */
    protected $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        //
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->customer->verified_email == 0)
        {
            return $this->from('example@example.com')->view('registration/emails/forget_password')
                ->with([
                        'verification_key' => $this->customer->verification_key,
                        'customer' => $this->customer,
                ]);
        }
        else 
        {
            return $this->from('example@example.com')->view('registration/emails/forget_password')
                ->with([
                        'verification_key' => $this->customer->verification_key,
                        'customer' => $this->customer,
                ]);
        }
            
    }
}
