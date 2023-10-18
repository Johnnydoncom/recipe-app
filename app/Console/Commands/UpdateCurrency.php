<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'accept' => 'application/json',
            "Content-Type: application/json",
            "apikey" => env('APILAYER_EXCHANGE_API')
        ])->retry(3, 100, throw: false)->get('https://api.apilayer.com/currency_data/convert', [
            'to' => 'USD',
            'from' => env('DEFAULT_CURRENCY'),
            'amount' => 1
        ]);

        if($response->successful()) {
            $data = $response->object();

            currency()->update('USD', [
                'exchange_rate' => $data->result
            ]);
        }
    }
}
