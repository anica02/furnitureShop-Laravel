<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Http\Requests\UserRequest;
use App\Models\ActivitiesModel;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Message;
use App\Models\MessageModel;
use App\Models\OrdersModel;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\Role;
use App\Models\UserModel;
use App\Models\Users as Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\CursorPaginator;

class AdminController extends MainController
{


    public function index(Request $request){

        $model=new ActivitiesModel();
        $activitieNames=DB::table('activities')->distinct()->select('name as name')->get();
        $activitieUsers=DB::table('activities')->select('user')->distinct()->get();


        $this->data['users']=DB::table('users')->where('id_role', '2')->where('active','1')->count('id');
        $this->data['orders']=DB::table('orders')->count('id');
        $this->data['inStock']=DB::table('products')->where('status', '1')->whereNull('old')->count('id');
        $this->data['outOfStock']=DB::table('products')->where('status', '0')->whereNull('old')->count('id');
        $this->data['acNames']=$activitieNames;
        $this->data['acUsers']=$activitieUsers;
        $request->session()->forget('nameAc');
        $request->session()->forget('userAc');
        return view('pages.admin.home', ['data'=>$this->data, "activities"=>$model->searchActivities($request)]);
    }

    public function messages(Request $request){
        $model=new MessageModel();
        $users=DB::table('messages')->distinct()->select('user as user')->get();
        $request->session()->forget('emailMsg');
        return view('pages.admin.messages.index',['messages'=>$model->searchMessages($request), "users"=>$users]);
    }


    public  function deleteMsg(Request $request) {

        $msgId=$request->msgId;
        try{
            DB::table('messages')->where('id', '=', $msgId)->delete();
            ActivityLogger::LogActivity("Message deleted ", "id=".$msgId);

        }catch(\Exception $e){
            ActivityLogger::LogActivity("Error while deleting message","id=".$msgId);
            Log::error($e->getMessage(). "\n". $e->getTraceAsString());
            return redirect()->back()->with('error-msg', 'An error occurred while deleting message');
        }

    }

    public function orders(Request $request){


        $users=Users::all();
        $model=new OrdersModel();
        $usersEmail=DB::table('users')->join('orders', 'users.id', '=', 'orders.id_user')->distinct()->select('email', 'id_user')->get();
        $this->data['emails']=$usersEmail;
        $this->data['users']=$users;
        $request->session()->forget('userO');
        $request->session()->forget('deliveryU');
        $request->session()->forget('paymentU');
        return view('pages.admin.orders.index',['model'=>$model->searchOrders($request),'data'=>$this->data]);
    }

    public  function deleteOrder(Request $request) {

        $orderId=$request->orderId;

        try{

            DB::table('orders')->where('id', '=', $orderId)->delete();

            ActivityLogger::LogActivity("Order deleted","id=".$orderId);

        }catch(\Exception $e){
            ActivityLogger::LogActivity("Error while deleting order","id=".$orderId);
            Log::error($e->getMessage(). "\n". $e->getTraceAsString());
            return redirect()->back()->with('error-msg', 'An error occurred while deleting order');
        }

    }


    public function showOrderItems(Request $request){
        $id=$request->orderItemId;
        $products=Product::all();
        $ordersItems=DB::table('order_items')->where("id_order", '=', $id)->get();

        return response()->json(["data"=>$ordersItems, "products"=>$products]);
    }

    public function users(Request $request){

        $model=new UserModel();
        $this->data['emails']= Users::all();
        $this->data['roles']=Role::all();
        $request->session()->forget('emailU');
        $request->session()->forget('roleU');
        $request->session()->forget('statusU');
        return view('pages.admin.users.index', ["model"=>$model->searchUsers($request),'data'=>$this->data]);
    }

    public function showUserParam(Request $request){
        $id=$request->userId;
        $roles=Role::all();
        $user=DB::table('users')->where('id', $id)->get();
        return response()->json(['data'=>$user, 'roles'=>$roles]);
    }

    public function deleteUser(Request $request){
        $id=$request->userId;

        try{

           DB::table('orders')->where('id_user', $id)->delete();
            DB::table('users')->where('id', $id)->delete();
            ActivityLogger::LogActivity('User deleted',"id".$id);

        }catch(\Exception $e){
            ActivityLogger::LogActivity('Error while deleting user ', "id".$id);
            Log::error($e->getMessage(). "\n". $e->getTraceAsString());
            return redirect()->back()->with('error-msg', 'An error occurred while deleting user');
        }

    }

    public function editUser(UserRequest $request){

        $status=$request->get('status');
        $role=$request->get('role');
        $id=$request->get('userId');
        $param="{Id=". $id. "}{id_role=".$role."}{active=".$status."}";
        try{
            $user= Users::find($id);
            $user->id_role=(int)$role;
            $user->active=(int)$status;
            $user->save();
            ActivityLogger::LogActivity("User edited ",$param);
            return redirect()->back()->with('success', 'User edited successfully');

        }catch(\Exception $e){
            ActivityLogger::LogActivity("Error while editing user ", $param);

            Log::error($e->getMessage(). "\n". $e->getTraceAsString());
            return redirect()->back()->with('error-msg', 'An error occurred while editing user');
        }

    }


    public function products(Request $request){


        $model=new ProductModel();
        $this->data['discounts']=Discount::all();
        $this->data['categories']=Category::all();
        $request->session()->forget('statusP');
        $request->session()->forget('discountP');
        $request->session()->forget('categoryP');
        $request->session()->forget('nameP');
        return view('pages.admin.products.index', ['model'=>$model->searchProducts($request),'data'=>$this->data]);
    }






}
