<?php

namespace App\Console\Commands\Traits;

use Illuminate\Support\Facades\Log;

trait HasMultipleChannelLogMethod
{
    /**
     * Logs an error to the application log and output to the console.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    protected function logError(string $message, array $context = []): void
    {
        Log::error($message, $context);
        $this->error($message);
        $this->error(print_r($message, true));
    }
}
