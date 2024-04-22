<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\CurrencyImportCommand;
use Illuminate\Support\Facades\DB;

class ImportCurrencyData extends Command
{
    protected $signature = 'currency:import';
    protected $description = 'Import currency exchange rates from ECB';

    public function handle()
    {
        $client = new Client();
        try {
            $response = $client->get('https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist.xml');
            $xmlString = $response->getBody()->getContents();
            $xml = simplexml_load_string($xmlString);

            foreach ($xml->Cube->Cube->Cube as $rate) {
                $currency = (string)$rate['currency'];
                $rateValue = (float)$rate['rate'];

                // Check if currency data already exists
                $existingCurrency = CurrencyImportCommand::where('moneda', $currency)->first();
                if (!$existingCurrency) {
                    CurrencyImportCommand::create([
                        'moneda' => $currency,
                        'rate' => $rateValue,
                        'fecha' => date('Y-m-d'),
                    ]);
                }
            }

            $this->info('Currency data imported successfully!');
        } catch (\Exception $e) {
            $this->error('Error fetching XML: ' . $e->getMessage());
            return;
        }

    }
}

