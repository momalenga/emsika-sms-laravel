<?php

namespace Shengamo\LaravelEmsikaSms\Commands;

use Illuminate\Console\Command;
use Shengamo\LaravelEmsikaSms\LaravelEmsikaSms;

class SendSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send smses that were through the sms gateway.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        (new LaravelEmsikaSms())->run();

        return Command::SUCCESS;
    }
}
