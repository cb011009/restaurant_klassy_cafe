<?php

namespace App\Ai;

use Illuminate\Support\Facades\Http;

class Chat
{
    protected array $messages =[]; //intialise to empty array

    public function systemMessage(string $message)
    {
        $this->messages[] = [
            'role'=>"user",
            'content'=>$message
        ];

        return $this;
    }


    public function send(string $messages)//Append to our root messages array
    {
        $this->$messages[]=[ //This->messages push a new array where the role is user and the content is whatever that message happens to be 
             "role" => "user",
            "content"=>$messages
        ];

        //now we need to send the API request, 
        $response =Http::withToken(config('services.openai.secret'))
            ->post('https://api.openai.com/v1/chat/completions', 
                [
                    "model" => "gpt-3.5-turbo",
                    "messages" => $this->$messages
                ])->json('choices.0.message.content');

         //And the subsseqeunt response should also be appended to the messages


        if($response){
            $this->messages[] = [
                "role"=>"assistant",
                "content"=> $response
            ];
    

        }
        
        return $response;
    }

    public function reply(string $message):? string 
    {
        return $this->send($message);
    }


    public function messages()//just a getter that will return a messages array
    {
        return $this->messages;
    }

   
    
}

//$chat->message() give me all the messages in the chat
//$chat->message() send a new message
