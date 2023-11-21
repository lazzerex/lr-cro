<?php

namespace App\Imports;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class PostsImport implements WithHeadingRow, OnEachRow
{
    public function onRow(Row $row)
    {
        $row = $row->toArray();

        $title = $row['title'];
        $content = $row['content'];
        $excerpt = $row['excerpt'];
        $date = Carbon::createFromFormat('m/d/Y', $row['date']);
        $imageFeatured = $row['image_featured'];
        $categories = $row['chuyen_muc'];
        $tags = $row['the'];
        $status = $row['status'];
        $slug = $row['slug'];

        if ($status != 'publish') {
            return null;
        }

        $author_id = User::where('username', 'admin')->first()->id;

        $wpContentUrl = 'http://localhost/wp-gpclinic/wp-content/';
        $image = Str::replace($wpContentUrl, '/storage/', $imageFeatured);

        $post = Post::create([
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $excerpt,
            'content' => $content,
            'status' => 'publish',
            'created_at' => $date,
            'updated_at' => $date,
            'published_at' => $date,
            'created_by' => $author_id,
            'updated_by' => $author_id,
            'published_by' => $author_id,
            'image' => $image,
        ]);

        if ($post) {
            $catIds = $this->parseCategories($categories);
            $post->categories()->sync($catIds);

            $tagIds = $this->parseTags($tags);
            $post->tags()->sync($tagIds);
        }
    }

    private function parseCategories($categories)
    {
        $names = explode('|', $categories);
        $catIds = Arr::map($names, function ($item) {
            // match lấy id theo hệ thống cần import vào
            return match($item) {
                'Công nghệ' => 5,
                'Marketing' => 2,
                'Quản lý' => 1,
                'SEO' => 4,
            };
        });

        return $catIds;
    }

    private function parseTags($tags)
    {
        $names = explode('|', $tags);
        $tagIds = Arr::map($names, function ($item) {

            $tag = PostTag::create([
                'name' => $item,
            ]);

            return $tag->id;
        });

        return $tagIds;
    }
}
