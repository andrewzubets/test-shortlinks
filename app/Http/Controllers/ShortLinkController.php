<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortLinkRequest;
use Illuminate\Contracts\View\View;

class ShortLinkController extends Controller
{

    public function index(): View {
        return view('shortlink.index', ['urlInput' => '']);
    }

    public function create(ShortLinkRequest $shortLinkRequest): View {
        $urlInput = $shortLinkRequest->get('url_input');
        $urlShortLink = 'Todo generate: ' . $urlInput;
        return view('shortlink.index', [
            'urlShortLink' => $urlShortLink,
            'urlInput' => $urlInput
        ]);
    }
}
