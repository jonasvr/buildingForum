<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * show threads
     *
     *
     * @return [type] [description]
     */
    public function index()
    {
        $threads = Thread::paginate(15);

        return view("thread.index", compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("thread.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //valdidate
        $this->validate($request, [
            'subject' => 'required|min:5',
            'type' => 'required',
            'thread' => 'required|min:10',
//            'g-recaptcha-response' => 'required|captcha'
        ]);

        //store
        auth()->user()->threads()->create($request->all());

        // $thread->tags()->attach($request->tags);

        //redirect
        return back()->withMessage('Thread Created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        return view('thread.single', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        if (auth()->user()->id !== $thread->user_id) {
            abort(401, "unauthorized");
        }

        return view('thread.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        if (auth()->user()->id !== $thread->user_id) {
            abort(401, "unauthorized");
        }

        //valdidate
        $this->validate($request, [
            'subject' => 'required|min:5',
            'type' => 'required',
            'thread' => 'required|min:10',
//            'g-recaptcha-response' => 'required|captcha'
        ]);

        //Update
        $thread->update($request->all());

        return redirect()->route('threads.show', $thread->id)->withMessage("Thread Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {

        if (auth()->user()->id !== $thread->user_id) {
            abort(401, "unauthorized");
        }

        $thread->delete();

        return redirect()->route('thread.index')->withMessage('Thread Deleted');
    }
}
