<?php

namespace App\Repositories;

use App\DTO\Users\CreateUserDTO;
use App\DTO\Users\EditUserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;



class UserRepository
{
    public function __construct( protected User $user )
    {

    }

    public function getPaginate(int $totalPerPage = 15, int $page = 1, string $filter = ''):  LengthAwarePaginator
    {
        return $this->user->where(function ($query) use ($filter) {
            if ($filter !== '') {
                $query->where('name', 'LIKE', "%{$filter}%")
                      ->orWhere('email', 'LIKE', "%{$filter}%");
            }
        })->paginate($totalPerPage,['*'],'page',$page);
    }



    public function createNew(CreateUserDTO $dto): User
    {
         return $this->user->create($dto->toArray());
    }



    public function findById(string $id): ?User
    {
        return $this->user->find($id);
    }



    public function update(EditUserDTO $dto): ?bool
    {

        if (!$user = $this->findById($dto->id)) {
            return false;
        }

        $data = (array) $dto;
        if ($dto->password !== null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        // Atualiza o usuário com os dados do DTO
        return $user->update($data);
    }



    function delete(string $id): ?bool
    {
        if (!$user = $this->findById($id)) {
            return false;
        }
        return $user->delete();
    }

}
