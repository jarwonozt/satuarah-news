<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Post;
use App\Models\PostCategory;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

class PostTable extends DataTableComponent
{
    protected $model = Post::class;
    public $selected_id;
    public $title, $content, $image;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFiltersEnabled();
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
            Column::make("Publish", "published_at")
                ->sortable()
                ->view('admin.posts.view.publish-date'),
            Column::make("Author", "created_by")
                ->view('admin.posts.view.author'),
            Column::make("Status", "status")
                ->view('admin.posts.view.status'),
            Column::make("View", "counter")
                ->format(function($value, $column, $row) {
                    return "<span class=\"text-primary fw-bold\">".number_format($value)."</span>";
                })->html(),
            Column::make("Link Age", "counter")
                ->view('admin.posts.view.linkage'),
            Column::make('Actions', 'id')
                ->view('admin.posts.view.action'),
        ];
    }

    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Category')
                ->options(
                    PostCategory::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn($cat) => $cat->name)
                        ->toArray()
                )
                ->filter(function (Builder $builder, array $values) {
                    $builder->whereIn('category_id', $values);
            }),
        ];
    }

    public function builder(): Builder
    {
        return Post::query()
            ->when($this->columnSearch['title'] ?? null, fn ($query, $title) => $query->where('posts.title', 'like', '%' . $title . '%'))
            ->orderByDesc('published_at');
    }

    public array $bulkActions = [
        'confirmDeleteSelected' => 'Delete'
    ];

    public function showModalDetail($id)
    {
        $this->selected_id = $id;
        $data = Post::findOrFail($id);
        $this->title = $data->title;
        $this->content = $data->content;
        $this->image = $data->images['full'];
        $this->dispatchBrowserEvent('openModalDetail');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Post::findOrFail($this->selected_id);
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
            $posts = Post::whereIn('id', $this->selected_id)->delete();

            session()->flash('message', 'Berita berhasil dihapus.');
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
        $data = Post::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function customView(): string
    {
        return 'admin.posts.modal';
    }
}
