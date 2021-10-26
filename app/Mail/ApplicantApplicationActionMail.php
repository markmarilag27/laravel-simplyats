<?php

declare(strict_types=1);

namespace App\Mail;

use App\Enums\ApplicantStatus;
use App\Models\Applicant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicantApplicationActionMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var bool $approved */
    public bool $approved;

    /**
     * Create a new message instance.
     *
     * @param Applicant $applicant
     * @param string $status
     */
    public function __construct(public Applicant $applicant, public string $status)
    {
        $this->approved = $this->status === ApplicantStatus::APPROVE;
        $this->subject = "Your application for {$this->applicant->job?->title} has been {$this->status}";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->markdown('emails.applicant_application_action');
    }
}
