<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Catagories;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Products;
use App\Models\Shipments;
use App\Models\User;
use App\Models\Wallte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function register_User( Request $request)
    {

        $wallet['balance']=$request->balance;
        $wallet['currency']=$request->currency;

        $wa =Wallte::create($wallet);

        $data['name']         = $request->name;
        $data['phone']        = $request->phone;
        $data['email']        = $request->email;
        $data['password']     = Hash::make($request->password) ;
        $data['address']      = $request->address;
        $data['type']         = $request->type;
        $data['wallte_id']    = $wa->id;
        $da = User::create($data);
        return response()->json([$data,$wa]);

    }

    public function login(Request $request)
    {
        $data = $request->only('email' ,'password');

        if(Auth::attempt($data)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);

        }

        else{
            return response()->json('user not found' , 401);
        }
    }
    public function add_product(Request $request)
    {

        $data['catagories_id']=$request->catagories_id;
        $data['quanity'] = $request->quanity;
        $data['width'] = $request->width;
        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['length'] = $request->length;
        $data['discount'] = $request->discount;
        $data['description'] = $request->description;
        $data['image'] = $request->image;
        $user = Products::create($data);
        return response()->json($data);

    }

    public function delete_product($id)
    {
        $data=Products::find($id);
        $data->delete();
        return response()->json('delete_product');
    }
    public function add_Catagories(Request $request)
    {
        $data['name'] = $request->name;
        $data['sub_name'] = $request->sub_name;
        $user = Catagories::create($data);
        return response()->json('add_Catagories');

    }

    public function show_one_products($id)
    {
        $data = Products::where('id', $id)->first();
        return response()->json($data);
    }

        public function update_products(Request $request,$id)
    {
        $data=Products::where('id',$id)->first();
        $data->update([
            'catagories_id'=>$request->catagories_id ?? $data->catagories_id,
            'quanity'=>$request->quanity ??$data->quanity,
            'width'=>$request->width ?? $data->width,
            'name'=>$request->name ??$data->name,
            'price'=>$request->price ?? $data->price,
            'length'=>$request->length ??$data->length,
            'discount'=>$request->discount??$data->discount,
            'description'=>$request->description??$data->description,
            'image'=>$request->image??$data->image,
        ]);
        return response()->json($data);
    }
    public function numbers_user()
    {

        $data=User::count();

        return response()->json([$data]);
    }
    public function numbers_products()
    {

        $data=Products::count();

        return response()->json([$data]);
    }
    public function show_products()
    {
        $data= Products::get();
        return response()->json($data);
    }
    public function show_one_user($id)
    {
        $data = User::where('id', $id)->first();
        return response()->json($data);
    }
    public function update_user(Request $request,$id)
    {
        $data=User::where('id',$id)->first();
        $data->update([
            'name'=>$request->name ?? $data->name,
            'phone'=>$request->phone ??$data->phone,
            'email'=>$request->email ?? $data->email,
            'password'=>$request->password ??$data->password,
            'address'=>$request->address ??$data->address,
            'type'=>$request->type ??$data->type,
            'wallet_id'=>$request->wallet_id ??$data->wallet_id,
        ]);
            return response()->json($data);
        }
        public function update_wallet(Request $request,$id)
        {
            $data=User::where('id',$id)->first();
            $data->update([
                'name'=>$request->name ?? $data->name,
                'phone'=>$request->phone ??$data->phone,
            ]);
            return response()->json($data);
        }
        public function delete_wallet($id)
        {
            $data=Wallte::where('id',$id)->first();
            $data->delete();
            return response()->json('wallet dlete');
        }
        public function accept_ordar(Request $request, $id)
    {
        $data = Order::where('id', $id)->first();
        if ($data['status'] == 'pending')
            $data->update([
                'status' => 'active'
            ]);
        return response()->json('accept ordar');
    }
    public function accept(Request $request, $id)
    {
        $data['Products_id'] = $request->Products_id;
        $data['order_id'] = $request->order_id;
        $data['quantity'] = $request->order_date;
        $user =Order_product::create($data);
        return response()->json($data);

    }

}
