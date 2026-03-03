<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Mail\StatusUpdateMail;
use App\Models\City;
use App\Models\Data;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        //filter waktu
        $start = $request->start_date
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->subDays(7)->startOfDay();

        $end = $request->end_date
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfDay();

        $statusCounts = Data::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $alldata  = $statusCounts->sum();
        $approved = $statusCounts[Constant::status['approved']] ?? 0;
        $rejected = $statusCounts[Constant::status['rejected']] ?? 0;
        $pending  = $statusCounts[Constant::status['pending']] ?? 0;

        $chartData = Data::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labels = $chartData->pluck('tanggal');
        $totals = $chartData->pluck('total');

        $dominantReasons = Data::where('status', Constant::status['rejected'])
            ->select('rejection', DB::raw('COUNT(*) as total'))
            ->groupBy('rejection')
            ->orderByDesc('total')
            ->limit(3)
            ->get();


        return view('pages.admin.dashboard.index', compact(
            'alldata',
            'approved',
            'rejected',
            'pending',
            'labels',
            'totals',
            'dominantReasons'
        ));
    }
    public function dataIndex()
    {
        $cities = City::orderBy('name')->get();
        $packages = Package::orderBy('name')->get();

        return view('pages.admin.data.index', [
            'rejectionMessages' => Constant::rejectionMessage,
            'cities' => $cities,
            'packages' => $packages,
        ]);
    }

    public function data(Request $request)
    {
        $data = Data::with('package.city');

        // FILTER STATUS
        if ($request->status) {
            $data->where('status', $request->status);
        }

        // FILTER CITY
        if ($request->city_id) {
            $data->whereHas('package.city', function ($q) use ($request) {
                $q->where('id', $request->city_id);
            });
        }

        // FILTER PACKAGE
        if ($request->package_id) {
            $data->where('package_id', $request->package_id);
        }

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('status_badge', function ($row) {
                return view('pages.admin.data.partials.status-badge', compact('row'))->render();
            })

            ->addColumn('action', function ($row) {
                return view('pages.admin.data.partials.action', compact('row'))->render();
            })

            ->rawColumns(['status_badge', 'action'])

            ->make(true);
    }

    public function approve($id)
    {
        $data = Data::findOrFail($id);
        $data->status = Constant::status['approved']; // atau 'approved'
        $data->save();
        Mail::to($data->email)
            ->send(new StatusUpdateMail($data, 'approved'));


        return response()->json([
            'success' => true,
            'message' => 'Package approved successfully'
        ]);
    }

    public function reject(Request $request, $id)
    {
        $validated = $request->validate([
            'reason' => [
                'required',
                Rule::in(array_values(Constant::rejectionMessage))
            ]
        ]);

        $data = Data::findOrFail($id);
        try {

            Mail::to($data->email)
                ->send(new StatusUpdateMail($data, 'rejected'));

            // kalau tidak error → email berhasil
            $data->status = Constant::status['rejected'];
            $data->rejection = $validated['reason'];
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Request berhasil di tolak',
                'emailsent' => 'Berhasil mengirim email'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Email gagal dikirim',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $data = Data::findOrFail($id);
            $data->delete();
        });

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
    public function details($slug)
    {
        $id = explode('-', $slug);
        $id = end($id);

        $data = Data::with('package.city')->findOrFail($id);
        $package = $data->package;
        $city = $package->city;

        return view('pages.admin.data.details.index', compact('slug', 'data', 'package', 'city'));
    }
}
