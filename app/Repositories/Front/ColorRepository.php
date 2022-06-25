<?php

namespace App\Repositories\Front;

use App\Models\Color;
use Illuminate\Pipeline\Pipeline;
use App\Filters\Color\ColorValueFilter;
use App\Interfaces\Front\ColorRepositoryInterface;

class ColorRepository implements ColorRepositoryInterface
{
    public function index()
    {
        $colors = app(Pipeline::class)
            ->send(Color::query())
            ->through([
                ColorValueFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $colors;
    }

    public function create(Array $data)
    {
        Color::create($data);
    }

    public function update(Color $color, Array $data)
    {
        $color->update($data);
    }

    public function delete(Color $color)
    {
        $color->delete();
    }

    public function show(Color $color)
    {
        return $color;
    }

}
