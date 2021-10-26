<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Applicant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicantAppliedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param Applicant $applicant
     * @return void
     */
    public function __construct(public Applicant $applicant)
    {
        $this->subject = "You applied to {$this->applicant->job?->title}";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->markdown('emails.applicant_applied');
    }
}
