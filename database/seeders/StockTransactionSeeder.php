<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductVariant;
use App\Models\StockTransaction;
use Carbon\Carbon;

class StockTransactionSeeder extends Seeder
{
    /**
     * Backfill plausible IN/OUT movement history for each variant over the
     * last 90 days. This gives the reports "Stock Trend" chart and the
     * date-range filters real activity to plot/filter instead of being
     * empty for a freshly seeded database.
     */
    public function run(): void
    {
        $variants = ProductVariant::all();

        foreach ($variants as $variant) {
            $currentStock = $variant->stock;
            $movements = rand(4, 9);

            // Work backwards from today so the running total lands on the
            // variant's current stock value.
            $runningStock = $currentStock;
            $entries = [];

            for ($i = 0; $i < $movements; $i++) {
                $daysAgo = ($movements - $i) * rand(8, 13);
                $date = Carbon::now()->subDays($daysAgo)->setTime(rand(8, 18), rand(0, 59));

                // Mostly restocks (IN) with occasional sales/deductions (OUT),
                // keeping everything non-negative.
                if ($i === 0 || rand(1, 100) <= 65) {
                    $qty = rand(5, 40);
                    $entries[] = ['type' => 'IN', 'quantity' => $qty, 'date' => $date];
                    $runningStock -= $qty; // undo, since we're working backwards
                } else {
                    $qty = min(rand(3, 15), max(1, $runningStock));
                    $entries[] = ['type' => 'OUT', 'quantity' => $qty, 'date' => $date];
                    $runningStock += $qty; // undo
                }
            }

            // Ensure history doesn't imply negative starting stock.
            if ($runningStock < 0) {
                $entries[] = [
                    'type' => 'IN',
                    'quantity' => abs($runningStock) + rand(5, 20),
                    'date' => Carbon::now()->subDays(($movements + 1) * 12),
                ];
            }

            foreach ($entries as $entry) {
                StockTransaction::create([
                    'variant_id' => $variant->id,
                    'type' => $entry['type'],
                    'quantity' => $entry['quantity'],
                    'created_at' => $entry['date'],
                    'updated_at' => $entry['date'],
                ]);
            }
        }
    }
}