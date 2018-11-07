<?php

namespace App\Http\Controllers\Api;

use App\Mail\NotifyMailable;
use App\VoucherRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class VoucherRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voucherRequests = VoucherRequest::all();
        return response()->json($voucherRequests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $email
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $email)
    {
        $user = $email;
        $voucherRequest = new VoucherRequest();
        $voucherRequest->status = 'pending';
        $voucherRequest->email = $user;
        if($voucherRequest->save()){
//            $request->session()->flash('status', 'New Voucher Request have been created');
            $data = ['email'=>$user, 'message'=>'Your account details was just updated'];
            $message = 'Your request for a voucher have been received and will be attended to shortly';
            Mail::to($user)
                ->send(new NotifyMailable($data, $message));
            return response()->json(['message'=>'Voucher request have been created']);
        }
        return response()->json(['message'=>'An error occurred']);
    }

    /**
     * Display the specified resource.
     *
     * @param $email
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $voucherRequests = DB::table('voucher_requests')->where('email', $email)->get();
        return response()->json($voucherRequests);
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
        $email = Auth::user()->email;
        $code = rand(100000, 1000000000);
        $rej_reason = 'Not valid';
        $voucher = DB::table('voucher_requests')
            ->where('id', $id)
            ->update(
                [
                    'status'=> $request->exists('approved')?'approved':'declined',
                    'code'=>$code,
                    'rej_reason'=>$rej_reason
                ]);
        $vouch = DB::table('voucher_requests')
            ->where('id', $id)
            ->first();
        if($voucher){
            $request->session()->flash('status', 'Request status have been updated');
            if($request->exists('declined')){
                $data = ['email'=>$email, 'message'=>'Your account details was just updated'];
                $message = 'Your Request have been declined. Reason is below.' .$rej_reason;
                Mail::to($vouch->email)
                    ->send(new NotifyMailable($data, $message));
            }
            else{
                $data = ['email'=>$email, 'message'=>'Your account details was just updated'];
                $message = 'Your request have been approved';
                Mail::to($vouch->email)
                    ->send(new NotifyMailable($data, $message));
            }
        }
        return response()->json(['message'=>'Request status have been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
