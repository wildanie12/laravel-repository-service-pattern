<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Support\Collection;

class EloquentBookRepository implements BookRepositoryInterface {


    public function all(): Collection
    {
        return Book::all();
    }

    public function whereUserIn(array $userId): Collection
    {
        return Book::whereIn('user_id', $userId)->get();
    }

}