<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Photo;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class PhotoTable extends DataTableComponent
{
    protected $model = Photo::class;
    public $selected_id;

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
            Column::make("Title", "title")
                ->sortable(),
            Column::make("Publish", "created_at")
                ->sortable()
                ->view('admin.photos.view.publish-date'),
            Column::make("Photos", "id")
                    ->view('admin.photos.view.photo'),
            Column::make("Author", "created_by")
                ->view('admin.photos.view.author'),
            Column::make("Status", "status")
                ->view('admin.photos.view.status'),
            Column::make('Actions', 'id')
                ->view('admin.photos.view.action'),
        ];
    }

    public function builder(): Builder
    {
        return Photo::query()
            ->when($this->columnSearch['title'] ?? null, fn ($query, $title) => $query->where('photos.title', 'like', '%' . $title . '%'))->orderBy('created_at', 'desc');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Photo::findOrFail($this->selected_id);
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
            $row = Photo::whereIn('id', $this->selected_id)->delete();

            session()->flash('message', 'Photo berhasil dihapus.');
            $this->dispatchBrowserEvent('closeModalDeleteSelected');

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
        $data = Photo::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }


    public function customView(): string
    {
        return 'admin.photos.modal';
    }
}
