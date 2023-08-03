<?php

namespace App\Http\Controllers;

use App\Models\RevisionDecree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotifikasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $notifikasi = RevisionDecree::where('status_proses_pic','=',0)
        // ->where('pic','=',Auth::user()->name)
        // ->count();

        $notifikasi = DB::table('revision_decrees')
            ->join('identification_statuses', 'revision_decrees.id', '=', 'identification_statuses.sk_id');

        return response()->json([
            'notifikasi' => $notifikasi,
        ]);
    }
}
