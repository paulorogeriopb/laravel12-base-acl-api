<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;  // <--- importante!
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Audit;
use Illuminate\Support\Facades\Http;

class ResolveAuditGeo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Audit $audit;

    public function __construct(Audit $audit)
    {
        $this->audit = $audit;
    }

   public function handle(): void
    {
        $ip = $this->audit->ip_address;

        if (! $ip) {
            return;
        }

        // Ignorar IPs privados e no ambiente local forçar IP público para teste
        if (preg_match('/^(10\.|172\.(1[6-9]|2\d|3[0-1])|192\.168\.)/', $ip)) {
            if (app()->environment('local')) {
                $ip = '8.8.8.8'; // IP público fixo para testes
            } else {
                // IP privado em produção: não tenta geolocalizar
                $this->audit->geo = json_encode(['note' => 'IP privado ignorado']);
                $this->audit->save();
                return;
            }
        }

        $response = Http::timeout(5)->get("http://ip-api.com/json/{$ip}?fields=status,country,regionName,city,isp,org,query");

        if ($response->successful() && $response->json('status') === 'success') {
            $this->audit->geo = json_encode($response->json());
            $this->audit->save();
        }
    }

}