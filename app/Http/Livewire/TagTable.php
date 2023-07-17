<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class TagTable extends DataTableComponent
{
    protected $model = Tag::class;
    public $selected_id, $title, $description;

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
            Column::make("Publish", "created_at")
                ->sortable(),
            Column::make("Status", "status")
                ->view('admin.tags.view.status'),
            Column::make('Actions', 'id')
                ->view('admin.tags.view.action'),
        ];
    }

    public function builder(): Builder
    {
        return Tag::query()
            ->when($this->columnSearch['title'] ?? null, fn ($query, $title) => $query->where('tags.title', 'like', '%' . $title . '%'))
            ->orderByDesc('updated_at');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Tag::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 0]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function editModal($id)
    {
        $this->selected_id = $id;
        $data = Tag::findOrFail($id);
        $this->title = $data->title;
        $this->dispatchBrowserEvent('openModalEdit');
    }

    public function update()
    {
        $save = Tag::findOrFail($this->selected_id);
        $save->title = $this->title;
        $save->slug = Str::slug($this->title);
        $save->created_by = auth()->user()->id;
        $save->save();
        return redirect()->route('tags.index')->with('message', "Tag $save->name berhasil diupdate.");
        $this->dispatchBrowserEvent('closeModalEdit');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        $data = Tag::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function customView(): string
    {
        return 'admin.tags.modal';
    }
}
