<?php

namespace App\Http\Controllers;
use App\Models\Club;
use App\Models\Score;
use Illuminate\Http\Request;
use Validator;

class ScoreController extends Controller
{
    public function create()
    {
        $clubs = Club::all();
        return view('scores.index', compact('clubs'));
    }

    public function store(Request $request)
    {
        $matches = $request->input('matches');

        try {
            foreach ($matches as $match) {
                $match = new Score([
                    'club1_id' => $match['klub1'],
                    'club2_id' => $match['klub2'],
                    'score1' => $match['score1'],
                    'score2' => $match['score2'],
                ]);
                $match->save();
        
                // Calculate stats for both clubs
                $club1 = Club::find($match->club1_id);
                $club2 = Club::find($match->club2_id);
        
                $club1->calculateStats();
                $club2->calculateStats();
            }
        
            return response()->json(['message' => 'Data pertandingan berhasil disimpan.']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'Data pertandingan yang sama sudah ada.'], 422);
        }
    }
}
