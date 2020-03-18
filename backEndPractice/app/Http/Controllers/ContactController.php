<?php

namespace App\Http\Controllers;

use App\Contacts;
use App\Mail\SendTestMail;
use App\Mail\sendToCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact_datas = Contacts::all();
        return view('admin/contact/index', compact('contact_datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_data = $request->all();
        $contact_data = Contacts::create($request_data);

        Mail::to('birnie1571@gmail.com')->send(new SendTestMail($contact_data));  //寄信通知管理員有人填寫連絡表單
        Mail::to($contact_data->email)->send(new sendToCustomer($contact_data));  //寄信通知填表單者我們已收到消息
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Contacts::find($id); //找到正在執行動作的是哪一筆資料
        $item->delete(); //刪除資料

        return redirect("/home/contact");
    }


    

}
