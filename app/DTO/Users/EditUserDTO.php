<?php

namespace App\DTO\Users;

class EditUserDTO
{
   public function __construct(
    //Usa readonly para garantir imutabilidade
        public readonly string $id,
        public readonly string $name,
        public readonly ?string $password = null, // Pode ser nulo se não for atualizado
    )  {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'password' => bcrypt($this->password), // se quiser criptografar aqui
        ];
    }


}
