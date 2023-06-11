<?php

namespace App\Events;

use App\Models\Entidade;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class EntidadeCreated
{
    use Dispatchable, SerializesModels;

    public $entity;

    public function __construct(Entidade $entity)
    {
        $this->entidade = $entity;
    }

    public function handle()
    {
        $token = Str::uuid()->toString(); // Gera um UUID como token único
        $this->entidade->api_token = $token;
        $this->entidade->save();
    }
}

