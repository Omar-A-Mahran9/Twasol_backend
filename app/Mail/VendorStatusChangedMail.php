<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorStatusChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $status;
    public $resetLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor, $status, $resetLink)
    {
        $this->vendor = $vendor;
        $this->status = $status;
        $this->resetLink = $resetLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.vendorActivationMail')
            ->with([
                'vendorEmail' => $this->vendor->email,
                'status' => $this->status,
                'resetLink'=>$this->resetLink
            ]);
    }
}
