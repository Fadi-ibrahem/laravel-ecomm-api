<?php

namespace App\Interfaces\Front;

interface UserRepositoryInterface
{
    public function update();

    public function delete();

    public function show();
}
