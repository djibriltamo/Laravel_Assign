<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Proposal;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = auth()->user()->conversations()->latest()->get();

        return view('conversations.index', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        return view('conversations.show', compact('conversation'));
    }

    public function confirm()
    {
        $proposal = Proposal::findOrFail(request('proposal'));
        $this->authorize('confirm', $proposal->job);
        $proposal->fill(['validated' => 1]);

        if ($proposal->isDirty()) {

            $proposal->save();

            $to = $proposal->user_id;
            $job = $proposal->job_id;
    
            $conversation = Conversation::create([
                'from' => auth()->user()->id,
                'to' => $to,
                'job_id' => $job
            ]);
    
            Message::create([
                'user_id' => auth()->user()->id,
                'conversation_id' => $conversation->id,
                'content' => "Salut, votre offre a été validé."
            ]);

            return redirect()->route('conversation.show', ['conversation' => $conversation]);
        } else {
            return redirect()->route('home');
        }

    }
}
