<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrdersController extends Controller
{
    public function index()
    {
        $this->authorize('manage', \App\Order::class);
        $orders = Order::orderBy('status')->paginate(12);
        $pageTitle = 'Список заказов';
        return view('admin.orders.orders-index', compact(['orders', 'pageTitle']));
    }

    public function update(Request $request, int $id)
    {
        $this->authorize('manage', \App\Order::class);
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        $status;
        switch ($order->status) {
            case 2:
                $status="Выполняется";
                break;
            case 3:
                $status="Выполнен";
                break;
            case 4:
                $status="Отменен";
                break;
            default:
                $status="";
        }

        $message = "<h4>Статус вашего заказа на сайте garazo.com.ua был изменен<br>
        Заказ " . $status . "</h4>";
        $headers = "Content-type:text/html;charset=UTF-8" . "\r\n" . "From: kridol@i.ua" . "\r\n";
        mail($order->email, "Статус вашего заказа на сайте garazo.com.ua был изменен", $message, $headers);

        return back()->with(['message' => 'Статус заказа успешно обновлен']);
    }

    public function destroy(int $id)
    {
        $this->authorize('manage', \App\Order::class);
        $order = Order::findOrFail($id);
        $order->products()->detach();
        $order->delete();
        return back()->with(['message' => 'Заказ успешно удален']);
    }
}
