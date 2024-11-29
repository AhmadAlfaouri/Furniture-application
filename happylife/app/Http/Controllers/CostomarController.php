<?php

namespace App\Http\Controllers;

use App\Models\Catagories;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Products;
use App\Models\Reviews;
use App\Models\Shipments;
use Illuminate\Http\Request;

class CostomarController extends Controller
{

Public function catagories_Search(Request $request)
{
$data = Catagories::where('name' ,$request->name)->with('pro')->get();
return response()->json($data);
}

Public function price_Search(Request $request)
{
$data = Products::where('price' ,$request->price)->get();
return response()->json($data);
}

    public function add_review(Request $request)
    {
        $data['products_id'] = $request->products_id ;
        $data['user_id'] = $request->user_id;
        $data['reviews'] = $request->reviews;
        $data['description']=$request->description;
        $user =Reviews::create($data);
        return response()->json($data);

    }
    public function add_order(Request $request)
    {
        $data['total'] = $request->total ;
        $data['user_id'] = $request->user_id;
        $data['order_date'] = $request->order_date;
        $data['status']=$request->status;
        $user =Order::create($data);
        return response()->json($data);

    }
    public function add_order_pro(Request $request)
    {
        $data['Products_id'] = $request->Products_id;
        $data['order_id'] = $request->order_id;
        $data['quantity'] = $request->order_date;

        $user =Order_product::create($data);
        return response()->json($data);

    }
    public function add_shipments(Request $request)
    {

        $data['order_id']=$request->order_id;
        $data['shipment_name'] = $request->shipment_name;
        $data['expected_date'] = $request->expected_date;
        $data['shipmant_cost'] = $request->shipmant_cost;
        $data['status'] = $request->status;
        $data['image'] = $request->image;
        $user = Shipments::create($data);
        return response()->json($data);
    }

}
