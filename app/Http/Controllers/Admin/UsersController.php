<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '=', 2)->paginate(12);
        $pageTitle = 'Список пользователей';
        return view('admin.users.users-index', compact(['pageTitle', 'users']));
    }

    public function show(int $id)
    {
        $user = User::findOrFail($id);
        $orders = Order::orderBy('status')->where('user_id', $id)->paginate(12);
        $pageTitle = 'Заказы пользователя';
        return view('admin.users.users-show', compact(['orders', 'user', 'pageTitle']));
    }

    public function destroy(int $id)
    {
        Storage::disk('uploaded_img')->deleteDirectory('img/common/avatars/users/' . $id);
        $user = User::findOrFail($id);
        $orders = $user->orders()->get();
        if(!empty($orders)) {
            foreach ($orders as $order) {
                $order->user_id = null;
                $order->save();
            }
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with(['message' => 'Пользователь успешно удален']);
    }
}
