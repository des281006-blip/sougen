<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab') === 'selesai' ? 'selesai' : 'mendatang';
        $jenis = in_array($request->query('jenis'), ['gratis', 'berbayar'], true)
            ? $request->query('jenis')
            : null;

        $query = $tab === 'selesai' ? Event::finished() : Event::upcoming();

        if ($jenis === 'gratis') {
            $query->where('is_free', true);
        } elseif ($jenis === 'berbayar') {
            $query->where('is_free', false);
        }

        $events = $query->with('ticketTypes')->paginate(9)->withQueryString();

        return view('web.events.index', compact('events', 'tab', 'jenis'));
    }

    public function show(Event $event)
    {
        $event->load('ticketTypes');

        return view('web.events.show', compact('event'));
    }
}