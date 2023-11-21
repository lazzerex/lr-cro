<?php

namespace App\Http\Controllers;

use App\Imports\PostsImport;
use App\Models\Enums\PostStatus;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportWordPressController extends Controller
{
    public function __invoke()
    {
        Excel::import(new PostsImport, storage_path('/temp/giaiphapclinic.csv'));

        return redirect('/')->with('success', 'All good!');
    }

    private function importFromWPExportFile()
    {
        $xml = simplexml_load_file(storage_path('temp/wp.xml'));
        $author = User::where('username', 'admin')->first()->id;

		foreach ($xml->channel->item as $item) {
			$namespaces = $item->getNameSpaces(true);
			$xml_content = $item->children($namespaces['content']);
			$excerpt = $item->children($namespaces['excerpt']);
            $wp = $item->children($namespaces['wp']);
			//var_dump($item);
			$post = new Post();
			$post->title = (string) $item->title;
            $post->excerpt = (string) $excerpt->encoded;
            $post->slug = (string) $wp->post_name;
			$post->created_at = date("Y-m-d H:i:s", strtotime($item->pubDate));
			$post->updated_at = date("Y-m-d H:i:s", strtotime($item->pubDate));
			$post->published_at = date("Y-m-d H:i:s", strtotime($item->pubDate));
            $post->created_by = $author;
            $post->updated_by = $author;
            $post->published_by = $author;
			$post->content = (string) $xml_content->encoded;
            $post->status = PostStatus::Publish;
			//dd($post);
			$post->save();
		}

        return 'done';
    }
}
