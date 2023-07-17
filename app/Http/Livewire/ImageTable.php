<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Image;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class ImageTable extends DataTableComponent
{
    protected $model = Image::class;
    public $selected_id, $title, $image, $description;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->isHidden(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make('Slug/Url', 'slug')
                ->format(function($value, $column, $row) {
                    return "<span class=\"badge bg-label-success\">$value</span>";
                })->html(),
            Column::make('Kategori', 'getCategory.name')
                ->format(function($value, $column, $row) {
                    return "<span class=\"badge bg-primary\">$value</span>";
                })->html(),
            Column::make("Publish", "created_at")
                ->sortable()
                ->view('admin.images.view.publish-date'),
            Column::make("Author", "created_by")
                ->view('admin.images.view.author'),
            Column::make("Status", "status")
                ->view('admin.images.view.status'),
            Column::make("View", "counter")
                ->format(function($value, $column, $row) {
                    return "<span class=\"text-primary\">$value</span>";
                })->html(),
            Column::make('Actions', 'id')
                ->view('admin.images.view.action'),
        ];
    }
    public function builder(): Builder
    {
        return Image::query()
            ->when($this->columnSearch['title'] ?? null, fn ($query, $title) => $query->where('images.title', 'like', '%' . $title . '%'))->orderBy('created_at', 'desc');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Image::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 0]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function confirmDeleteSelected()
    {
        $this->selected_id = $this->getSelected();
        $this->dispatchBrowserEvent('openModalDeleteSelected');
    }

    public function deleteSelected()
    {
        try {
            $row = Image::whereIn('id', $this->selected_id)->delete();

            session()->flash('message', 'Image berhasil dihapus.');
            $this->dispatchBrowserEvent('closeMostorage  dalDeleteSelected');

        } catch (Exception $e) {
            session()->flash('message', $e->getMessage());
            $this->dispatchBrowserEvent('closeModalDeleteSelected');
        }

    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        $data = Image::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }


    public function customView(): string
    {
        return 'admin.images.modal';
    }


    public function showModalDetail($id)
    {
        $this->selected_id  = $id;
        $data               = Image::findOrFail($id);
        $this->title        = $data->title;
        $this->image        = $data->imagePath;
        $this->description  = $data->description;
        $this->dispatchBrowserEvent('openModalDetail');
    }
}
