<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RequestController;

use Illuminate\Support\Facades\Validator;

use App\Services\RequestService;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
        'topic' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
	
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

		$requestData = $request->all();
		$requestService->createRequest($requestData);
		
        return response()->json(['message' => 'Request created successfully']);
    }
	
	public function getUserRequests(RequestService $requestService)
	{
		$user = auth()->user(); // Получение текущего аутентифицированного пользователя
		$requests = $requestService->getUserRequests($user);

		return response()->json($requests);
	}

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json($user);
    }
	
	public function getAllRequests(RequestService $requestService)
	{
		$requests = $requestService->getAllRequests();

		return response()->json($requests);
	}
	
	public function updateRequestStatus(Request $request, RequestService $requestService, $id)
	{
		$validator = Validator::make($request->all(), [
        'topic' => 'required|string|max:255',
        'message' => 'required|string',
		]);
	
		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 422);
		}

		$status = $request->input('status');
		$comment = $request->input('comment');
		
		$requestService->updateRequestStatusAndComment($id, $status, $comment);

		return response()->json(['message' => 'Request status updated successfully']);
	}

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}