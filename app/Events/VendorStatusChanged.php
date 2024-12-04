<?php

namespace App\Events;

use App\Models\Vendor;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VendorStatusChanged
{
    use Dispatchable, SerializesModels;

    public $vendor;
    public $status;
    public $resetLink;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor, $status, $resetLink)
    {
        $this->vendor = $vendor;
        $this->status = $status;
        $this->resetLink = $resetLink;
    }
}
