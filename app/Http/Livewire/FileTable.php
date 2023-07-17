<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\File;
use App\Models\Page;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class FileTable extends DataTableComponent
{
    protected $model = File::class;
    public $selected_id;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSortingEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->isHidden(),
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),
            Column::make('Kategori', 'getCategory.name')
                ->format(function($value, $column, $row) {
                    return "<span class=\"badge bg-primary\">$value</span>";
                })->html(),
            Column::make("Publish", "created_at")
                ->view('admin.files.view.publish-date'),
            Column::make("Author", "created_by")
                ->view('admin.files.view.author'),
            Column::make("Status", "status")
                ->view('admin.files.view.status'),
            Column::make('Actions', 'id')
                ->view('admin.files.view.action'),
        ];
    }

    public function builder(): Builder
    {
        return File::query()
            ->when($this->columnSearch['title'] ?? null, fn ($query, $title) => $query->where('files.title', 'like', '%' . $title . '%'))
            ->orderByDesc('created_at');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = File::findOrFail($this->selected_id);
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
            $posts = File::whereIn('id', $this->selected_id)->delete();

            session()->flash('message', 'Page berhasil dihapus.');
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
        $data = File::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }


    public function customView(): string
    {
        return 'admin.files.modal';
    }
}
