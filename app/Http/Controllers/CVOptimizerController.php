<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OpenAI\Laravel\Facades\OpenAI;

class CVOptimizerController extends Controller
{
    public function index(Request $request)
    {
        $latestCv = $request->user()->cvs()->latest()->first();

        if ($latestCv) {
            $otherCvs = $request->user()
                ->cvs()
                ->where('id', '!=', $latestCv->id)
                ->latest()
                ->paginate(10)->withQueryString();
        } else {
            $otherCvs = collect();
        }

        return inertia('CV/Index', ['latestCv' => $latestCv, 'otherCvs' => $otherCvs]);
    }

    public function show(Cv $cv)
    {
        $cv->original_cv_path = Storage::disk('public')->url($cv->original_cv_path);

        return inertia('CV/Show', ['cv' => $cv]);

    }

    public function create(Request $request)
    {

        return inertia('CV/Create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $path = $request->file('cv')->store('cvs', 'public');

        $text = extractTextFromCv($path);

        if (! $text) {
            return response()->json(['error' => 'Unable to extract text.'], 422);
        }

        // ✅ Proper OpenAI client with timeout
        $client = \OpenAI::factory()
            ->withApiKey(env('OPENAI_API_KEY'))
            ->withHttpClient(new \GuzzleHttp\Client([
                'timeout' => 120,          // wait up to 2 minutes
                'connect_timeout' => 30,   // connection timeout
            ]))
            ->make();

        // Call OpenAI for evaluation
        $response = $client->chat()->create([
            'model' => 'gpt-4-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a professional career coach and resume expert.',
                ],
                [
                    'role' => 'user',
                    'content' => "Here is a CV:\n\n$text\n\nPlease analyze it and respond with:\n
            1. A score out of 100\n
            2. 8-10 recommendations to improve it\n
            3. An optimized version of the CV (in plain text only, no markdown, no page numbers, no code blocks).",
                ],
            ],
            'temperature' => 0,
            'max_tokens' => 1500,
        ]);

        $aiReply = $response->choices[0]->message->content;

        // Parse score (more reliable regex)
        preg_match('/\b([0-9]{1,3})\s*\/?\s*100?\b/', $aiReply, $matches);
        $score = isset($matches[1]) ? min(100, (int) $matches[1]) : null;

        $cv = Cv::create([
            'user_id' => $request->user()->id,
            'original_cv_path' => $path,
            'optimized_cv_path' => null, // You can save optimized text separately
            'score' => $score,
            'recommendation' => $aiReply,
        ]);

        return redirect(route('cv.show', ['cv' => $cv]))->with('success', 'CV Optimized');

    }

    public function destroy(Cv $cv)
    {

        $cv->delete();

        return redirect(route('cv.index'))->with('success', 'CV deleted');
    }
}
