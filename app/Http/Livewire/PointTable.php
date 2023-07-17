<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Point;

class PointTable extends DataTableComponent
{
    protected $model = Point::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->isHidden(),
            Column::make("Name", "getUser.name"),
            Column::make("Post", "id")
                ->sortable(),
            Column::make("Viewed", "id")
                ->sortable(),
            Column::make("Point", "id")
                ->sortable(),
            Column::make('Actions', 'id')
                ->view('admin.pages.categories.view.action'),
        ];
    }
}
