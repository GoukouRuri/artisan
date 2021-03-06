<?php return array (
  'providers' => 
  array (
    0 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    1 => 'Illuminate\\Bus\\BusServiceProvider',
    2 => 'Illuminate\\Cache\\CacheServiceProvider',
    3 => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    4 => 'Illuminate\\Database\\DatabaseServiceProvider',
    5 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
    6 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    7 => 'App\\Foundation\\Providers\\FoundationServiceProvider',
    8 => 'Illuminate\\Hashing\\HashServiceProvider',
    9 => 'Illuminate\\Mail\\MailServiceProvider',
    10 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
    11 => 'Illuminate\\Queue\\QueueServiceProvider',
    12 => 'Illuminate\\Redis\\RedisServiceProvider',
    13 => 'App\\Providers\\AppServiceProvider',
    14 => 'App\\Providers\\EventServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Illuminate\\Database\\DatabaseServiceProvider',
    1 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
    2 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    3 => 'App\\Foundation\\Providers\\FoundationServiceProvider',
    4 => 'App\\Providers\\AppServiceProvider',
    5 => 'App\\Providers\\EventServiceProvider',
  ),
  'deferred' => 
  array (
    'Illuminate\\Broadcasting\\BroadcastManager' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    'Illuminate\\Contracts\\Broadcasting\\Factory' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    'Illuminate\\Contracts\\Broadcasting\\Broadcaster' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    'Illuminate\\Bus\\Dispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'Illuminate\\Contracts\\Bus\\Dispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'Illuminate\\Contracts\\Bus\\QueueingDispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'cache' => 'Illuminate\\Cache\\CacheServiceProvider',
    'cache.store' => 'Illuminate\\Cache\\CacheServiceProvider',
    'memcached.connector' => 'Illuminate\\Cache\\CacheServiceProvider',
    'command.cache.clear' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.cache.forget' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.clear-compiled' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.auth.resets.clear' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.config.cache' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.config.clear' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.down' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.environment' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.key.generate' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.install' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.refresh' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.reset' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.rollback' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.status' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.optimize' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.failed' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.flush' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.forget' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.listen' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.restart' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.retry' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.work' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.route.cache' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.route.clear' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.route.list' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.seed' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'Illuminate\\Console\\Scheduling\\ScheduleFinishCommand' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'Illuminate\\Console\\Scheduling\\ScheduleRunCommand' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.storage.link' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.up' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.view.clear' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.app.name' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.auth.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.cache.table' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.console.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.controller.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.event.generate' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.event.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.job.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.listener.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.mail.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.middleware.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.model.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.notification.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.notification.table' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.policy.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.provider.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.failed-table' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.table' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.request.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.seeder.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.session.table' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.serve' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.test.make' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.vendor.publish' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'migrator' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'migration.repository' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'migration.creator' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'composer' => 'App\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'hash' => 'Illuminate\\Hashing\\HashServiceProvider',
    'mailer' => 'Illuminate\\Mail\\MailServiceProvider',
    'swift.mailer' => 'Illuminate\\Mail\\MailServiceProvider',
    'swift.transport' => 'Illuminate\\Mail\\MailServiceProvider',
    'Illuminate\\Mail\\Markdown' => 'Illuminate\\Mail\\MailServiceProvider',
    'Illuminate\\Contracts\\Pipeline\\Hub' => 'Illuminate\\Pipeline\\PipelineServiceProvider',
    'queue' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.worker' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.listener' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.failer' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.connection' => 'Illuminate\\Queue\\QueueServiceProvider',
    'redis' => 'Illuminate\\Redis\\RedisServiceProvider',
    'redis.connection' => 'Illuminate\\Redis\\RedisServiceProvider',
  ),
  'when' => 
  array (
    'Illuminate\\Broadcasting\\BroadcastServiceProvider' => 
    array (
    ),
    'Illuminate\\Bus\\BusServiceProvider' => 
    array (
    ),
    'Illuminate\\Cache\\CacheServiceProvider' => 
    array (
    ),
    'App\\Foundation\\Providers\\ConsoleSupportServiceProvider' => 
    array (
    ),
    'Illuminate\\Hashing\\HashServiceProvider' => 
    array (
    ),
    'Illuminate\\Mail\\MailServiceProvider' => 
    array (
    ),
    'Illuminate\\Pipeline\\PipelineServiceProvider' => 
    array (
    ),
    'Illuminate\\Queue\\QueueServiceProvider' => 
    array (
    ),
    'Illuminate\\Redis\\RedisServiceProvider' => 
    array (
    ),
  ),
);