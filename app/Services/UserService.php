<?php

namespace App\Services;

use App\User;

class UserService
{
    public function createUser($data)
    {
        // Создание пользователя
        return User::create($data);
    }

    public function updateUser(User $user, $data)
    {
        // Обновление данных пользователя
        $user->update($data);
        return $user;
    }

	public function deleteUser(User $user)
	{
		// Удаление пользователя
		$user->delete();
	}

	public function getUserByEmail($email)
	{
		// Получение пользователя по адресу электронной почты
		return User::where('email', $email)->first();
	}

	public function changePassword(User $user, $newPassword)
	{
		// Изменение пароля пользователя
		$user->update(['password' => bcrypt($newPassword)]);
	}

	public function searchUsers($searchTerm)
	{
		// Поиск пользователей по заданному критерию
		return User::where('name', 'like', "%$searchTerm%")->get();
	}

}
