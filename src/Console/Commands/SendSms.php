<?php

namespace Src\Console\Commands;

use App\Services\EmsikaSmsGateway;
use Illuminate\Console\Command;

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
        (new EmsikaSmsGateway())->run();

        return Command::SUCCESS;
    }
}
