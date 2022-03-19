<?php

namespace App\Http\Services;

use App\Http\Repositories\Interfaces\BookRepositoryInterface;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;

class UserService {

    protected $repository;
    protected $bookRepository;

    public function __construct(UserRepositoryInterface $repository, BookRepositoryInterface $bookRepository)
    {
        $this->repository = $repository;
        $this->bookRepository = $bookRepository;
    }

    public function findAll()
    {
        $dataUser = $this->repository->all();
        $userIds  = $dataUser->pluck('id')->toArray();
        $dataBook = $this->bookRepository->whereUserIn($userIds);
        
        // complexity O(3n) vs O((n^2)^m)  ^.^
        $result = $dataBook->mapToGroups(function($item, $key) {
            return [$item['user_id'] => $item];
        });
        $dataUser->map(function($item, $index) use ($result) {
            if (isset($result[$item['id']])) {
                $item['books'] = $result[$item['id']];
            }
            return $item;
        });
        return $dataUser;
    }

}