<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PostCategory;
use Illuminate\Support\Str;

class PostCategoryTable extends DataTableComponent
{
    protected $model = PostCategory::class;
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
                ->view('admin.posts.categories.view.status'),
            Column::make('Actions', 'id')
                ->view('admin.posts.categories.view.action'),
        ];
    }

    public function builder(): Builder
    {
        return PostCategory::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('posts.name', 'like', '%' . $name . '%'))
            ->orderByDesc('updated_at');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = PostCategory::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 0]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function editModal($id)
    {
        $this->selected_id = $id;
        $data = PostCategory::findOrFail($id);
        $this->name = $data->name;
        $this->description = $data->description;
        // $this->parent_id = $data->parent_id;
        $this->dispatchBrowserEvent('openModalEdit');
    }

    public function update()
    {
        $save = PostCategory::findOrFail($this->selected_id);
        $save->name = $this->name;
        $save->slug = Str::slug($this->name);
        $save->description = $this->description;
        // $save->parent_id = $this->parent_id;
        $save->updated_by = auth()->user()->id;
        $save->save();
        return redirect()->route('postcategories.index')->with('message', "Kategori $save->name berhasil diupdate.");
        $this->dispatchBrowserEvent('closeModalEdit');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        $data = PostCategory::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function customView(): string
    {
        return 'admin.posts.categories.modal';
    }
}
