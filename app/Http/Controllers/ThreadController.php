<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Thread;
use App\ThreadFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
    public function index(ThreadFilters $filters)
    {

        $threads = Thread::filter($filters)->paginate(10);
        return view('thread.index', compact('threads'));
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
        // dd($request);
        //
        $tags = $request->tags;
        foreach ($tags as $key => $tag) {
            if (!is_numeric($tag)) {
                $tags[$key] = Tag::create(['name' => $tag])->id;
            } else {
                if (Tag::where('name', '=', $tag)->count() < 1) {
                    $tags[$key] = Tag::create(['name' => $tag])->id;
                }
            }
        }

        $this->validate($request, [
            'subject' => 'required|min:5',
            'tags' => 'required',
            'thread' => 'required|min:10',
//            'g-recaptcha-response' => 'required|captcha'
        ]);

        //store
        $thread = auth()->user()->threads()->create($request->all());
        $thread->tags()->attach($tags);
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
        $this->authorize('update', $thread);

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
        $this->authorize('update', $thread);

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
        $this->authorize('update', $thread);

        $thread->delete();

        return redirect()->route('threads.index')->withMessage('Thread Deleted');
    }

    /**
     * [markAsSolution description]
     * @return [type] [description]
     */
    public function markAsSolution()
    {
        $solutionId = Input::get('solutionId');
        $threadId = Input::get('threadId');
        $thread = Thread::find($threadId);

        $this->authorize('update', $thread);

        $thread->solution = $solutionId;
        if ($thread->save()) {
            if (request()->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'marked as solution']);
            }
            return back()->withMessage('Marked as solution');
        }
    }

    public function search()
    {
        $search = request('query');

        $threads = Thread::with('tags')
            ->where('subject', 'Like', '%' . $search . '%')
            ->orWhereHas('tags', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        // dd($threads);

        // $threads = $threads->tags()->where('tag.name', $search)->get();
        // ->join('')
        // ->where('tags.name', 'LIKE', $query)
        // ->orWhere('subject', 'LIKE', $query)
        // ->get();

        return view('thread.index', compact('threads'));

    }
}
