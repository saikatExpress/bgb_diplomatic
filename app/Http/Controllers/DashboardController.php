<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\LetterFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $data['bgbInfo'] = Letter::where('letter_by', 'BGB')
        ->selectRaw('SUM(killing) as totalKilling, SUM(injuring) as totalinjuring, SUM(beating) as
        totalbeating, SUM(firing) as totalfiring, SUM(crossing) as totalcrossing')->first();

        $data['bsfInfo'] = Letter::where('letter_by', 'BSF')
        ->selectRaw('SUM(killing) as totalKilling, SUM(injuring) as totalinjuring, SUM(beating) as
        totalbeating, SUM(firing) as totalfiring, SUM(crossing) as totalcrossing')->first();


        $data['totals'] = Letter::selectRaw('DATE_FORMAT(letter_date, "%Y-%m") as month,letter_by,SUM(killing) as killing,SUM(injuring) as injuring,SUM(beating) as beating,SUM(firing) as firing,SUM(crossing) as crossing')->groupBy('month', 'letter_by')->orderBy('month')->get()
        ->groupBy('month');

        $replyFiles = Letter::all();

        $data['replyInfo'] = json_decode(json_encode([
            'BGB' => [
                'no_reply' => $replyFiles->where('letter_by', 'BGB')->where('status', 'no_reply')->count()
            ],

            'BSF' => [
                'no_reply' => $replyFiles->where('letter_by', 'BSF')->where('status', 'no_reply')->count()
            ],
        ]));

        $letterFiles = LetterFile::all();


        $data['filesInfo'] = json_decode(json_encode(
        [
            'BGB' => [
                'main'  => $replyFiles->where('letter_by', 'BGB')->count(),
                'ref'   => $letterFiles->where('letter_by', 'BGB')->where('file_prefix', 'ref')->groupBy('letter_number')->count(),
                'reply' => $letterFiles->where('letter_by', 'BGB')->where('file_prefix',
                'reply-file')->groupBy('letter_number')->count(),
            ],
            'BSF' => [
                'main'  => $replyFiles->where('letter_by', 'BSF')->count(),
                'ref'   => $letterFiles->where('letter_by', 'BSF')->where('file_prefix', 'ref')->groupBy('letter_number')->count(),
                'reply' => $letterFiles->where('letter_by', 'BSF')->where('file_prefix',
                'reply-file')->groupBy('letter_number')->count(),
            ],
        ]));

        return view('admin.dashboard', $data);
    }

    public function search(Request $request)
    {
        $query = DB::table('letters');

        if ($request->filled('form_date')) {
            $query->where('letter_date', '>=', $request->input('form_date'));
        }

        if ($request->filled('to_date')) {
            $query->where('letter_date', '<=', $request->input('to_date'));
        }

        $results = $query->get();

        $mapData = $results->map(function ($item) {
            return [
                'letter_by' => $item->letter_by,
                'killing'   => $item->killing,
                'injuring'  => $item->injuring,
                'beating'   => $item->beating,
                'firing'    => $item->firing,
                'crossing'  => $item->crossing,
            ];
        });

        $letterNos = $results->pluck('letter_no');


        $files = LetterFile::whereIn('letter_number', $letterNos)->get();

        $grouped = $files->groupBy(['letter_by', 'letter_number']);

        $finalCounts = [];

        foreach ($grouped as $letterBy => $letters) {
            $main = $ref = $reply = 0;

            foreach ($letters as $letterNumber => $items) {
                if ($items->contains('file_prefix', 'main')) {
                    $main++;
                }
                if ($items->contains('file_prefix', 'ref')) {
                    $ref++;
                }
                if ($items->contains('file_prefix', 'reply')) {
                    $reply++;
                }
            }

            $finalCounts[$letterBy] = [
                'main' => $main,
                'ref' => $ref,
                'reply' => $reply,
            ];
        }

        $replyInfo = [
            'BGB' => [
                'no_reply' => $results->where('letter_by', 'BGB')->where('status', 'no_reply')->count()
            ],
            'BSF' => [
                'no_reply' => $results->where('letter_by', 'BSF')->where('status', 'no_reply')->count()
            ],
        ];


        // Step 6: Return as JSON
        return response()->json([
            'mapData'   => $mapData,
            'replyInfo' => $replyInfo,
            'filesInfo' => $finalCounts,
        ]);
    }

    public function chartSearch(Request $request)
    {
        DB::enableQueryLog();

        // Base query for all filters
        $baseQuery = DB::table('letters');

        if ($request->filled('letter_by')) {
            $baseQuery->where('letter_by', $request->input('letter_by'));
        }

        $startDate = null;
        $endDate = null;

        if ($request->filled('year') && $request->filled('month')) {
            $year = $request->input('year');
            $month = $request->input('month');
            $startDate = date("Y-m-01", strtotime("$year-$month-01"));
            $endDate = date("Y-m-t", strtotime("$year-$month-01"));
        } elseif ($request->filled('year')) {
            $year = $request->input('year');
            $startDate = "$year-01-01";
            $endDate = "$year-12-31";
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $from = $request->input('from_date');
            $to = $request->input('to_date');

            if ($startDate && $endDate) {
                $startDate = max($startDate, $from);
                $endDate = min($endDate, $to);
            } else {
                $startDate = $from;
                $endDate = $to;
            }
        }

        if ($startDate && $endDate) {
            $baseQuery->whereBetween('letter_date', [$startDate, $endDate]);
        }

        // Get individual records if you still want them
        $results = (clone $baseQuery)->get();

        // Get aggregated totals using the same filters
        $totals = (clone $baseQuery)
            ->selectRaw('DATE_FORMAT(letter_date, "%Y-%m") as month, letter_by,
                SUM(killing) as killing,
                SUM(injuring) as injuring,
                SUM(beating) as beating,
                SUM(firing) as firing,
                SUM(crossing) as crossing')
            ->groupBy('month', 'letter_by')
            ->orderBy('month')
            ->get()
            ->groupBy('month');

        return response()->json([
            'totals' => $totals,
            'results' => $results,
        ]);
    }

}