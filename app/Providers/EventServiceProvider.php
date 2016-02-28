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

                $title = "견적서";
                $data = [
                    'product_name' => $data['product_id'],
                    'item_count' => $data['item_count'],
                ];

                \Mail::send(['html' => 'emails.default'], $data, function($message) use ($title) {
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
