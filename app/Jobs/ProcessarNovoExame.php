<?php

namespace App\Jobs;

use App\Mail\NovoExame;
use App\Models\Afericao;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessarNovoExame implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Afericao $afericao
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->afericao->usuario)
                    ->later(now()->addMinute(), new NovoExame($this->afericao));
        } catch (\Exception $e) {
            Log::warning('E-mail do exame não enviado.', ['id' => $this->afericao->id, 'error' => $e->getMessage()]);
        }
    }
}
