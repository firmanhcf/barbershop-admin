<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Outlet;
use App\OperationalItem;
use App\OperationalActivity;
use Carbon\Carbon;

class OperationalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showOperationalDashboard()
    {

        $items = OperationalItem::all();

        if(\Auth::user() -> staff_position < 6){
            $outlets = Outlet::all();
            $operationals = OperationalActivity::all();
        }
        else if(\Auth::user() -> staff_position == 6 || \Auth::user() -> staff_position == 8){
            $outlets = Outlet::where('id', \Auth::user() -> outlet_id) -> get();
            $operationals = OperationalActivity::where('outlet_id', \Auth::user() -> outlet_id)->get();
        }
        else if(\Auth::user() -> staff_position == 7){
            $outlets = Outlet::whereRaw("id in (select id from outlets where partner_id='".\Auth::user() -> partner_id."')") -> get();
            $operationals = array();
        }

        return view('dashboard.operational.dashboard', compact('outlets', 'items', 'operationals'));
        
    }

    public function inputNewOperational(Request $request)
    {

        $evidenFile = $request -> file('eviden_file');
        $filename = $evidenFile -> getClientOriginalName();
        $extension = $evidenFile -> getClientOriginalExtension();
        $eviden = sha1($filename . time()) . '.' . $extension;
        $destinationPath = public_path() . '/assets/operational/eviden/';
        $request->file('eviden_file')->move($destinationPath, $eviden);

        $newOperational = new OperationalActivity();
        $newOperational -> outlet_id = $request -> outlet_id;
        $newOperational -> item_id = $request -> item_id;
        $newOperational -> qty = $request -> qty;
        $newOperational -> price = $request -> price;
        $newOperational -> eviden = $eviden;
        $newOperational -> create_by = \Auth::user()->id;
        
        if($newOperational -> save()){
            return redirect()
                ->back()
            ->with('success', 'Data kegiatan operasional telah berhasil disimpan.');
        }
        else{
            return redirect()
            ->back()
            ->withErrors([
                'err_msg' => 'Gagal menyimpan kegiatan operasional, hubungi administrator untuk info lebih lanjut.',
            ]);
        }

    }

    public function deleteOperational($id)
    {
    	$operational = OperationalActivity::findOrFail($id);
        $operational -> delete();

        if ($operational->trashed()) {
            return redirect()
                ->back()
                ->with('success', 'Data kegiatan operasional telah dihapus');
        }
        else{
            return redirect()
                ->back()
                ->withErrors([
                    'err_msg' => 'Gagal menghapus data kegiatan operasional, hubungi administrator untuk info lebih lanjut',
                ]);
        }
    }

    public function showEditOperational($id)
    {
        
        $operational = OperationalActivity::findOrFail($id);

        $items = OperationalItem::all();

        if(\Auth::user() -> staff_position < 6){
            $outlets = Outlet::all();
        }
        else if(\Auth::user() -> staff_position == 6 || \Auth::user() -> staff_position == 8){
            $outlets = Outlet::where('id', \Auth::user() -> outlet_id) -> get();
        }
        else if(\Auth::user() -> staff_position == 7){
            $outlets = Outlet::whereRaw("id in (select id from outlets where partner_id='".\Auth::user() -> partner_id."')") -> get();
        }

        return view('dashboard.operational.edit', compact('outlets', 'items', 'operational'));

    }

    public function editOperational(Request $request, $id)
    {
    	$operational = OperationalActivity::findOrFail($id);
        $operational -> outlet_id = $request -> outlet_id;
        $operational -> item_id = $request -> item_id;
        $operational -> qty = $request -> qty;
        $operational -> price = $request -> price;
        $operational -> update_by = \Auth::user()->id;

        if ($request->hasFile('eviden_file')) {
            $evidenFile = $request -> file('eviden_file');
            $filename = $evidenFile -> getClientOriginalName();
            $extension = $evidenFile -> getClientOriginalExtension();
            $eviden = sha1($filename . time()) . '.' . $extension;
            $destinationPath = public_path() . '/assets/operational/eviden/';
            $request->file('eviden_file')->move($destinationPath, $eviden);
            $operational -> eviden = $eviden;
        
        }
        
        if($operational -> save()){
            return redirect()
                ->back()
            ->with('success', 'Data kegiatan operasional telah berhasil disimpan.');
        }
        else{
            return redirect()
            ->back()
            ->withErrors([
                'err_msg' => 'Gagal menyimpan kegiatan operasional, hubungi administrator untuk info lebih lanjut.',
            ]);
        }
    }   

}