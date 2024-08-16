<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Website;
use App\Models\Niche;
use App\Models\Action;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $clean = $request->get('clean');

        $name = $request->get('name');
        $traffic = $request->get('traffic');
        $da = $request->get('da');
        $dr = $request->get('dr');
        $niche = $request->get('niche');

        $websites = [];

        if($name == NULL && $traffic == NULL && $da == NULL && $dr == NULL && $niche == NULL)
        {
            if($clean != NULL && $clean == "false")
            {
                $websites = Website::all();
            }
        }
        else
        {
            $query = Website::query();
            $newquery = NULL;

            if($name != NULL)
            {
                $newquery = $query->where('name', 'like', '%'. $name .'%');
                $query = $newquery;
            }

            if($traffic != NULL)
            {
                $newquery = $query->where('traffic', 'like', '%'. $traffic .'%');
                $query = $newquery;
            }

            if($da != NULL)
            {
                $newquery = $query->where('da', 'like', '%'. $da .'%');
                $query = $newquery;
            }

            if($dr != NULL)
            {
                $newquery = $query->where('dr', 'like', '%'. $dr .'%');
                $query = $newquery;
            }

            if($niche != NULL)
            {
                $newquery = $query->where('niche', '=', $niche);
                $query = $newquery;
            }

            $websites = $query->get();
        }
        $niche = new Niche();
        $niches = $niche->list;
        return view('dashboard', compact(['websites', 'niches']));
    }

    public function actions(Request $request)
    {
        $id = Auth::user()->id;

        $model = Action::create([
            'act' => $request->get('act'),
            'user_id' => $id,
            'website_id' => $request->get('website_id')
        ]);
        $model->save();
        return true;
    }
}
?>