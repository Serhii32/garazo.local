<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('status')->paginate(12);
        $pageTitle = 'Список заказов';
        return view('admin.orders.orders-index', compact(['orders', 'pageTitle']));
    }

    public function update(Request $request, int $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return back()->with(['message' => 'Статус заказа успешно обновлен']);
    }

    public function destroy(int $id)
    {
        $order = Order::findOrFail($id);
        $order->products()->detach();
        $order->delete();
        return back()->with(['message' => 'Заказ успешно удален']);
    }
}
