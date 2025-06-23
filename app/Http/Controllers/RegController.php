<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Club;

class RegController extends Controller
{
    public function showTable()
    {
        // Get all club enrollments using JOINs
        $students = Registration::join('club_registration', 'registrations.id', '=', 'club_registration.registration_id')
            ->join('clubs', 'clubs.id', '=', 'club_registration.club_id')
            ->select(
                'registrations.name',
                'registrations.department',
                'clubs.club_name as club_enrolled'
            )
            ->get();

        // ✅ Static list of departments
        $departments = [
            'CSE', 'IT', 'ECE', 'EEE', 'MECH', 'CIVIL', 'DS', 'AI-ML',
            'MECT', 'CSBS', 'ARCH'
        ];

        // ✅ All clubs from the clubs table
        $clubs = Club::select('club_name')->get();

        return view('table', [
            'students' => $students,
            'departments' => $departments,
            'clubs' => $clubs,
        ]);
    }
}
