<?php

namespace App\Http\Controllers;

use App\Models\MeetingMaterial;
use App\Models\OldStandard;
use Illuminate\Http\Request;
use App\Models\RevisionDecree;
use App\Models\TransitionTime;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sni_wajib = DB::table('old_standards')
            ->join('revision_decrees', 'old_standards.sk_id', '=', 'revision_decrees.id')
            ->join('standard_traits', 'standard_traits.sk_id', '=', 'revision_decrees.id')
            ->select('old_standards.nmr_std')
            ->where('standard_traits.sifat_std', '=', 0)->count();
        $sni_sukarela = DB::table('old_standards')
            ->join('revision_decrees', 'old_standards.sk_id', '=', 'revision_decrees.id')
            ->join('standard_traits', 'standard_traits.sk_id', '=', 'revision_decrees.id')
            ->select('old_standards.nmr_std')
            ->where('standard_traits.sifat_std', '=', 1)->count();
        $sk_total = OldStandard::count();

        $teridentifikasi = DB::table('revision_decrees')
            ->join('identification_statuses', 'revision_decrees.id', '=', 'identification_statuses.sk_id')
            ->selectRaw('COUNT(revision_decrees.id)')
            ->where('identification_statuses.status', 1)
            ->get();
        $belum_teridentifikasi = DB::table('revision_decrees')
            ->join('identification_statuses', 'revision_decrees.id', '=', 'identification_statuses.sk_id')
            ->selectRaw('COUNT(revision_decrees.id)')
            ->where('identification_statuses.status', 0)
            ->get();

        $list_pic = DB::table('revision_decrees')
            ->join('identification_statuses', 'revision_decrees.id', '=', 'identification_statuses.sk_id')
            ->select('revision_decrees.pic_identifikasi')
            ->selectRaw('COUNT(CASE WHEN identification_statuses.status = 0 THEN 1 END) AS belum_teridentifikasi')
            ->selectRaw('COUNT(CASE WHEN identification_statuses.status = 1 THEN 1 END) AS teridentifikasi')
            ->groupBy('revision_decrees.pic_identifikasi')->get();

        $belum_dibahas =
            DB::table('old_standards')
            ->whereIn(
                'old_standards.id',
                DB::table('meeting_materials')
                    ->join('discussion_results', 'meeting_materials.id', '=', 'discussion_results.material_id')
                    ->select('meeting_materials.old_std_id')->whereRaw('discussion_results.material_status IS NULL')
            )->count();
        $sudah_dibahas =
            DB::table('old_standards')
            ->whereIn(
                'old_standards.id',
                DB::table('meeting_materials')
                    ->join('discussion_results', 'meeting_materials.id', '=', 'discussion_results.material_id')
                    ->select('meeting_materials.old_std_id')->whereRaw('discussion_results.material_status IS NOT NULL')
            )->count();

        $pencabutan = DB::table('meeting_materials')
            ->join('discussion_results', 'meeting_materials.id', '=', 'discussion_results.material_id')
            ->select('meeting_materials.old_std_id')
            ->where('discussion_results.material_status', 0)
            ->count();

        $transisi = DB::table('meeting_materials')
            ->join('discussion_results', 'meeting_materials.id', '=', 'discussion_results.material_id')
            ->select('meeting_materials.old_std_id')
            ->where('discussion_results.material_status', 1)
            ->count();

        return view('dashboard', compact([
            'sni_wajib', 'sni_sukarela', 'sk_total',
            'teridentifikasi', 'belum_teridentifikasi',
            'list_pic',
            'pencabutan', 'transisi',
            'belum_dibahas', 'sudah_dibahas'
        ]));
    }

    public function masaTransisiSNI(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('meeting_materials')
                ->join('meeting_schedules', 'meeting_materials.meeting_id', '=', 'meeting_schedules.id')
                ->join('discussion_results', 'meeting_materials.id', '=', 'discussion_results.material_id')
                ->join('old_standards', 'meeting_materials.old_std_id', '=', 'old_standards.id')
                ->join('revision_decrees', 'revision_decrees.id', '=', 'old_standards.sk_id')
                ->join('new_standards', 'revision_decrees.id', '=', 'new_standards.sk_id')
                ->join('transition_times', 'meeting_materials.id', '=', 'transition_times.material_id')
                ->leftJoin('memos', 'meeting_schedules.id', '=', 'memos.meeting_id')
                ->select(
                    'new_standards.nmr_std',
                    'new_standards.jdl_std',
                    'old_standards.nmr_std',
                    'old_standards.jdl_std',
                    'transition_times.batas_transisi',
                    'memos.nmr_kepka'
                )
                ->where('discussion_results.material_status', '=', 1)
                ->where('memos.jenis_nodin', '=', 1)
                ->orderBy('transition_times.batas_transisi', 'ASC')
                ->groupBy('old_standards.id')
                ->get();

            return DataTables::of($data)->addIndexColumn()->make(true);
        }

        return view('dashboard');
    }

    public function SNIpencabutan(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('meeting_materials')
                ->join('meeting_schedules', 'meeting_materials.meeting_id', '=', 'meeting_schedules.id')
                ->join('discussion_results', 'meeting_materials.id', '=', 'discussion_results.material_id')
                ->join('old_standards', 'meeting_materials.old_std_id', '=', 'old_standards.id')
                ->join('revision_decrees', 'old_standards.sk_id', '=', 'revision_decrees.id')
                ->join('identifications', 'revision_decrees.id', '=', 'identifications.sk_id')
                ->leftJoin('memos', 'meeting_schedules.id', '=', 'memos.meeting_id')
                ->select(
                    'old_standards.nmr_std',
                    'old_standards.jdl_std',
                    'identifications.komtek',
                    'memos.nmr_kepka'
                )
                ->where('discussion_results.material_status', '=', 0)
                ->where('memos.jenis_nodin', '=', 0)
                ->orderBy('old_standards.nmr_std', 'ASC')
                ->groupBy('old_standards.id')
                ->get();

            return DataTables::of($data)->addIndexColumn()->make(true);
        }

        return view('dashboard');
    }

    // public function test()
    // {
    //     $data = TransitionTime::select('batas_transisi')->first();

    //     return response()->json([
    //         'data' => $data,
    //     ]);
    // }
}
