<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Video;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class VideoTable extends DataTableComponent
{
    protected $model = Video::class;
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
                ->searchable()
                ->sortable(),
            Column::make("Publish", "created_at")
                ->sortable()
                ->view('admin.videos.view.publish-date'),
            Column::make("Category", "getCategory.name")
                ->format(function($value, $column, $row) {
                        return "<span class=\"badge bg-primary\">$value</span>";
                    })->html(),
            Column::make("Author", "created_by")
                ->view('admin.videos.view.author'),
            Column::make("Status", "status")
                ->view('admin.videos.view.status'),
            Column::make('Actions', 'id')
                ->view('admin.videos.view.action'),
        ];
    }

    public function builder(): Builder
    {
        return Video::query()
            ->when($this->columnSearch['title'] ?? null, fn ($query, $title) => $query->where('videos.title', 'like', '%' . $title . '%'))->orderBy('created_at', 'desc');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Video::findOrFail($this->selected_id);
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
            $row = Video::whereIn('id', $this->selected_id)->delete();

            session()->flash('message', 'Video berhasil dihapus.');
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
        $data = Video::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }


    public function customView(): string
    {
        return 'admin.videos.modal';
    }
}
