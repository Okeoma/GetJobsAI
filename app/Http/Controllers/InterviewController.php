<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class InterviewController extends Controller
{
    public function index()
    {
        return Inertia('Interview/Index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string',
            'job_description' => 'required|string',
        ]);

        $jobTitle = $request->input('job_title');
        $jobDescription = $request->input('job_description');

        // Call OpenAI to generate interview questions
        $response = OpenAI::chat()->create([
            'model' => 'gpt-4-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a professional interviewer.',
                ],
                [
                    'role' => 'user',
                    'content' => "Create 3 interview questions for a job titled '$jobTitle' with description '$jobDescription'. Return as an array.",
                ],
            ],
        ]);

        $questionsText = $response['choices'][0]['message']['content'];
        $questions = json_decode($questionsText, true); // Make sure the response is JSON array

        return Inertia('Interview/Create', [
            'jobTitle' => $jobTitle,
            'jobDescription' => $jobDescription,
            'questions' => $questions,
        ]);
    }

    public function store(Request $request)
    {

        // $request->validate([
        //     'recording' => 'required|file|mimes:webm,mp4,mov,avi|max:50000',
        //     'job_title' => 'required|string',
        //     'questions' => 'required|array',
        // ]);

        // $jobTitle = $request->input('job_title');
        // $questions = $request->input('questions');

        // $videoFile = $request->file('recording');
        // $audioPath = storage_path('app/' . $videoFile->getClientOriginalName());

        // // Save temporarily
        // $videoFile->move(storage_path('app'), $videoFile->getClientOriginalName());

        // // 🔹 Transcribe with Whisper
        // $transcription = OpenAI::audio()->transcribe([
        //     'model' => 'whisper-1',
        //     'file'  => fopen($audioPath, 'r'),
        // ]);

        // $answerText = $transcription->text;

        // // 🔹 Ask GPT to split answers by question + score
        // $scoring = OpenAI::chat()->create([
        //     'model' => 'gpt-4-turbo',
        //     'messages' => [
        //         [
        //             'role' => 'system',
        //             'content' => 'You are a recruiter evaluating structured interview answers.'
        //         ],
        //         [
        //             'role' => 'user',
        //             'content' =>
        //                 "Job Title: $jobTitle\n" .
        //                 "Questions: " . json_encode($questions) . "\n" .
        //                 "Candidate Transcript: $answerText\n\n" .
        //                 "1. Split the candidate transcript into separate answers that best match each question.\n" .
        //                 "2. Score the candidate overall from 0 to 100.\n" .
        //                 "3. Provide ideal sample answers for each question.\n" .
        //                 "Return JSON ONLY in this format:\n" .
        //                 "{ \"answers\": [\"candidate answer 1\", \"candidate answer 2\"], \"score\": 85, \"ideal_answers\": [\"ideal1\", \"ideal2\"] }"
        //         ],
        //     ],
        // ]);

        // $result = $scoring['choices'][0]['message']['content'];
        // $parsed = json_decode($result, true);

        // // 🔹 Safe parsing
        // $answers = $parsed['answers'] ?? [$answerText];
        // $score = $parsed['score'] ?? intval(preg_replace('/\D/', '', $result));
        // $idealAnswers = $parsed['ideal_answers'] ?? [];

        // // 🔹 Add numbering
        // $numberedQuestions = array_map(fn($q, $i) => ($i + 1) . '. ' . $q, $questions, array_keys($questions));
        // $numberedAnswers = array_map(fn($a, $i) => ($i + 1) . '. ' . $a, $answers, array_keys($answers));
        // $numberedIdealAnswers = array_map(fn($a, $i) => ($i + 1) . '. ' . $a, $idealAnswers, array_keys($idealAnswers));

        // // 🔹 Save
        // $request->user()->interviews()->create([
        //     'job_title'    => $jobTitle,
        //     'questions'    => json_encode($numberedQuestions),
        //     'answer'       => json_encode($numberedAnswers),
        //     'score'        => $score,
        //     'ideal_answer' => json_encode($numberedIdealAnswers),
        // ]);

        // return redirect(route('dashboard.index'))->with('success', 'Interview completed');

        $request->validate([
            'recordings' => 'required|array',
            'recordings.*' => 'file|mimes:webm,mp4,mov,avi|max:50000',
            'job_title' => 'required|string',
            'questions' => 'required|array',
        ]);

        $jobTitle = $request->input('job_title');
        $questions = $request->input('questions');
        $answers = [];

        // Ensure questions is an array
        if (! is_array($questions)) {
            $questions = json_decode($questions, true) ?? (array) $questions;
        }

        $uploaded = $request->file('recordings');
        if (! is_array($uploaded)) {
            $uploaded = [$uploaded];
        }

        foreach ($uploaded as $videoFile) {
            // 🔹 Save temporarily in a known location
            $tempPath = storage_path('app/interviews/'.$videoFile->getClientOriginalName());
            $videoFile->move(storage_path('app/interviews'), $videoFile->getClientOriginalName());

            // Transcribe using Whisper
            $transcription = OpenAI::audio()->transcribe([
                'model' => 'whisper-1',
                'file' => fopen($tempPath, 'r'),
            ]);

            $transcriptText = is_array($transcription)
                ? ($transcription['text'] ?? '')
                : ($transcription->text ?? '');

            $answers[] = trim($transcriptText) === '' ? 'No audio/text detected.' : trim($transcriptText);

            // Delete temp file after transcription
            if (file_exists($tempPath)) {
                @unlink($tempPath);
            }
        }

        // GPT scoring & ideal answers
        $prompt = "Job Title: {$jobTitle}\nQuestions: ".json_encode($questions).
                  "\n\nCandidate Answers: ".json_encode($answers)."\n\n".
                  "1) Provide an overall score from 0 to 100 (integer).\n".
                  "2) Provide an array of ideal/sample answers for each question.\n\n".
                  "Return JSON ONLY in this format:\n".
                  '{"score": 85, "ideal_answers": ["ideal1", "ideal2", "ideal3"]}';

        $scoringResp = OpenAI::chat()->create([
            'model' => 'gpt-4-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a fair, structured recruiter evaluator.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.2,
            'max_tokens' => 800,
        ]);

        $raw = $scoringResp['choices'][0]['message']['content'] ?? '';
        $parsed = json_decode($raw, true);

        // Try to extract JSON if decoding failed
        if (! is_array($parsed) && preg_match('/\{.*\}/s', $raw, $m)) {
            $parsed = json_decode($m[0], true);
        }
        $parsed = is_array($parsed) ? $parsed : [];

        $score = isset($parsed['score']) ? intval($parsed['score']) : ((int) preg_replace('/\D+/', '', $raw) ?: null);
        $idealAnswers = $parsed['ideal_answers'] ?? [];

        if (! is_array($idealAnswers)) {
            $idealAnswers = $idealAnswers ? (array) $idealAnswers : [];
        }

        // Numbering
        $numberedQuestions = array_map(fn ($q, $i) => ($i + 1).'. '.$q, $questions, array_keys($questions));
        $numberedAnswers = array_map(fn ($a, $i) => ($i + 1).'. '.$a, $answers, array_keys($answers));
        $numberedIdealAnswers = array_map(fn ($a, $i) => ($i + 1).'. '.$a, $idealAnswers, array_keys($idealAnswers));

        // Save to DB
        $interview = $request->user()->interviews()->create([
            'job_title' => $jobTitle,
            'questions' => json_encode($numberedQuestions, JSON_PRETTY_PRINT),
            'answer' => json_encode($numberedAnswers, JSON_PRETTY_PRINT),
            'ideal_answer' => json_encode($numberedIdealAnswers, JSON_PRETTY_PRINT),
            'score' => $score,
        ]);

        return redirect(route('dashboard.index'))->with('success', 'Interview completed and saved.');
    }
}
