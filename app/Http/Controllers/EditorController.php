<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditorController extends Controller
{
    public function editor()
    {
        $tags = DB::select('SELECT * from tags');
        return view('editor', ['tags' => $tags]);
    }

    public function create(Request $req)
    {
        // return request()->getSchemeAndHttpHost();
        // return $req;
        if (empty($req->title) || empty($req->content) || empty($req->article_id) || empty($req->tag)) {
            return ['success' => false];
        }
        $title = $req->title;
        $content = $req->content;
        $article_id = $req->article_id;
        $tag = $req->tag;

        DB::table('articles')->insert([
            'title' => $title,
            'content' => $content,
            'article_id' => $article_id,
            'tag' => $tag,
        ]);

        return ['success' => true];
    }

    public function uploadimage(Request $req, $article_id, $date)
    {
        // return [$article_id, $date];
        // $article_id = $req->article_id;
        // $date = $req->date;
        if ($req->hasFile('file')) {
            $image = $req->file('file');
            $file_path = $image->store('public/uploads');
            $filename = $image->hashName();
            DB::table('image_list')->insert([
                'filename' => $filename,
                'article_id' => $article_id,
                'date' => $date,
            ]);

            // return ['location' => "http://webnote.3b8.info/storage/uploads/$filename"];
            return ['location' => request()->getSchemeAndHttpHost() . "/storage/uploads/$filename"];

        }
    }
}
