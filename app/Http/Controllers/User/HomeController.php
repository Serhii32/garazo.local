<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Order;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::orderBy('status')->where('user_id', $user->id)->paginate(12);
        $pageTitle = 'Страница пользователя';
        return view('user.home-index', compact(['pageTitle', 'orders']));
    }

    public function edit()
    {
        $user = Auth::user();
        $pageTitle = 'Настройки профиля';
        return view('user.home-edit', compact(['user', 'pageTitle']));
    }

    public function update(StoreUserRequest $request)
    {
        $user =  Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        if ($user->email != $request->email) {
            $user->email_verified_at = null;
        }
        $user->email = $request->email;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $last_insereted_id = $user->id;
        if ($request->avatar != null) {
            if($user->avatar) {
                Storage::disk('uploaded_img')->delete($user->avatar);
            }
            $user->avatar = $request->avatar->store('img/common/avatars/users/'.$last_insereted_id, ['disk' => 'uploaded_img']);
            $user->save();
        }
        return redirect()->route('user.home.index')->with(['message' => 'Данные профиля успешно обновлены']);
    }

    public function destroy()
    {
        $user =  Auth::user();
        $orders = $user->orders()->get();
        foreach ($orders as $order) {
            $order->user_id = null;
            $order->save();
        }
        Auth::logout();
        Storage::disk('uploaded_img')->deleteDirectory('img/common/avatars/users/' . $user->id);
        $user->delete();
        return redirect('/');
    }

    public function cancelOrder(Request $request, int $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return back()->with(['message' => 'Заказ успешно отменен']);
    }
}
