<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PostLinkage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PostLinkageTable extends DataTableComponent
{
    protected $model = Post::class;
    public int $parent_id;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
        ];
    }

    public array $bulkActions = [
        'addSelected' => 'Tambahkan',
    ];

    public function addSelected()
    {
        if (count($this->getSelected())) {
            $rows = Post::whereIn('id', $this->getSelected())->pluck('id');

            foreach ($rows as $k=>$v) {
               $save[$k] = new PostLinkage();
               $save[$k]->parent_id = $this->parent_id;
               $save[$k]->child_id = $v;
               $save[$k]->save();
            }

            $code = Post::where('id', $this->parent_id)->first()->code;

            Cache::flush("post-$code");
            return redirect()->route('postlinkages.show', $this->parent_id)->with('message', 'Data Berhasil ditambahkan!');
        }
    }

    public function builder(): Builder
    {
        $already = PostLinkage::pluck('child_id');
        $posts = Post::query()
                // ->where('status', '!=', 0)
                ->whereNot('id', $this->parent_id)
                ->whereNotIn('id', $already)
                ->when($this->columnSearch['title'] ?? null, fn ($query, $title) => $query->where('posts.title', 'like', '%' . $title . '%'));
        // dd($posts);
        return $posts;
    }
}
