<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PhotoLinkage;
use Illuminate\Database\Eloquent\Builder;

class PhotoLinkageTable extends DataTableComponent
{
    protected $model = PhotoLinkage::class;
    public $photo_id, $selected_id;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->isHidden(),
            Column::make("Photo", "image")
                ->view('admin.photos.linkages.view.thumbnail'),
            Column::make("Caption", "caption")
                ->sortable()
                ->searchable(),
            Column::make('Actions', 'id')
            ->view('admin.photos.linkages.view.action'),
        ];
    }

    public function builder(): Builder
    {
        return PhotoLinkage::query()
            ->where('photo_id', $this->photo_id)->orderBy('created_at', 'desc');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        $data = PhotoLinkage::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }


    public function customView(): string
    {
        return 'admin.photos.linkages.modal';
    }
}
