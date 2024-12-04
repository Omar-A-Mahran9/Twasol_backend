<?php

namespace App\Listeners;

use App\Events\VendorStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendStatusChangeEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  VendorStatusChanged  $event
     * @return void
     */
    public function handle(VendorStatusChanged $event)
    {
        // Logic to send the email
        $vendor = $event->vendor;
        $status = $event->status;
        $resetLink = $event->resetLink;
        // Assuming you have a mailable class VendorStatusChangedMail
        Mail::to($vendor->email)->send(new \App\Mail\VendorStatusChangedMail($vendor, $status, $resetLink));
    }
}
