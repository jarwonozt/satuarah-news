<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Service;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class ServiceTable extends DataTableComponent
{
    protected $model = Service::class;
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
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),
            Column::make('Kategori', 'getCategory.name')
                ->format(function($value, $column, $row) {
                    return "<span class=\"badge bg-primary\">$value</span>";
                })->html(),
            Column::make("Publish", "created_at")
                ->sortable()
                ->view('admin.services.view.publish-date'),
            Column::make("Author", "created_by")
                ->view('admin.services.view.author'),
            Column::make("Status", "status")
                ->view('admin.services.view.status'),
            Column::make('Actions', 'id')
                ->view('admin.services.view.action'),
        ];
    }

    public function builder(): Builder
    {
        return Service::query()
            ->when($this->columnSearch['title'] ?? null, fn ($query, $title) => $query->where('services.title', 'like', '%' . $title . '%'))->orderBy('created_at', 'desc');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Service::findOrFail($this->selected_id);
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
            $row = Service::whereIn('id', $this->selected_id)->delete();

            session()->flash('message', 'Layanan berhasil dihapus.');
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
        $data = Service::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }


    public function customView(): string
    {
        return 'admin.services.modal';
    }
}
