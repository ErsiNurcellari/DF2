<?php
namespace App\Services;

use App\Notifications\User\UserCreated;
use App\Repositories\UserRepository;

class UserService
{
    private $auth;

    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        $user = $this->userRepository->create($data);

        //$user->notify(new UserCreated($user));
        
        return $user;
    }
    
    
    public function find($id) 
    {
        return $this->userRepository->find($id);
    }
    
    public function update($data, $id)
    {
        return $this->userRepository->update($data, $id);
    }
    
    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}