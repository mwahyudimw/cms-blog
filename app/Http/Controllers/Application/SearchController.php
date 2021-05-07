<?php

namespace App\Http\Controllers\Application;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('app.articles', [
            'title' => "Search Article",
            'description' => "Searching Articles",
            'articles' => Article::published()->where('title', 'LIKE', '%'.$request->search.'%')->paginate(5)
        ]);
    }
}
