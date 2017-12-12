<?php

/** @var  $artisan \App\Console\Kernel */
$artisan->command("email:send {user}", function($user){
    $this->info(" send {$user}");
});