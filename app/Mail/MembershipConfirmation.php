<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\MembershipTier;

class MembershipConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $membershipTier;
    public $membershipStartDate;
    public $membershipEndDate;

    public function __construct(User $user, MembershipTier $membershipTier, $membershipStartDate, $membershipEndDate)
    {
        $this->user = $user;
        $this->membershipTier = $membershipTier; // Pass the full membershipTier object
        $this->membershipStartDate = $membershipStartDate;
        $this->membershipEndDate = $membershipEndDate;
    }

    public function build()
    {
        return $this->subject('Your Membership Purchase is Confirmed!')
                    ->view('emails.membership_confirmation')
                    ->with([
                        'user' => $this->user,
                        'membershipTier' => $this->membershipTier,
                        'membershipStartDate' => $this->membershipStartDate,
                        'membershipEndDate' => $this->membershipEndDate,
                    ]);
    }
}
