<?php

namespace App\Interfaces\Front;

use App\Models\Color;

interface ColorRepositoryInterface
{
    public function index();

    public function create(Array $data);

    public function update(Color $color, Array $data);

    public function delete(Color $color);

    public function show(Color $color);
}
