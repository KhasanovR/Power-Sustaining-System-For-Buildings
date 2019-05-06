<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ecg_items;
use App\records;
use App\rank;
use App\User;
use App\building;
use App\select;
use App\best_record;

class RecordController extends Controller
{
    public function calculate(Request $request)
    {
        // dd($request->purchased);
        $building = building::orderBy('created_at','desc')->first();
        $ee = 0;
        foreach ($building->ecg_items as $item) {
            if ($item->energy_type == 'cons') 
                $ee += $item->energy_cg;
            else
                $ee -= $item->energy_cg;
        }

        $jdpurchased = json_decode($request->purchased);
        $jdsold = json_decode($request->purchased);
        foreach($jdpurchased as $purchased)
        {
            if ($purchased->energy_type == 'cons') 
                $ee += $purchased->energy_cg;
            else
                $ee -= $purchased->energy_cg;

                $select = select::firstOrNew([
                'user_id' => auth()->user()->id,
                'ecg_items_id' => $purchased->id,
                'building_season' => $building->season,
                'is_sold' => 0]);
                $select->user_id = auth()->user()->id;
                $select->ecg_items_id = $purchased->id;
                $select->building_season = $building->season;
                $select->is_sold = 0;
                $select->save();
        }
        foreach($jdsold as $sold)
        {
            $ee -= $sold->energy_cg;
            $select = select::firstOrNew([
                'user_id' => auth()->user()->id,
                'ecg_items_id' => $sold->id,
                'building_season' => $building->season,
                'is_sold' => 1]);
                $select->user_id = auth()->user()->id;
                $select->ecg_items_id = $sold->id;
                $select->building_season = $building->season;
                $select->is_sold = 1;
                $select->save();
        }
        
        
        $yor=( $request->purchasing_total - $request->selling_total / 2 ) / ( 
            $ee * $building->price_kw);
        $eepts=$ee*($yor)*($yor);
        $yorpts=$ee/$yor;
        $pts = $eepts+$yorpts;
        // dd(records::all());

        $record = new records;   
        $record->user_id = auth()->user()->id;
        $record->economed_energy = $ee;
        $record->year_of_return = 1+$yor;
        $record->left_money = $request->left_money;
        $record->pts = $pts;
        $record->save();
        
        // dd(auth()->user()->best_record->record->pts);
        if(empty(auth()->user()->best_record) || $pts > auth()->user()->best_record->record->pts)
        {

            $br = new best_record;
            $br->user_id = auth()->user()->id;
            $br->rec_id = $record->id;
            $br->save(); 

            $rank = rank::firstOrNew([
                // 'rank_no' => $pts,
                'user_id' => auth()->user()->id]);
            $rank->rank_no = $pts;
            $rank->rec_id = $record->id;
            $rank->user_id = auth()->user()->id;
            // dd($rank);
            $rank->save();  

        }
        return back()->with('success','New Record Added with '.$record->pts.'  pts');
    }
}
