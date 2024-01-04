<?php

namespace App\Http\Controllers;

use Google\Cloud\Language\LanguageClient;
use Illuminate\Http\Request;
use GuzzleHttp\Client; // Import GuzzleHttp for making HTTP requests

class GoogleBardController extends Controller
{
    public function index()
    {
     return view("chatBot.chat_bard");
    }
    public function processNLP(Request $request)
    {
        $curl = curl_init();
        $example = [
            'contents' => [
                'parts' => [
                    [
                        'text' => $request->input('inputText') ?? 'Write a story about a magic backpack'
                    ]
                ]
            ],
            "generationConfig" => [
                "temperature" => 0.9,
                "topK" => 1,
                "topP" => 1,
                "maxOutputTokens" => 2048,
                "stopSequences" => []
            ],
            "safetySettings" => [
                [
                    "category" => "HARM_CATEGORY_HARASSMENT",
                    "threshold" => "BLOCK_MEDIUM_AND_ABOVE"
                ],
                [
                    "category" => "HARM_CATEGORY_HATE_SPEECH",
                    "threshold" => "BLOCK_MEDIUM_AND_ABOVE"
                ],
                [
                    "category" => "HARM_CATEGORY_SEXUALLY_EXPLICIT",
                    "threshold" => "BLOCK_MEDIUM_AND_ABOVE"
                ],
                [
                    "category" => "HARM_CATEGORY_DANGEROUS_CONTENT",
                    "threshold" => "BLOCK_MEDIUM_AND_ABOVE"
                ]
            ]
        ];
        $data = json_encode($example);
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=AIzaSyAtD_WRNgtCg3VL7ZuDsq_7pVN1TF77kZk", // your preferred link
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: application/json',
                ),
            )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $decode = json_decode($response);
        $result = $decode->candidates[0]->content->parts[0]->text;
        return response()->json(['status' => 'Saved successfully','result' => $result]);

    }
}