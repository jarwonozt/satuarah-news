<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PostLinkage;
use Exception;

class LinkageTable extends DataTableComponent
{
    protected $model = PostLinkage::class;
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
            Column::make("Title", "getPost.title")
                ->sortable()
                ->searchable(),
            Column::make("Category", "getPost.getCategory.name")
                ->sortable(),
            Column::make('Actions', 'id')
                ->view('admin.posts.linkages.view.action'),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'confirmDeleteSelected' => 'Delete'
        ];
    }

    public function confirmDeleteSelected()
    {
        $this->selected_id = $this->getSelected();
        $this->dispatchBrowserEvent('openModalDeleteSelected');
    }

    public function deleteSelected()
    {
        try {
            $posts = PostLinkage::whereIn('id', $this->selected_id)->delete();

            session()->flash('message', 'Linkage berhasil dihapus.');
            $this->dispatchBrowserEvent('closeModalDeleteSelected');

        } catch (Exception $e) {
            session()->flash('message', $e->getMessage());
            $this->dispatchBrowserEvent('closeModalDeleteSelected');
        }

    }

    public function customView(): string
    {
        return 'admin.posts.linkages.modal';
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        $data = PostLinkage::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }
}
