<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use App\Models\Virtual_number;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['pageTitle'] = 'Dompet';

         $todo = Todo::where('user_id', Auth::id())
         ->whereIn('status', ['pending', 'revisi'])
         ->latest()->paginate(5);
          
          $data['total'] = Todo::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'revisi'])
            ->sum('price');

           $data['totalWallet'] = Wallet::where('user_id', Auth::id())
            ->sum('total');

        $data['todo'] =  $todo;
        $data['wallet'] =  Wallet::where('user_id', Auth::id())
        ->get();
        $data['virtual'] =  Virtual_number::where('user_id', Auth::id())
        ->get();
        return view('wallet.index', $data);
    }

    public function withdrawal()
    {
         $data['pageTitle'] = 'Withdrawal';

        $data['wallet'] =  Wallet::where('type', 'withdrawal')
        ->get();
        return view('withdrawal.index', $data);
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

       $totalSaldo = Wallet::where('user_id', Auth::id())
            ->sum('total');

        if($totalSaldo < 1){
     return redirect('/wallet')->withErrors(['message' => 'Mohon Maaf !, Saldo anda kosong']);

        } else {
            $wallet = Wallet::create([
                'user_id' => Auth::id(),
                'task_id' => 0,
                'total' =>  "-".$totalSaldo ,
                'virtual_id' => $request->virtual,
                'status' => 'pending',
                'type' => 'withdrawal',
                'desc' => 'Penarikan dana'
            ]);
            return redirect('/wallet')->with('message', 'Penarikan dana berhasil di kirim, harap menunggu konfirmasi maksimal 3 hari kerja');


        }


    }

    public function store_virtual(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'virtual' => 'required',
            'no_virtual' => 'required',
            'name_virtual' => 'required',
        ];
        $message = [
            'user_id' => 'Harus di isi',
            'virtual' => 'Harus di isi',
            'no_virtual' => 'Harus di isi',
            'name_virtual' => 'Harus di isi',
        ];

        $this->validate($request, $rules, $message);
        $no_virtual = Virtual_number::create([
            'user_id' => $request->user_id,
            'virtual' => $request->virtual,
            'no_virtual' => $request->no_virtual,
            'name_virtual' => $request->name_virtual,
        ]);

        $no_virtual->save();
        

        return redirect('/wallet')->with('message', 'No virtual berhasil di tambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
       


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Wallet $wallet)
    {
        $wallet = Wallet::find($wallet->id);
        $wallet->update([
            'status' => 'paid',
        ]);
        return redirect('/withdrawal')->with('message', 'Penarikan dana berhasil di cairkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
