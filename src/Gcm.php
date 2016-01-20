<?php

namespace Sobreira\Gcm;

class Gcm
{
    const URL = 'https://android.googleapis.com/gcm/send';
    const GCM_API_KEY = "Authorization: key=AIzaSyBv9ZKR7s3jRIaDyK2DG1ZT26Id2HMZcvw";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendNote($title, $message, $registration_ids)
    {        

        /*
        $registration_ids = ["eyXnq-FCekQ:APA91bEZ5RXe1YLbk6c_Ox6OhLAzn_HP0HaYCTaDKhYsyJHTFUSvaXQzbg_YJWnGHwEIB2i40pxM4YEQE3hke7-lL3fs6X2NQ_1Ojnm4eRS2b0eLj_VYZCGZ3rethWwZj4QB8_qxhAMC"];
        $message = ["message" => "hello, test!!",
                    "title" => "Test App"];
        */

        $data = ["message" => $message, "title" => $title];

        $fields = [
            'registration_ids' => $registration_ids,
            'data' => $data
        ];

        $headers = [
            self::GCM_API_KEY,
            'Content-Type: application/json'
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        } 
        // Close connection
        curl_close($ch);
        
        return $result;
    }
}
