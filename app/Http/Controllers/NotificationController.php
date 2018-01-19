<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Response;
use App;
use Exception;

class NotificationController extends Controller
{
    public function iosPushNotification($body_text,$notification_type,$tokens,$id)
    {   
        /*$passphrase = '';
        $pem_file = base_path() . '/app/rfebe.pem';
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $pem_file);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        
        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp){
            return false;
        }
        $body_ar = $body_text;

        if($notification_type == 2){
            $body['aps'] = array(
                'alert' => $body_text['userName'].' '.$body_text['type'],
                'sound' => 'default',
            ); 
        }

        if($notification_type == 1){
            $body['aps'] = array(
                'alert' => $body_text['userName'].' '.$body_text['type'],
                'sound' => '',
            ); 
        }
        
        $body['data'] = $body_text;        
        $payload = json_encode($body);
        for ($i=0; $i < count($tokens); $i++) {
            $msg = chr(0) . pack('n', 32) . pack('H*', $tokens[$i]) . pack('n', strlen($payload)) . $payload;
            $result = fwrite($fp, $msg, strlen($msg));
        }
        if (!isset($result)){
            return false;
        }
        fclose($fp);
        return true;*/


        $url = "https://fcm.googleapis.com/fcm/send";
        $token = $tokens[0];
        $serverKey = 'AIzaSyDQsqj3rxWpA7SAHLwziaVmaYJr0b_8m9o';
        $title = "Title";
        $body = "Body of the message";
        // $notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1');
        $notification = array('text' => $body, 'sound' => 'default');
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,

        "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        //Send the request
        $response = curl_exec($ch);
        //Close request
        // dd($response);
        
        curl_close($ch);
        if ($response === FALSE) {
            return 0;
            // die('FCM Send Error: ' . curl_error($ch));
        }else{
            return 1;
        }


    }

    public function androidPushNotification($body_text,$notification_type,$tokens,$id)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array (
                'Authorization: key=' . "AAAAkhPTIU8:APA91bFBZlh2VDqNzep5g73aXOWuyV2vP43Rd5xc5FVTpG9gPavRAUhvgqLZncKVEEO9Yo2AZM9RoJfiPCBIE-RiQcs8TLDPk3lsMnQM5swYCm1i17pVzixZxyVBMk-bDi1nk2xHPuFZ",
                'Content-Type: application/json'
        );
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        $fields = array (
            // 'to' => $tokens, 
            'to' => 'dwsRUpyO7tQ:APA91bHTUpfIiGk6Kn2OSxmpMpjXcYevwr4vbzACBTJbPQz5DXH66X92uU6mGQ1Ltdn1go_foAzWl0_vlbjXxjvmm4CEHR9iGFCwLGHbqFE2UcgVAa-IdA_InTOrLBOfgQjkve5awWd4',               
            'data' => array (
                    "message" => $body_text
            )
        );
        $fields = json_encode ( $fields );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        $result = curl_exec ( $ch );

        if(curl_error($ch))
        {
            echo 'error:' . curl_error($ch);exit();
        }
        $json = json_decode($result, true);
        // dd($json);

        if($json['success']){
            $status=1;
        }
        curl_close ( $ch );

        if($json['success']){
            return 1;
        } else {
            return 0;
        }
    }
}

   