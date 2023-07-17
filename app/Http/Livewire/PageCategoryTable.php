<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PageCategory;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PageCategoryTable extends DataTableComponent
{
    protected $model = PageCategory::class;
    public $selected_id, $name, $description;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->isHidden(),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make("Publish", "updated_at")
                ->sortable(),
            Column::make("Status", "status")
                ->view('admin.pages.categories.view.status'),
            Column::make('Actions', 'id')
                ->view('admin.pages.categories.view.action'),
        ];
    }

    public function builder(): Builder
    {
        return PageCategory::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('page_categories.name', 'like', '%' . $name . '%'))
            ->orderByDesc('updated_at');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = PageCategory::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 0]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function editModal($id)
    {
        $this->selected_id = $id;
        $data = PageCategory::findOrFail($id);
        $this->name = $data->name;
        $this->description = $data->description;
        // $this->parent_id = $data->parent_id;

        $this->dispatchBrowserEvent('openModalEdit');
    }

    public function update()
    {
        $save = PageCategory::findOrFail($this->selected_id);
        $save->name = $this->name;
        $save->slug = Str::slug($this->name);
        $save->description = $this->description;
        // $save->parent_id = $this->parent_id;
        $save->updated_by = auth()->user()->id;
        $save->save();
        return redirect()->route('pagecategories.index')->with('message', "Kategori $save->name berhasil diupdate.");
        $this->dispatchBrowserEvent('closeModalEdit');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        $data = PageCategory::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function customView(): string
    {
        return 'admin.pages.categories.modal';
    }
}
