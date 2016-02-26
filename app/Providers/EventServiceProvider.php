<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
        $events->listen('order.send_mail', function($data){
            try {

                \Log::info("------------- send mail -------------------");
                \Log::info($data);

                $html  = '';
                $html .= '<h1>견적서</h1>';
                $html .= '<h1>구매물품 : '.$data['product_id'].'</h1>';
                $html .= '<h1>구매수량 : '.$data['item_count'].'</h1>';

                $title = '견적서';
                $data = ['html' => $html];

                \Mail::send("emails.default", $data, function($message) use ($title) {
                    $message->from('kordermart@gmail.com');
                    $message->subject($title);
                    $message->to(['comsi02@gmail.com']);
                    $message->cc('comsi02@gmail.com');
                });

            } catch ( exception $e ) {
                \Log::info($e->getMessage());
            }
        });
    }
}
