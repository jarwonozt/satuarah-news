<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Office;
use Exception;

class OfficeTable extends DataTableComponent
{
    protected $model = Office::class;
    public $selected_id;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
                ->sortable()
                ->view('admin.offices.view.publish-date'),
            Column::make("Author", "created_by")
                ->view('admin.offices.view.author'),
            Column::make("Status", "status")
                ->view('admin.offices.view.status'),
            Column::make('Actions', 'id')
                ->view('admin.offices.view.action'),
        ];
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Office::findOrFail($this->selected_id);
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
            $row = Office::whereIn('id', $this->selected_id)->delete();

            session()->flash('message', 'Kantor berhasil dihapus.');
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
        $data = Office::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }


    public function customView(): string
    {
        return 'admin.offices.modal';
    }
}
