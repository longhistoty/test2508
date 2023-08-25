<?php

namespace App\Services;

use App\Request;

class RequestService
{
    public function createRequest($data)
    {
        // Создание заявки
        return Request::create($data);
    }

    public function updateRequest(Request $request, $data)
    {
        // Обновление данных заявки
        $request->update($data);
        return $request;
    }
	
	public function deleteRequest(Request $request)
	{
		// Удаление заявки
		$request->delete();
	}

	public function getRequestsByUser(User $user)
	{
		// Получение заявок, связанных с конкретным пользователем
		return $user->requests;
	}

	public function approveRequest(Request $request)
	{
		// Одобрение заявки
		$request->update(['status' => 'approved']);
	}

	public function rejectRequest(Request $request)
	{
		// Отклонение заявки
		$request->update(['status' => 'rejected']);
	}
	
	public function getUserRequests($user)
	{
		return Request::where('user_id', $user->id)->get();
	}
	
	public function getAllRequests()
	{
		return Request::orderBy('created_at', 'desc')->get();
	}

	public function updateRequestStatusAndComment($id, $status, $comment)
	{
		$request = Request::findOrFail($id);
		$request->status = $status;
		$request->comment = $comment;
		$request->save();
	}
}