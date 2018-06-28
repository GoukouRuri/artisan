### 简介

Artisan 是 Laravel 自带的命令行接口，它为我们在开发过程中提供了很多有用的命令。想要查看所有可用的 Artisan 命令，可使用 `list` 命令： 

```
php artisan list
```

每个命令都可以用 `help` 指令显示命令描述及命令参数和选项。想要查看帮助界面，只需要在命令前加上 `help` 就可以了：

```
php artisan help migrate
```

**Laravel REPL**

所有的 Laravel 应用都提供了 Tinker —— 一个由 [PsySH](https://github.com/bobthecow/psysh) 扩展包驱动的 REPL（Read-Eval-Print Loop，即终端命令行“读取-求值-输出”循环工具）。Tinker 允许你通过命令行与整个 Laravel 应用进行交互，包括 Eloquent ORM、任务、事件等等。要进入 Tinker 环境，运行 `tinker` 命令即可：

```
php artisan tinker
```

> 注：关于 Tinker 的使用方法可以查看这篇教程[使用 Php Artisan Tinker 来调试你的 Laravel](http://laravelacademy.org/post/4935.html)

### 编写命令

除了 Artisan 提供的系统命令之外，还可以编写自己的命令。自定义命令通常存放在 `app/Console/Commands` 目录下；当然，你也可以自己选择存放位置，只要该命令类可以被 Composer 自动加载即可。

#### 生成命令

要创建一个新命令，你可以使用 Artisan 命令 `make:command`，该命令会在 `app/Console/Commands` 目录下创建一个新的命令类。如果该目录不存在，不用担心，它将会在你首次运行 Artisan 命令 `make:command` 时被创建。生成的命令将会包含默认的属性设置以及所有命令都共有的方法：

```
php artisan make:command SendEmails
```

#### 命令结构

命令生成以后，需要填写该类的 `signature` 和 `description` 属性，这两个属性在调用 `list` 显示命令的时候会被用到。`handle` 方法在命令执行时被调用，你可以将所有命令逻辑都放在这个方法里面。

> 注：为了更好地实现代码复用，最佳实践是保持控制台命令的轻量并让它们延迟到应用服务中完成任务。在下面的例子中，我们注入了一个服务类来完成发送邮件这样的“繁重”任务。

下面让我们来看一个例子，注意我们可以在命令类的构造函数中注入任何依赖，Laravel [服务容器](http://laravelacademy.org/post/8695.html)将会在构造函数中自动注入所有依赖类型提示：

```
<?php

namespace App\Console\Commands;

use App\User;
use App\DripEmailer;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * @translator laravelacademy.org
     */
    protected $signature = 'email:send {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send drip e-mails to a user';

    /**
     * The drip e-mail service.
     *
     * @var DripEmailer
     */
    protected $drip;

    /**
     * Create a new command instance.
     *
     * @param  DripEmailer  $drip
     * @return void
     */
    public function __construct(DripEmailer $drip)
    {
        parent::__construct();

        $this->drip = $drip;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->drip->send(User::find($this->argument('user')));
    }
}
```

#### 闭包命令

基于闭包的命令和闭包路由之于控制器一样，为以类的方式定义控制台命令提供了可选方案，在 `app/Console/Kernel.php` 文件的 `commands` 方法中，Laravel 加载了 `routes/console.php` 文件：

```
/**
 * 为应用注册基于闭包的命令.
 *
 * @return void
 */
protected function commands()
{
    require base_path('routes/console.php');
}
```

尽管这个文件没有定义 HTTP 路由，但是它定义了基于控制台的应用入口（和路由作用一样），在这个文件中，你可以使用 `Artisan::command` 方法定义所有基于闭包的路由。`command` 方法接收两个参数 —— [命令标识](http://laravelacademy.org/post/8938.html#toc_5)和接收命令参数和选项的闭包：

```
Artisan::command('build {project}', function ($project) {
    $this->info("Building {$project}!");
});
```

该闭包被绑定到底层命令实例，所以你可以像在完整的命令类中一样访问所有辅助方法。

将上面的代码拷贝到 `routes/console.php` 文件后就可以在终端调用了：

![img](http://static.laravelacademy.org/wp-content/uploads/2018/03/15189537131471.jpg)￼

**类型提示依赖**

除了接收命令参数和选项外，闭包命令还可以类型提示服务容器之外解析的额外依赖：

```
use App\User;
use App\DripEmailer;

Artisan::command('email:send {user}', function (DripEmailer $drip, $user) {
    $drip->send(User::find($user));
});
```

**闭包命令描述**

定义基于闭包的命令时，可以使用 `describe` 方法来添加命令描述，这个描述将会在运行 `php artisan list` 或 `php artisan help` 命令时显示：

```
Artisan::command('build {project}', function ($project) {
    $this->info("Building {$project}!");
})->describe('Build the project');
```

### 定义期望输入

编写控制台命令的时候，通常通过参数和选项收集用户输入，Laravel 使这项操作变得很方便：在命令中使用 `signature` 属性来定义我们期望的用户输入。`signature` 属性通过一个优雅的、路由风格的语法允许你定义命令的名称、参数以及选项。

#### 参数

所有用户提供的参数和选项都包含在花括号里，下面这个例子定义的命令要求用户输入**必选**参数 `user`：

```
/**
 * 控制台命令名称
 *
 * @var string
 */
protected $signature = 'email:send {user}';
```

你还可以让该参数可选并定义默认的可选参数值：

```
// 选项参数...
email:send {user?}
// 带默认值的选项参数...
email:send {user=foo}
```

#### 选项

选项，和参数一样，是用户输入的另一种格式，不同之处在于选项前面有两个短划线（`--`），有两种类型的选项：接收值和不接收值的。不接收值的选项一般用作布尔开关。我们来看一个这种类型的选项：

```
/**
 * 控制台命令名称
 *
 * @var string
 */
protected $signature = 'email:send {user} {--queue}';
```

在本例中，`--queue` 开关在调用 Artisan 命令的时候被指定。如果 `--queue` 被传递，对应开关值是 `true`，否则其值是 `false`：

```
php artisan email:send 1 --queue
```

**带值的选项**

接下来，我们来看一个带值的选项，如果用户必须为选项指定值，需要通过`=`进行分配：

```
/**
 * 控制台命令名称
 *
 * @var string
 */
protected $signature = 'email:send {user} {--queue=}';
```

在这个例子中，用户可以通过这样的方式传值：

```
php artisan email:send 1 --queue=default
```

还可以给选项分配默认值，如果用户没有传递值给选项，将会使用默认值：

```
email:send {user} {--queue=default}
```

**选项简写**

如果想要为命令选项分配一个简写，可以在选项前指定并使用分隔符`|`将简写和完整选项名分开：

```
email:send {user} {--Q|queue}
```

#### 输入数组

如果你想要定义参数和选项以便指定输入数组，可以使用字符`*`，首先，让我们看一个指定数组参数的例子：

```
email:send {user*}
```

调用这个方法时，`user` 参数会顺序传递到命令行，例如，下面的命令会设置 `user` 的值为 `['foo', 'bar']`：

```
php artisan email:send foo bar
```

定义一个期望输入数组的选项时，每个传递给命令的选项值都应该加上选项名前缀：

```
email:send {user} {--id=*}

php artisan email:send --id=1 --id=2
```

#### 输入描述

你可以通过冒号将参数和描述进行分隔的方式分配描述到输入参数和选项，如果你需要一些空间来定义命令，可以通过换行来定义命令：

```
/**
 * 控制台命令名称
 *
 * @var string
 * @translator laravelacademy.org
 */
protected $signature = 'email:send
                        {user : The ID of the user}
                        {--queue= : Whether the job should be queued}';
```

### 命令 I/O

#### 获取输入

在命令被执行的时候，很明显，你需要访问命令获取的参数和选项的值。使用 `argument` 和 `option` 方法即可实现：

```
/**
 * 执行控制台命令.
 *
 * @return mixed
 */
public function handle()
{
    $userId = $this->argument('user');

    //
}
```

如果需要以数组方式返回所有参数的值，调用 `arguments` 方法：

```
$arguments = $this->arguments();
```

选项值和参数值的获取一样简单，使用 `option` 方法，要以数组方式返回所有选项值，可以调用 `options` 方法：

```
// 获取指定选项...
$queueName = $this->option('queue');

// 获取所有选项...
$options = $this->options();
```

如果参数或选项不存在，返回 `null`。

#### 输入提示

除了显示输出之外，你可能还要在命令执行期间要用户提供输入。`ask` 方法将会使用给定问题提示用户，接收输入，然后返回用户输入到命令：

```
/**
 * 执行控制台命令
 *
 * @return mixed
 */
public function handle(){
    $name = $this->ask('What is your name?');
}
```

`secret` 方法和 `ask` 方法类似，但用户输入在终端对他们而言是不可见的，这个方法在问用户一些敏感信息如密码时很有用：

```
$password = $this->secret('What is the password?');
```

**让用户确认**

如果你需要让用户确认信息，可以使用 `confirm` 方法，默认情况下，该方法返回 `false`，如果用户输入`y`，则该方法返回`true`：

```
if ($this->confirm('Do you wish to continue? [y|N]')) {
    //
}
```

**自动完成**

`anticipate` 方法可用于为可能的选项提供自动完成功能，用户仍然可以选择答案，而不管这些选择：

```
$name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
```

**给用户提供选择**

如果你需要给用户预定义的选择，可以使用 `choice` 方法。用户选择答案的索引，但是返回给你的是答案的值。如果用户什么都没选的话你可以设置默认返回的值：

```
$name = $this->choice('What is your name?', ['Taylor', 'Dayle'], $defaultIndex);
```

#### 编写输出

要将输出发送到控制台，使用 `line`, `info`, `comment`, `question` 和 `error` 方法，每个方法都会使用相应的 ANSI 颜色以作标识。例如，要显示一条信息消息给用户， 使用 `info` 方法在终端显示为绿色：

```
/**
 * 执行控制台命令
 *
 * @return mixed
 */
public function handle(){
    $this->info('Display this on the screen');
}
```

要显示一条错误消息，使用 `error` 方法。错误消息文本通常是红色：

```
$this->error('Something went wrong!');
```

如果你想要显示原生输出，可以使用`line` 方法，该方法输出的字符不带颜色：

```
$this->line('Display this on the screen');
```

**表格布局**

`table` 方法使输出多行/列格式的数据变得简单，只需要将头和行传递给该方法，宽度和高度将基于给定数据自动计算：

```
$headers = ['Name', 'Email'];
$users = App\User::all(['name', 'email'])->toArray();
$this->table($headers, $users);
```

表格布局输出如下：

![img](http://static.laravelacademy.org/wp-content/uploads/2018/02/laravel-artisan-table.jpg)

**进度条**

对需要较长时间运行的任务，显示进度指示器很有用，使用该输出对象，我们可以开始、前进以及停止该进度条。在开始进度时你必须定义步数，然后每走一步进度条前进一格：

```
Artisan::command('test', function () {
    $users = App\User::all();

    $bar = $this->output->createProgressBar(count($users));
    foreach ($users as $user) {
        //$this->performTask($user);
        sleep(3); // 模拟任务执行
        $bar->advance();
    }

    $bar->finish();
    $this->info('task finished!');
});
```

进度条输出如下：

![img](http://static.laravelacademy.org/wp-content/uploads/2018/02/laravel-artisan-processor.jpg)

想要了解更多，查看[Symfony进度条组件文档](https://symfony.com/doc/2.7/components/console/helpers/progressbar.html)。

### 注册命令

由于 Console Kernel 的 `commands` 方法会调用 `load` 方法，所有 `app/Console/Commands` 目录下的命令都会通过 Artisan 自动注册。实际上，你可以额外调用 `load` 方法来遍历其他目录下的 Artisan 命令：

```
/**
 * Register the commands for the application.
 *
 * @return void
 */
protected function commands()
{
    $this->load(__DIR__.'/Commands');
    $this->load(__DIR__.'/MoreCommands');

    // ...
}
```

此外，还可以在 `app/Console/Kernel.php` 类的 `$commands` 属性中通过手动添加类名的方式来注册命令。当 Artisan 启动的时候，该属性中列出的命令将会被服务容器解析并通过 Artisan 注册：

```
protected $commands = [
    Commands\SendEmails::class
];
```

### 通过代码调用命令

有时候你可能希望在 CLI 之外执行 Artisan 命令，比如，你可能希望在路由或控制器中触发 Artisan 命令，这可以使用 `Artisan` 门面上的 `call` 方法来实现。`call` 方法接收被执行的命令名称作为第一个参数，命令参数数组作为第二个参数，退出码会被返回：

```
Route::get('/foo', function () {
    $exitCode = Artisan::call('email:send', [
        'user' => 1, '--queue' => 'default'
    ]);
});
```

使用 `Artisan` 门面上的 `queue` 方法，你甚至可以将 Artisan 命令放到队列中，这样它们就可以通过后台的队列工作者来处理。在使用此方法之前，确保你配置好了队列并且运行了队列监听器：

```
Route::get('/foo', function () {
    Artisan::queue('email:send', [
        'user' => 1, '--queue' => 'default'
    ]);
});
```

还可以指定 Artisan 命令被分发到的连接或队列：

```
Artisan::queue('email:send', [
    'user' => 1, '--queue' => 'default'
])->onConnection('redis')->onQueue('commands');
```

**传递数组值**

如果命令定义了接收数组的选项，可以传递数组值到该选项：

```
Route::get('/foo', function () {
    $exitCode = Artisan::call('email:send', [
        'user' => 1, '--id' => [5, 13]
    ]);
});
```

**传递布尔值**

如果你需要指定不接收字符串的选项值，例如 `migrate:refresh` 命令上的`--force` 标识，可以传递布尔值 `true` 或 `false`：

```
$exitCode = Artisan::call('migrate:refresh', [
    '--force' => true,
]);
```

#### 通过其他命令调用命令

有时候你希望从一个已存在的 Artisan 命令中调用其它命令。你可以通过使用 `call` 方法开实现这一目的。`call` 方法接收命令名称和数组形式的命令参数：

```
/**
 * 执行控制台命令
 *
 * @return mixed
 */
public function handle(){
    $this->call('email:send', [
        'user' => 1, '--queue' => 'default'
    ]);
}
```

如果你想要调用其它控制台命令并阻止其所有输出，可以使用`callSilent` 方法。`callSilent` 方法和 `call` 方法用法一致：

```
$this->callSilent('email:send', [
   'user' => 1, '--queue' => 'default'
]);
```