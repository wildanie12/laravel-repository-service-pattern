<?php

namespace App\Http\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface BookRepositoryInterface {
    public function all(): Collection;


    // Relationship
    public function whereUserIn(array $userId): Collection;
}