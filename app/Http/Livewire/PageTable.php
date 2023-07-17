<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Page;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class PageTable extends DataTableComponent
{
    protected $model = Page::class;
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
            Column::make('Slug/Url', 'slug')
                ->searchable()->format(function($value, $column, $row) {
                    return "<code class=\"badge bg-label-primary\">/page/$value</code>";
                })->html(),
            Column::make('Kategori', 'getCategory.name')
                ->format(function($value, $column, $row) {
                    return "<span class=\"badge bg-primary\">$value</span>";
                })->html(),
            Column::make("Author", "created_by")
                ->view('admin.pages.view.author'),
            Column::make("Publish", "created_at")
                ->sortable()
                ->view('admin.pages.view.publish-date'),
            Column::make("Status", "status")
                ->view('admin.pages.view.status'),
            Column::make("View", "counter")
                ->format(function($value, $column, $row) {
                    return "<span class=\"text-primary fw-bold\">".number_format($value)."</span>";
                })->html(),
            Column::make('Actions', 'id')
                ->view('admin.pages.view.action'),
        ];
    }

    public function builder(): Builder
    {
        return Page::query()
            ->when($this->columnSearch['title'] ?? null, fn ($query, $title) => $query->where('pages.title', 'like', '%' . $title . '%'))
            ->orderByDesc('created_at');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Page::findOrFail($this->selected_id);
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
            $posts = Page::whereIn('id', $this->selected_id)->delete();

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
        $data = Page::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }


    public function customView(): string
    {
        return 'admin.pages.modal';
    }
}
