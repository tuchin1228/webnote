<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EditorController extends Controller
{
    //新增文章頁面
    public function editor()
    {
        $tags = DB::select('SELECT * from tags');
        return view('editor', ['tags' => $tags]);
    }

    //新增文章
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
            'created_at' => date('Y-m-d h:i:s', time()),
        ]);

        return ['success' => true];
    }

    //上傳圖片
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

    //文章更新頁面
    public function edit($tag, $article_id)
    {
        $article = DB::table('articles')
            ->select('articles.*', 'tags.id as tag_id', 'tags.tag_name')
            ->leftJoin('tags', 'articles.tag', '=', 'tags.id')
            ->where('articles.article_id', $article_id)
            ->get();

        if (count($article) == 0) {
            return redirect()->route('Home');
        }

        $tags = DB::select('SELECT * from tags ');

        return view('edit', ['article' => $article[0], 'tags' => $tags]);

    }

    //更新文章
    public function update(Request $req)
    {
        if (empty($req->article_id)) {
            return ['success' => false, 'msg' => '參數錯誤'];
        }
        DB::table('articles')
            ->where('article_id', $req->article_id)
            ->update([
                'title' => $req->title,
                'tag' => $req->tag,
                'content' => $req->content,
            ]);
        return ['success' => true, 'msg' => '更新成功'];

    }

    //刪除文章
    public function delete(Request $req)
    {
        if (empty($req->article_id)) {
            return ['success' => false, 'msg' => '參數錯誤'];
        }

        $images = DB::table('image_list')
            ->where('article_id', $req->article_id)
            ->get();
        foreach ($images as $image) {
            Storage::delete('/public/uploads/' . $image->filename);
        }
        DB::table('image_list')
            ->where('article_id', $req->article_id)
            ->delete();

        DB::table('articles')
            ->where('article_id', $req->article_id)
            ->delete();

        return ['success' => true, 'msg' => '刪除成功'];

    }
}
