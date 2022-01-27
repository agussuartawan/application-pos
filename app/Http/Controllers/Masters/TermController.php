<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function searchTerm(Request $request)
    {
        $search = $request->search;
        $terms = Term::where('description', 'LIKE', "%$search%")->select('id','description', 'term_day')->get();

        return $terms;
    }
}
