<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Outlet;
use App\AssetItem;
use App\Asset;
use Carbon\Carbon;

class AssetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showAssetDashboard()
    {

        $items = AssetItem::all();
        $assetStatus = config('app.asset_status');

        if(\Auth::user() -> staff_position < 6){
            $outlets = Outlet::all();
            $assets = Asset::all();
        }
        else if(\Auth::user() -> staff_position == 6 || \Auth::user() -> staff_position == 8){
            $outlets = Outlet::where('id', \Auth::user() -> outlet_id) -> get();
            $assets = array();
        }
        else if(\Auth::user() -> staff_position == 7){
            $outlets = Outlet::whereRaw("id in (select id from outlets where partner_id='".\Auth::user() -> partner_id."')") -> get();
            $assets = array();
        }

        return view('dashboard.asset.dashboard', compact('outlets', 'items', 'assetStatus', 'assets'));
    }

    public function inputNewAsset(Request $request)
    {

        $newAsset = new Asset();
        $newAsset -> outlet_id = $request -> outlet_id;
        $newAsset -> item_id = $request -> item_id;
        $newAsset -> qty = $request -> qty;
        $newAsset -> price = $request -> price;
        $newAsset -> status = $request -> status;
        $newAsset -> create_by = \Auth::user()->id;

        if($newAsset -> save()){
            return redirect()
                ->back()
            ->with('success', 'Data aset telah berhasil disimpan.');
        }
        else{
            return redirect()
            ->back()
            ->withErrors([
                'err_msg' => 'Gagal menyimpan aset, hubungi administrator untuk info lebih lanjut.',
            ]);
        }

    }

    public function deleteAsset($id)
    {
    	$asset = Asset::findOrFail($id);
        $asset -> delete();

        if ($asset->trashed()) {
            return redirect()
                ->back()
                ->with('success', 'Data aset telah dihapus');
        }
        else{
            return redirect()
                ->back()
                ->withErrors([
                    'err_msg' => 'Gagal menghapus data aset, hubungi administrator untuk info lebih lanjut',
                ]);
        }
    }

    public function showEditAsset($id)
    {
        $asset = Asset::findOrFail($id);
        $items = AssetItem::all();
        $assetStatus = config('app.asset_status');

        if(\Auth::user() -> staff_position < 6){
            $outlets = Outlet::all();
        }
        else if(\Auth::user() -> staff_position == 6 || \Auth::user() -> staff_position == 8){
            $outlets = Outlet::where('id', \Auth::user() -> outlet_id) -> get();
        }
        else if(\Auth::user() -> staff_position == 7){
            $outlets = Outlet::whereRaw("id in (select id from outlets where partner_id='".\Auth::user() -> partner_id."')") -> get();
        }

        return view('dashboard.asset.edit', compact('outlets', 'items', 'assetStatus', 'asset'));

    }

    public function editAsset(Request $request, $id)
    {
    	$asset = Asset::findOrFail($id);
        $asset -> outlet_id = $request -> outlet_id;
        $asset -> item_id = $request -> item_id;
        $asset -> qty = $request -> qty;
        $asset -> price = $request -> price;
        $asset -> status = $request -> status;
        $asset -> update_by = \Auth::user()->id;

        if($asset -> save()){
            return redirect()
                ->back()
            ->with('success', 'Data aset telah berhasil disimpan.');
        }
        else{
            return redirect()
            ->back()
            ->withErrors([
                'err_msg' => 'Gagal menyimpan aset, hubungi administrator untuk info lebih lanjut.',
            ]);
        }
    }

}