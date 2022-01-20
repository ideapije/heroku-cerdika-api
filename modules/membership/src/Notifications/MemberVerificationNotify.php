<?php

namespace Modules\Membership\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Modules\Membership\Member;
use Modules\Membership\Mail\VerifyMemberMail;

class MemberVerificationNotify extends Notification
{
    use Queueable;
    protected $member;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new VerifyMemberMail($this->member))->to($notifiable->email);
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
            'title' => 'New Member',
            'body' => "{$notifiable->email} has been registered"
        ];
    }
}
