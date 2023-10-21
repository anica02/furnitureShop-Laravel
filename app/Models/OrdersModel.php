<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersModel extends Model
{
    use HasFactory;



    function searchOrders(Request $request){
        $query=DB::table('orders')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('order_items')
                    ->whereColumn('order_items.id_order', 'orders.id');
            });

        if($request->has("userO") && $request->get('userO')!=""){
            $query = $query->where('id_user', '=', $request->get("userO"));
            $request->session()->put("userO",$request->get("userO") );
        }

        if($request->has("paymentU") && $request->get('paymentU')!=""){
            $query = $query->where('payment_type', '=', $request->get("paymentU"));
            $request->session()->put("paymentU",$request->get("paymentU") );
        }
        if($request->has("deliveryU") && $request->get('deliveryU')!=""){
            $query = $query->where('delivery_method', '=', $request->get("deliveryU"));
            $request->session()->put("deliveryU",$request->get("deliveryU") );
        }
        $perPage = 5;
        $query=$query->orderByDesc('id');
        $query=$query->select(['id', 'id_user', 'created_at', 'total', 'quantity', 'payment_type', 'delivery_method', 'address']);

        return $query->paginate($perPage)->withQueryString();

    }
}
