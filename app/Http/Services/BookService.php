<?php

namespace App\Http\Services;

use App\Http\Repositories\Interfaces\BookRepositoryInterface;

class BookService {

    public $repository;
    public function __construct(BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function substituteUser($users)
    {
        return $this->repository->whereUserIn($users);
    }



}