<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // $articles = DB::select('SELECT * from articles
        //                         ORDER BY created_at desc ');

        $articles = DB::table('articles')
            ->select('articles.*', 'tags.id as tag_id', 'tags.tag_name')
            ->leftJoin('tags', 'articles.tag', '=', 'tags.id')
            ->orderBy('articles.created_at', 'desc')->paginate(2);

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
        return view('detail', ['articles' => $articles]);
    }
}
