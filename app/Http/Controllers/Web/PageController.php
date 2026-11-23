<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\News;

class PageController extends Controller
{
    public function home()
    {
        return view('web.home', [
            'upcoming'  => Event::upcoming()->with('ticketTypes')->take(3)->get(),
            'finished'  => Event::finished()->with('ticketTypes')->take(3)->get(),
            'news'      => $this->publishedNews()->take(3)->get(),
            'galleries' => Gallery::latest()->take(6)->get(),
        ]);
    }

    public function about()    { return view('web.about'); }
    public function services() { return view('web.services'); }
    public function contact()  { return view('web.contact'); }

    public function gallery()
    {
        return view('web.gallery', ['galleries' => Gallery::latest()->paginate(12)]);
    }

    public function newsIndex()
    {
        return view('web.news-index', ['items' => $this->publishedNews()->paginate(9)]);
    }

    public function newsShow(News $news)
    {
        abort_if(! $news->published_at || $news->published_at->isFuture(), 404);

        return view('web.news-show', ['news' => $news]);
    }

    private function publishedNews()
    {
        return News::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at');
    }
}