<?php

namespace App\Listeners;

use App\Events\NewBlogCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
class SendBlogNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewBlogCreated  $event
     * @return void
     */
    public function handle(NewBlogCreated $event)
    {
        $blog = $event->blog;
    // lắng nghe sự kiện
        // Lấy tất cả email từ bảng contacts
        $emails = Contact::pluck('email');

        foreach ($emails as $email) {
            Mail::send('emails.new_blog', ['blog' => $blog], function ($message) use ($email) {
                $message->to($email)
                        ->subject('Thông báo: Có bài viết mới!');
            });
        }
    }
}
