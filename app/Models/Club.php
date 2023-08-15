<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function calculateStats()
    {
        $this->main = $this->matches()
                    ->selectRaw('count(*) as count')
                    ->where(function ($query) {
                        $query->where('club1_id', $this->id)
                            ->orWhere('club2_id', $this->id);
                    })
                    ->groupBy('club1_id', 'club2_id')
                    ->get()
                    ->sum('count');
        $this->menang = $this->matches()->where(function ($query) {
            $query->whereColumn('score1', '>', 'score2')
                ->orWhere(function ($query) {
                    $query->whereColumn('score1', '=', 'score2')
                            ->whereColumn('score1', '>', 'score2');
                });
        })->count();
        $this->seri = $this->matches()->where(function ($query) {
            $query->whereColumn('score1', '=', 'score2')
                ->orWhere(function ($query) {
                    $query->whereColumn('score1', '>', 'score2')
                            ->whereColumn('score1', '<', 'score2');
                });
        })->count();
        $this->kalah = $this->matches()->where(function ($query) {
            $query->whereColumn('score1', '<', 'score2')
                ->orWhere(function ($query) {
                    $query->whereColumn('score1', '=', 'score2')
                            ->whereColumn('score1', '<', 'score2');
                });
        })->count();
        $this->goal_menang = $this->matches()->sum('score1');
        $this->goal_kalah = $this->matches()->sum('score2');


        // Hitung point berdasarkan aturan
        $this->point = ($this->menang * 3) + $this->seri;
        
        $this->save();
    }

    public function matches()
    {
        return $this->hasMany(Score::class, 'club1_id');
    }
}
