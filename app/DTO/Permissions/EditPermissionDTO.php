<?php

namespace App\DTO\Permissions;

class EditPermissionDTO
{
   public function __construct(
    //Usa readonly para garantir imutabilidade
        public readonly string $id,
        public readonly string $name,
        public readonly string $description = '', // Pode ser nulo se não for atualizado
    )  {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }


}
