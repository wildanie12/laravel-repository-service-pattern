<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Services\BookService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request, UserService $userService)
    {
        try {

            if (!$request->user()->tokenCan('manage-members')) {
                throw new \Exception('unauthorized user token');
            }
            
            $data = $userService->findAll();
            return response()->json([
                'data' => $data,
                'token' => $request->user()->currentAccessToken()
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
