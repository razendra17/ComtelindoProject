<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Http\Requests\RejectDataRequest;
use App\Http\Requests\StoreDataRequest;
use App\Models\City;
use App\Models\Data;
use App\Models\Package;
use App\Services\StatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DataController extends Controller
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
    public function indexTables(Request $request)
    {
        try {
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
                ->addColumn('status', function ($row) {
                    return view('pages.admin.data.partials.status-badge', compact('row'))->render();
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
            $id = explode('-', $slug);
            $id = end($id);

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


    // Main page, use for user temp package
    public function userIndex()
    {
        $cities = City::with('packages')->get();
        $user = auth()->user();
        return view('pages.user.index', compact('cities'));
    }

    // temp user area, get from selected user package
    public function area(Package $package, $slug)
    {
        try {

            $id = explode('-', $slug);
            $id = end($id);

            $package = Package::with('city')->findOrFail($id);
            $city = $package->city;
            return view('pages.user.area.index', [
                'package' => $package,
                'city' => $city->name,
                'lat' => $city->latitude,
                'long' => $city->longitude,
                'slug' => $slug
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    // filter package by city
    public function filter($cityId)
    {
        $packages = Package::where('city_id', $cityId)->get();
        return view('pages.user.assets.Package', compact('packages'))->render();
    }


    // temp user store adress
    public function storeAddress(Request $request, $slug)
    {
        try {
            $id = explode('-', $slug);
            $id = end($id);

            session([
                'temp.package_id' => $id,
                'temp.address' => $request->address,
                'temp.latitude' => $request->latitude,
                'temp.longitude' => $request->longitude,
            ]);

            return redirect()->route('personal.index', compact('slug'));
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    // Personal user forms
    public function personalForms($slug)
    {
        try {
            $id = explode('-', $slug);
            $id = end($id);

            $package = Package::findOrFail($id);

            $address = session('temp.address');
            $latitude = session('temp.latitude');
            $longitude = session('temp.longitude');

            return view('pages.user.personal.index', compact('latitude', 'longitude', 'package', 'address', 'id', 'slug'));
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    // store user data
    public function dataStore(StoreDataRequest $request)
    {
        try {
            Data::create($request->validated());

            return response()->json([
                'message' => 'Data berhasil dikirim!',
                'redirect' => route('redirect.index') // halaman awal
            ], 200);
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
    public function redirect()
    {
        return view('pages.user.redirect');
    }
}
