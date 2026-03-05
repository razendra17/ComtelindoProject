<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function errorResponse(\Exception $e, $message, $code)
    {
        Log::error($message, [
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'user_id' => auth()->id(),
            'url' => request()->fullUrl(),
            'method' => request()->method(),
        ]);
        
        return response()->json([
            'error' => true,
            'message' => $message,
            'debug' => $e->getMessage()
        ], $code);
    }
    public function home()
    {
        try {
            $user = auth()->user();
            if ($user) {
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->route('data.index');
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

}
