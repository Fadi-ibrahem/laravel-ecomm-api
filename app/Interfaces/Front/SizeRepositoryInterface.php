<?php

namespace App\Interfaces\Front;

use App\Models\Size;

interface SizeRepositoryInterface
{
    public function index();

    public function create(Array $data);

    public function update(Size $size, Array $data);

    public function delete(Size $size);

    public function show(Size $size);
}
