<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Website;
use App\Models\Competitor;
use App\Models\Action;
use App\Models\Niche;

class MonitoringController extends Controller
{
    public function index($id = null)
    {
        $user_id = Auth::user()->id;

        $niche = new Niche();
        $niches = $niche->list;
        
        $month = date('m');

        $months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

        $name_month = $months[($month-1)];

        $websites = Website::where('user_id', '=', $user_id)->get();

        $website_selected = null;
        $qty_links = null;

        if($id != null){
            $website_selected = Website::find($id);
            $qty_links = Action::where('user_id', '=', $user_id)
            ->where('website_id', '=', $website_selected->id)
            ->whereMonth('created_at', $month)
            ->count();
        }


        $competitors = Competitor::where('user_id', '=', $user_id)
        ->whereMonth('created_at', $month)
        ->get();
        return view('monitoring.index', compact([
            'websites', 'competitors', 'niches', 'website_selected', 'name_month', 'qty_links'
        ]));
    }

    public function competitorscreate(Request $request)
    {
        $niche = new Niche();
        $niches = $niche->list;

        $site_selected = $request->get('site_selected');
        
        $websites = Website::whereNot('id', '=', $site_selected)->select('id', 'name')->get();
        return view('monitoring.competitors_create', compact(['niches', 'websites']));
    }

    public function competitorssave(Request $request)
    {
        $id = Auth::user()->id;

        $competitor = Competitor::create([
            'name' => $request->get('name'),
            'url' => $request->get('url'),
            'niche' => $request->get('niche'),
            'start_km' => $request->get('start_km'),
            'website_id' => $request->get('website_id'),
            'user_id' => $id
        ]);
        $competitor->save();
        return redirect('monitoring');
    }

    public function competitorsedit($id)
    {
        $niche = new Niche();
        $niches = $niche->list;

        $websites = Website::select('id', 'name')->get();
        
        $competitor = Competitor::find($id);
        return view('monitoring.competitors_edit', compact(['competitor','niches','websites']));
    }

    public function competitorsdelete($id)
    {
        $competitor = Competitor::find($id);
        $competitor->delete();
        return redirect('monitoring');
    }

    public function competitorsupdate(Request $request)
    {
        $id = Auth::user()->id;

        $competitor = Competitor::find($request->get('id'));

        $competitor->update([
            'id' => $request->get('id'),
            'name' => $request->get('name'),
            'url' => $request->get('url'),
            'niche' => $request->get('niche'),
            'start_km' => $request->get('start_km'),
            'website_id' => $request->get('website_id'),
            'user_id' => $id
        ]);
        return redirect('monitoring');
    }

    public function save(Request $request)
    {
        return view('monitoring.save');
    }
}
?>