<?php
namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadRepository
{
    /*
    *
    */
	public function index()
    {
        return Thread::with(['user:id,name', 'channel:id,name,slug'])->where('flag', 1)->latest()->paginate(10);
    }

    /*
	*
	*/
	public function show($slug)
    {
    	return Thread::where('slug', $slug)->where('flag', 1)->first();
    }

    //
    public function store(Request $request)
    {
        $thread = new Thread;
        $thread->title = $request->title;
        $thread->slug = Str::slug($request->title);
        $thread->content = $request->content;
        $thread->channel_id = $request->channel_id;
        auth()->user()->threads($thread);
    }

    //
    public function update(Request $request, Thread $thread)
    {
        
        if ( $request->has('best_answer_id') ) {
            $thread->best_answer_id = $request->best_answer_id;   
        } else {
            $thread->title = $request->title;
            $thread->slug = Str::slug($request->title);
            $thread->content = $request->content;
            $thread->channel_id = $request->channel_id;
        }

        $thread->update();
    }

    //
    public function delete(Thread $thread)
    {
        $thread->delete();
    }

    //
    public function find($id)
    {
        return Thread::find($id);
    }
}