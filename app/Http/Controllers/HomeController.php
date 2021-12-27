<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        // $articles = DB::select('SELECT * from articles
        //                         ORDER BY created_at desc ');

        $articles = DB::table('articles')
            ->select('articles.*', 'tags.id as tag_id', 'tags.tag_name')
            ->leftJoin('tags', 'articles.tag', '=', 'tags.id')
            ->orderBy('articles.created_at', 'desc')->paginate(10);

        $tags = DB::select('SELECT * from tags ');

        return view('index', ['articles' => $articles, 'tags' => $tags]);

    }

    public function TagView($tag)
    {
        $articles = DB::table('articles')
            ->select('articles.*', 'tags.id as tag_id', 'tags.tag_name')
            ->leftJoin('tags', 'articles.tag', '=', 'tags.id')
            ->where('tag_name', '=', $tag)
            ->orderBy('articles.created_at', 'desc')->paginate(10);

        $tags = DB::select('SELECT * from tags ');

        return view('index', ['articles' => $articles, 'tags' => $tags]);

    }

    public function detail($tag, $article_id)
    {
        $articles = DB::table('articles')
            ->select('articles.*', 'tags.id as tag_id', 'tags.tag_name')
            ->leftJoin('tags', 'articles.tag', '=', 'tags.id')
            ->where('articles.article_id', $article_id)
            ->get();

        if (count($articles) == 0) {
            return redirect()->route('Home');
        }
        return view('detail', ['article' => $articles[0]]);
    }

    public function imagenone()
    {
        //上傳後沒發布的圖片
        $notitle_images = DB::select("SELECT image_list.* from image_list
                            LEFT JOIN articles
                              ON image_list.article_id = articles.article_id
                              LEFT JOIN tags
                              ON articles.tag = tags.id
                            WHERE image_list.article_id
                            NOT IN(SELECT article_id FROM articles)");

        //更新傳圖未上傳 || 上傳後刪除 (文章內無顯示的圖)
        $hastitle_images = DB::select("SELECT image_list.*,articles.title,articles.created_at,articles.tag ,tags.* FROM image_list
                              LEFT JOIN articles
                              ON image_list.article_id = articles.article_id
                              LEFT JOIN tags
                              ON articles.tag = tags.id
                              WHERE articles.content NOT LIKE CONCAT('%', image_list.filename, '%')");

        return view('imagenone', ['notitle_images' => $notitle_images, 'hastitle_images' => $hastitle_images]);
    }

    public function deletenotuse(Request $req)
    {
        if (!isset($req->type)) {
            return redirect()->route('ImageNone');
        }

        if ($req->type == 1) {
            $notitle_images = DB::select("SELECT image_list.* from image_list
                            LEFT JOIN articles
                              ON image_list.article_id = articles.article_id
                              LEFT JOIN tags
                              ON articles.tag = tags.id
                            WHERE image_list.article_id
                            NOT IN(SELECT article_id FROM articles)");
            foreach ($notitle_images as $image) {
                Storage::delete('/public/uploads/' . $image->filename);
                DB::table('image_list')
                    ->where('article_id', $image->article_id)
                    ->delete();
            }
            return redirect()->route('ImageNone');

        } else {
            $hastitle_images = DB::select("SELECT image_list.*,articles.title,articles.created_at,articles.tag ,tags.* FROM image_list
                              LEFT JOIN articles
                              ON image_list.article_id = articles.article_id
                              LEFT JOIN tags
                              ON articles.tag = tags.id
                              WHERE articles.content NOT LIKE CONCAT('%', image_list.filename, '%')");
            foreach ($hastitle_images as $image) {
                Storage::delete('/public/uploads/' . $image->filename);
                DB::table('image_list')
                    ->where('article_id', $image->article_id)
                    ->delete();
            }
            return redirect()->route('ImageNone');

        }
    }

    public function search($keyword)
    {
        $articles = DB::table('articles')
            ->select('articles.*', 'tags.id as tag_id', 'tags.tag_name')
            ->leftJoin('tags', 'articles.tag', '=', 'tags.id')
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orderBy('articles.created_at', 'desc')
            ->paginate(10);

        $tags = DB::select('SELECT * from tags ');

        return view('index', ['articles' => $articles, 'tags' => $tags]);

    }
}
