<?php

return [

    // Tasks
    //
    // Here you can define in the `before` and `after` array, Tasks to execute
    // before or after the core Rocketeer Tasks. You can either put a simple command,
    // a closure which receives a $task object, or the name of a class extending
    // the Rocketeer\Abstracts\AbstractTask class
    //
    // In the `custom` array you can list custom Tasks classes to be added
    // to Rocketeer. Those will then be available in the command line
    // with all the other tasks
    //////////////////////////////////////////////////////////////////////

    // Tasks to execute before the core Rocketeer Tasks
    'before' => [
        'setup'   => [],
        'deploy'  => [],
        'cleanup' => [],
    ],

    // Tasks to execute after the core Rocketeer Tasks
    'after'  => [
        'setup'   => [],
        'deploy'  => [
            function($task) {
                $task->command->info('Start chanage Permission : ');
                $task->setPermissions('storage');
                $task->setPermissions('bootstrap/cache');

                $task->command->info('Permission change Complete!');
                $task->runForCurrentRelease('cp /home/www/env/.env .env');
                $task->runForCurrentRelease('php artisan migrate --force');
                $task->runForCurrentRelease('php artisan cache:clear');
                $task->runForCurrentRelease('php artisan route:cache');
                $task->runForCurrentRelease('sudo service php-fpm reload');
                $task->runForCurrentRelease('sudo /usr/local/bin/composer.phar self-update');
                $task->runForCurrentRelease('sudo /usr/local/bin/composer.phar dump-autoload');
            }
        ],
        'cleanup' => [],
    ],

    // Custom Tasks to register with Rocketeer
    'custom' => [],

];
