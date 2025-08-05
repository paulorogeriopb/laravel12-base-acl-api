<?php

namespace App\DTO\Users;

class CreateUserDTO
{
   public function __construct(
    //Usa readonly para garantir imutabilidade
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    )  {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password), // se quiser criptografar aqui
        ];
    }


}
