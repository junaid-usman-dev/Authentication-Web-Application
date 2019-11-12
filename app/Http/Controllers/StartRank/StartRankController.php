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
        $allStartRanks = StartRank::orderBy('star','DESC')->get();
        // $allStartRanks = StartRank::orderBy('created_at', 'ASC')->get();
        // $allStartRanks = StartRank::orderBy('star','DESC')->orderBy('like','DESC')->groupBy('created_at')->get();
        // $allStartRanks = StartRank::all()->sortBy('created_at')->get();
            
        // dd($allStartRanks->pluck('created_at'));
        // $allStartRanks = $allStartRanks->created_at()->format('F')->get();
        return view ('c2c/all-start-ranking')->with('allStartRanks',$allStartRanks);
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
            'star' => 'nullable',
        ]);

        $username = $request->input('username');
        $description = $request->input('description');
        $like = $request->input('like');
        $dislike = $request->input('dislike');
        $picture = $request->file('picture');
        $star = $request->input('star');

        $starrank = new StartRank();
        
        $starrank->username = $username;
        $starrank->description = $description; 
        $starrank->like = $like;
        $starrank->dislike = $dislike;

        $file_name = $picture->getClientOriginalName();
        $file_path = $picture->move('storage/startrank',$file_name);
        $starrank->picture = $file_path;

        $starrank->star = $star;            

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
        return view ('c2c/week-start-ranking')->with('thisWeekStartRanks',$thisWeekStartRanks);
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
        // $thisMonthStartRanks = StartRank::whereMonth('updated_at', $thisMonth)->orderBy('star','DESC')->orderBy('like', 'DESC')->get();
        $thisMonthStartRanks = StartRank::orderBy('star','DESC')->orderBy('updated_at', 'ASC')->get();
        // dd($thisMonthStartRanks->pluck('updated_at'));
        // $thisMonthStartRanks = StartRank::orderBy('star','DESC')->orderBy('like', 'DESC')->get();
        return view ('c2c/start-ranking')->with('thisMonthStartRanks',$thisMonthStartRanks);
    }
}
