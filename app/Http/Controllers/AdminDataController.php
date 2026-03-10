<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Http\Requests\DatatablesRequest;
use App\Http\Requests\RejectDataRequest;
use App\Models\City;
use App\Models\Data;
use App\Models\Package;
use App\Services\StatusService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminDataController extends Controller
{
    protected $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }

    // Data pages        
    public function index()
    {
        try {
            $cities = City::orderBy('name')->get();

            $packages = Package::orderBy('name')->get();

            $reason = Constant::rejectionMessage;

            return view('pages.admin.data.index', compact('cities', 'packages', 'reason'));
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    // data for datatables yajra
    public function indexTables(DatatablesRequest $request)
    {
        try {

            $data = $request->getFilter(
                Data::with('package.city')->latest()
                );

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return view('pages.admin.data.partials.status-badge', compact('row'))->render();
                })
                ->addColumn('created', function ($row) {
                    return Carbon::parse($row->created_at)->shortAbsoluteDiffForHumans();
                })
                ->addColumn('action', function ($row) {
                    return view('pages.admin.data.partials.action', compact('row'))->render();
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    // data datails
    public function details($slug)
    {
        try {
            $id = $this->getIdFromSlug($slug);

            $data = Data::with('package.city')->findOrFail($id);
            $package = $data->package;
            $city = $package->city;

            return view('pages.admin.data.details.index', compact('slug', 'data', 'package', 'city'));
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    // dashboard approval 
    public function approve($id)
    {
        try {
            $data = Data::findOrFail($id);

            $this->statusService->approve($data);

            return response()->json([
                'success' => true,
                'message' => 'Package approved successfully'
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    //dashboard rejection
    public function reject(RejectDataRequest $request, $id)
    {
        try {
            $reason = $request->validated()['reason'];
            $data = Data::findOrFail($id);

            $this->statusService->reject($data, $reason);

            return response()->json([
                'error' => false,
                'message' => 'Request berhasil di tolak',
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    //dashboard deletion data
    public function destroy($id)
    {
        try {
            $data = Data::findOrFail($id);
            $data->delete();
            return response()->json([
                'error' => false,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }
}
