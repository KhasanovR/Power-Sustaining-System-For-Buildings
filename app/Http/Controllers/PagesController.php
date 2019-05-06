<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\level;
use App\rank;
use App\ecg_items;
use App\building;

class PagesController extends Controller
{
	public function home()
	{
	    return view('pages.home');		
	}

	public function play()
	{
		return view('pages.play');
	}

    public function statistics()
    {
        $levels = level::orderBy('level_no', 'desc')->get();
        $ranks = rank::orderBy('rank_no', 'desc')->get();
        return view('pages.statistics')->with('levels', $levels)->with('ranks', $ranks);
    }

    public function guide()
    {
//        example
        $items=rank::orderBy('rank_no', 'asc')->get();
        return view ('pages.guide')->with('items',$items);
    }

    public function shop()
    {
//        example
        $items=ecg_items::orderBy('id', 'asc')->get();
        $building = building::orderBy('created_at','desc')->first();
        return view ('pages.shop')->with('items',$items)->with('building',$building);
    }
    public function constructor()
    {
        return view ('pages.constructor');
    }
}
