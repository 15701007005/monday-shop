<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribesNotice extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = '星期一商城订阅消息';
    public $latest;
    public $hottest;
    public $likest;


    public function __construct()
    {
        //
    }


    public function build()
    {

        $this->latest = Product::query()->latest()->first();
        $this->hottest = Product::query()->orderBy('safe_count', 'desc')->first();
        $this->likest = Product::query()->withCount('users')->orderBy('users_count', 'desc')->first();

        return $this->markdown('emails.subscribes');
    }
}
