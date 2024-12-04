<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    public function index(Request $request)
    {
        //$this->authorize('view_newsletter');

        if ( $request->ajax() )
        {
            $newsletter = getModelData( model : new NewsLetter() );

            return response()->json($newsletter);
        }

        return view('dashboard.news-letter.index');
    }

    public function destroy(NewsLetter $newsletter)
    {
        $this->authorize('delete_newsletter');

        $newsletter->delete();

        return response(["newsletter deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_newsletter');

        NewsLetter::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected newsletters deleted successfully"]);
    }
}
