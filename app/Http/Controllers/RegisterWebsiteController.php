<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Website;
use App\Models\Action;
use App\Models\Niche;

class RegisterWebsiteController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $niche = new Niche();
        $niches = $niche->list;

        $websites = Website::where('user_id', '=', $id)->get();
        return view('registerwebsite.index', compact(['websites', 'niches']));
    }

    public function delete($id)
    {
        $website = Website::find($id);
        $website->delete();
        return redirect('registerwebsite');
    }

    public function create()
    {
        $niche = new Niche();
        $niches = $niche->list;
        return view('registerwebsite.create', compact('niches'));
    }

    public function save(Request $request)
    {
        $id = Auth::user()->id;

        $website = Website::create([
            'name' => $request->get('name'),
            'url' => $request->get('url'),
            'traffic' => $request->get('traffic'),
            'da' => $request->get('da'),
            'dr' => $request->get('dr'),
            'spam' => $request->get('spam'),
            'trafficsprint' => $request->get('trafficsprint'),
            'niche' => $request->get('niche'),
            'contact' => $request->get('contact'),
            'email' => $request->get('email'),
            'user_id' => $id
        ]);
        $website->save();
        return redirect('dashboard');
    }

    public function edit($id)
    {
        $niche = new Niche();
        $niches = $niche->list;

        $website = Website::find($id);
        return view('registerwebsite.edit', compact(['website', 'niches']));
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $website = Website::find($request->get('id'));

        $website->update([
            'name' => $request->get('name'),
            'url' => $request->get('url'),
            'traffic' => $request->get('traffic'),
            'da' => $request->get('da'),
            'dr' => $request->get('dr'),
            'spam' => $request->get('spam'),
            'trafficsprint' => $request->get('trafficsprint'),
            'niche' => $request->get('niche'),
            'contact' => $request->get('contact'),
            'email' => $request->get('email'),
            'user_id' => $id
        ]);

        return redirect('registerwebsite');
    }

    public function km($id)
    {
        $month = date('m');

        $qty_links = Action::where('website_id', '=', $id)
            ->whereMonth('created_at', $month)
            ->count();
        return $qty_links;
    }

    public function getname($id)
    {
        $model = Website::find($id);
        return ($model != null) ? $model->name : '';
    }
}
?>