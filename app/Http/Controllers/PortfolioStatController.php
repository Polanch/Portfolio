<?php

namespace App\Http\Controllers;

use App\Models\PortfolioStat;
use Illuminate\Http\Request;

class PortfolioStatController extends Controller
{
    public function incrementView(Request $request)
    {
        $page = $request->input('page', 'welcome');
        
        $stat = PortfolioStat::firstOrCreate(
            ['page' => $page],
            ['view_count' => 0]
        );
        
        $stat->increment('view_count');
        
        return response()->json([
            'view_count' => $stat->view_count,
            'message' => 'View count incremented'
        ]);
    }

    public function getViews(Request $request)
    {
        $page = $request->input('page', 'welcome');
        
        $stat = PortfolioStat::where('page', $page)->first();
        
        return response()->json([
            'view_count' => $stat ? $stat->view_count : 0
        ]);
    }
}
