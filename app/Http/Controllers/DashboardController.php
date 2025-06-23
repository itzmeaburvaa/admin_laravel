<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total number of clubs from clubs table
        $totalClubs = DB::table('clubs')->count();

        // Total club applications from club_registration table
        $totalApplications = DB::table('club_registration')->count();

        // Total distinct students from registrations table
        $totalStudents = DB::table('registrations')->count();

        // Recent 5 registrations (optional)
        $recentRegistrations = DB::table('registrations')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Department-wise distribution from registrations table
        $departmentDistribution = DB::table('registrations')
            ->select('department', DB::raw('count(*) as total'))
            ->groupBy('department')
            ->pluck('total', 'department')
            ->toArray();

        // Top 5 popular clubs from club_registration table
        $popularClubs = DB::table('club_registration')
            ->join('clubs', 'club_registration.club_id', '=', 'clubs.id')
            ->select('clubs.club_name', DB::raw('count(*) as total'))
            ->groupBy('clubs.club_name')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'clubs.club_name')
            ->toArray();

        return view('dash', [
            'totalClubs' => $totalClubs,
            'totalApplications' => $totalApplications,
            'totalStudents' => $totalStudents,
            'recentRegistrations' => $recentRegistrations,
            'departmentDistribution' => $departmentDistribution,
            'popularClubs' => $popularClubs
        ]);
    }
}
