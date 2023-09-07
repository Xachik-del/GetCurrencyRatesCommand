<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetCurrencyRates extends Command
{
    protected $signature = 'currency:rates';

    protected $description = 'Get currency exchange rates for the current week';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $startDate = now()->startOfWeek(); // Начало текущей недели
        $endDate = now(); // Сегодняшняя дата
        $currencyRates = [];

        while ($startDate->lte($endDate)) {
            $date = $startDate->format('d/m/Y');
            $xml = file_get_contents("https://www.cbr.ru/scripts/XML_daily.asp?date_req={$date}");
            $data = simplexml_load_string($xml);

            foreach ($data->Valute as $valute) {
                $currencyCode = (string)$valute->CharCode;
                $rate = (float)str_replace(',', '.', (string)$valute->Value);
                $currencyRates[$startDate->format('Y-m-d')][$currencyCode] = $rate;
            }

            $startDate->addDay();
        }

        $this->info("Currency exchange rates for the current week:");
        $this->table(['Date', 'EUR', 'USD', 'KGS'], $this->formatCurrencyRates($currencyRates));
    }

    private function formatCurrencyRates($currencyRates): array
    {
        $formattedRates = [];

        foreach ($currencyRates as $date => $rates) {
            $formattedRates[] = [
                'Date' => $date,
                'EUR' => $rates['EUR'] ?? '-',
                'USD' => $rates['USD'] ?? '-',
                'KGS' => $rates['KGS'] ?? '-',
            ];
        }

        return $formattedRates;
    }
}
