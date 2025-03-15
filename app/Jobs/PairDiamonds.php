<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\WelcomeController;

class PairDiamonds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $chunkCount = \Cache::get('api_data_chunk_count', 0);
        $mergedApiData = [];

        for ($index = 0; $index < $chunkCount; $index++) {
            $data = \Cache::get("api_data_chunk_{$index}");
            if ($data) {
                $mergedApiData = array_merge($mergedApiData, $data);
            }
        }

        $makePairResponse = \App\Http\Controllers\WelcomeController::postPairingDiamonds($mergedApiData);

        if ($makePairResponse['flag'] == 1) {
            $pairedDataChunks = array_chunk($makePairResponse['data'], 1000);
            foreach ($pairedDataChunks as $index => $chunk) {
                \Cache::put("api_data_pair_chunk_{$index}", $chunk);
            }
            \Cache::put('api_data_pair_chunk_count', count($pairedDataChunks));
            \Log::info('Pair cached successfully');
        } else {
            \Log::info("Store API Error");
        }
    }
}
