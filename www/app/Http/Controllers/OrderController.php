<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Order;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::where('order_status','=','1')->get();
        return view('order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('title','id')->all();
        $tags = Tag::pluck('title','id')->all();

        return view('order.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'reward' => 'required|integer|min:1',
            'image' => 'nullable|image'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['image'] = Order::uploadImage($request);
        $order = Order::create($data);
        $order->tags()->sync($request->tags);
            
        return redirect()->route('orders.index')->with('success','Order added');
    
    }
    
    public function confirm($id)
    {
        $order = Order::find($id);
        $this->authorize('isOwner', $order);

        $account = auth()->user()->account;
        if($account->holdBalance($order['reward'])){
            $account->update();
            $order->order_status = 1;
            $order->update();
            return redirect()->route('orders.index')->with('success','Order was confirm');
        }
        
        return redirect()->route('orders.index')->with('error','Order wasnt confirm');
    }

    public function complete($id)
    {
        $order = Order::find($id);
        $author = User::find($order->user_id);
        $hunter = auth()->user();

        $author->account->sendTo($hunter->account,$order->getHunterReward());
        
        $author->account->update();
        $hunter->account->update();

        $order->order_status = 2;
        $order->hunter_id = $hunter->id;
        
        $order->update();
        return redirect()->route('orders.index')->with('success','Вы успешно выполнили задачу');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $order->views += 1;
        $order->update();
        return view('order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $this->authorize('isOwner', $order);
        
        $categories = Category::pluck('title','id')->all();
        $tags = Tag::pluck('title','id')->all();

        return view('order.edit',compact('order','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $this->authorize('isOwner', $order);
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'reward' => 'required|integer|min:1',
            'image' => 'nullable|image'
        ]);

        $data = $request->all();
        $account = auth()->user()->account;
        $reward_diff = $data['reward'] - $order->reward;
        if($reward_diff>0){
            if(!$account->holdBalance($reward_diff)){
                return redirect()->route('orders.index')->with('error','Недостаточно деняг для обновления');
            }
        } elseif($reward_diff<0){
            if(!$account->unholdBalance(abs($reward_diff))){
                return redirect()->route('orders.index')->with('error','Недостаточно деняг для обновления');
            }
        }
        $account->update();

        $data['image'] = Order::uploadImage($request,$order->image);
        $order->update($data);
        $order->tags()->sync($request->tags);

        return redirect()->route('orders.index')->with('success','Order updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($order = Order::find($id)){
            $this->authorize('isOwner', $order);
            $account = auth()->user()->account;
            if(!$account->unholdBalance($order->reward)){
                return redirect()->route('orders.index')->with('error','Недостаточно деняг для обновления');
            }
            $order->tags()->sync([]);
            $account->update();
            Storage::delete($order->image);
            $order->delete();
            
            return redirect()->route('orders.index')->with('success','Order deleted');
        }
        return redirect()->back()->with('error',"Can't find this order");
    }
}
