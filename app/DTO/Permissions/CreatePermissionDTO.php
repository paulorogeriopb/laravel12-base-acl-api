<?php

namespace App\DTO\Permissions;

class CreatePermissionDTO
{
   public function __construct(
    //Usa readonly para garantir imutabilidade
        public readonly string $name,
        public readonly string $description = '', // Pode ser nulo se não for atualizado
    )  {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }


}
