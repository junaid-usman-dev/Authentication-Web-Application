<?php

namespace App\Http\Controllers\StartRank;

use App\Http\Controllers\Controller;
use App\StartRank;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StartRankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $thisMonth = date("m");
        $thisMonthStartRanks = StartRank::whereMonth('updated_at', $thisMonth)->get();
        
        return view ('c2c/start-ranking')->with('thisMonthStartRanks',$thisMonthStartRanks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('startrank/create-startrank');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'username' => 'required',
            'description' => 'required',
            'like' => 'nullable',
            'dislike' => 'nullable',
            // 'picture' => 'image|mimes:jpeg,png,jpg|max:2048'
            'picture' => 'nullable',
        ]);

        $username = $request->input('username');
        $description = $request->input('description');
        $like = $request->input('like');
        $dislike = $request->input('dislike');
        $picture = $request->file('picture');

        $starrank = new StartRank();
        
        $starrank->username = $username;
        $starrank->description = $description; 
        $starrank->like = $like;
        $starrank->dislike = $dislike;

        $file_name = $picture->getClientOriginalName();
        $file_path = $picture->move('storage/startrank',$file_name);
        $starrank->picture = $file_path;

        $starrank->save();

        // return ("Stored");
        return redirect('start-ranking');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StartRank  $startRank
     * @return \Illuminate\Http\Response
     */
    public function show(StartRank $startRank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StartRank  $starRank
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        $startrank = StartRank::findOrFail($id);
        // return ("Found");
        return view("startrank/edit-startrank")->with(['startrank'=>$startrank, 'id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'username' => 'required',
            'description' => 'required',
            'like' => 'nullable',
            'dislike' => 'nullable',
            // 'picture' => 'image|mimes:jpeg,png,jpg|max:2048'
            'picture' => 'nullable',
        ]);
        
        $username = $request->input('username');
        $description = $request->input('description');
        $like = $request->input('like');
        $dislike = $request->input('dislike');
        $id = $request->input('id');
        
        // $startrank = StartRank::findOrFail($id);
        $startrank = StartRank::where('id',$id)->first();
        // dd($startrank);
        $startrank->username = $username;
        $startrank->description = $description; 
        
        if ($request->hasFile('picture'))
        {
            $picture = $request->file('picture');
            $file_name = $picture->getClientOriginalName();
            $file_path = $picture->move('storage/startrank',$file_name);
            $startrank->picture = $file_path;
        }

        $startrank->like = $like; 
        $startrank->dislike = $dislike;
        
        $startrank->save();

        return redirect('start-ranking');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StartRank  $startRank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $startrank = StartRank::findOrFail($id)->delete();
        return ("Deleted");
    }

    /**
     * Display only current week resources.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function ThisWeek()
    {
        //
        $thisWeekStartRanks = StartRank::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        dd($thisWeekStartRanks->pluck('updated_at'));
        // return view ('c2c/start-ranking')->with('thisMonthStartRanks',$thisMonthStartRanks);
    }

    /**
     * Display only current month resources
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function ThisMonth()
    {
        //
        $thisMonth = date("m");
        $thisMonthStartRanks = StartRank::whereMonth('updated_at', $thisMonth)->get();
        // $starranks = StarRank::all();
        // dd($thisMonthStartRank);
        return view ('c2c/start-ranking')->with('thisMonthStartRanks',$thisMonthStartRanks);
    }
}
