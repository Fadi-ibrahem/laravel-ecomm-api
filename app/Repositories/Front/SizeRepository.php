<?php

namespace App\Repositories\Front;

use App\Filters\Size\SizeDegreeFilter;
use Illuminate\Pipeline\Pipeline;
use App\Interfaces\Front\SizeRepositoryInterface;
use App\Models\Size;

class SizeRepository implements SizeRepositoryInterface
{
    public function index()
    {
        $sizes = app(Pipeline::class)
            ->send(Size::query())
            ->through([
                SizeDegreeFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $sizes;
    }

    public function create(Array $data)
    {
        Size::create($data);
    }

    public function update(Size $size, Array $data)
    {
        $size->update($data);
    }

    public function delete(Size $size)
    {
        $size->delete();
    }

    public function show(Size $size)
    {
        return $size;
    }

}
