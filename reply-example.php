<?php
    $accessToken = "Lq8/yqdrOY4yfgWeUAP2rFojWCVox5J2FwhyxRYbQ6quFzDcc8chiA/hdHferUNPKivRIKFmtS43Xfw8uZfsNN/6kg/qiCZt2yF7Ve0+3Yeo+99ke6oEd1Cb5/GcwNDDnfKTIptA1wGdBU+8bmZIPwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    $typeMessage = $events['events'][0]['message']['type'];
    $message = $arrayJson['events'][0]['message']['text'];

    switch ($typeMessage){
        case 'text':
            switch ($message) {
                case "A":
                    $textReplyMessage = "คุณพิมพ์ A";
                    break;
                case "B":
                    $textReplyMessage = "คุณพิมพ์ B";
                    break;
                default:
                    $textReplyMessage = " คุณไม่ได้พิมพ์ A และ B";
                    break;                                      
            }
            break;
        default:
            $textReplyMessage = json_encode($events);
            break;  
    }
#ตัวอย่าง Message Type "Text"
    // if($message == "สวัสดี"){
    //     $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    //     $arrayPostData['messages'][0]['type'] = "text";
    //     $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
    //     replyMsg($arrayHeader,$arrayPostData);
    // }
    // else if($message == "Travel"){
    //     $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    //     $arrayPostData['messages'][0]['type'] = "text";
    //     $arrayPostData['messages'][0]['text'] = "https://map.nostramap.com/NostraMap/?layer/midyear2018,feed/th";
    //     $arrayPostData['messages'][1]['type'] = "text";
    //     $arrayPostData['messages'][1]['text'] = "https://map.nostramap.com/NostraMap/?layer/sea2018,feed/th";
    //     replyMsg($arrayHeader,$arrayPostData);
    // }
    // else if($message == "แนะนำร้านอาหาร"){
    //     $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    //     $arrayPostData['messages'][0]['type'] = "text";
    //     $arrayPostData['messages'][0]['text'] = "https://map.nostramap.com/NostraMap/?layer/michelin,feed/th";
    //     replyMsg($arrayHeader,$arrayPostData);
    // }
    // #ตัวอย่าง Message Type "Sticker"
    // else if($message == "ฝันดี"){
    //     $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    //     $arrayPostData['messages'][0]['type'] = "sticker";
    //     $arrayPostData['messages'][0]['packageId'] = "2";
    //     $arrayPostData['messages'][0]['stickerId'] = "46";
    //     replyMsg($arrayHeader,$arrayPostData);
    // }
    // #ตัวอย่าง Message Type "Image"
    // else if($message == "รูปน้องแมว"){
    //     $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
    //     $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    //     $arrayPostData['messages'][0]['type'] = "image";
    //     $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
    //     $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
    //     replyMsg($arrayHeader,$arrayPostData);
    // }
    // #ตัวอย่าง Message Type "Location"
    // else if($message == "พิกัดสยามพารากอน"){
    //     $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    //     $arrayPostData['messages'][0]['type'] = "location";
    //     $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
    //     $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
    //     $arrayPostData['messages'][0]['latitude'] = "13.7465354";
    //     $arrayPostData['messages'][0]['longitude'] = "100.532752";
    //     replyMsg($arrayHeader,$arrayPostData);
    // }
    // #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
    // else if($message == "ลาก่อน"){
    //     $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    //     $arrayPostData['messages'][0]['type'] = "text";
    //     $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
    //     $arrayPostData['messages'][1]['type'] = "sticker";
    //     $arrayPostData['messages'][1]['packageId'] = "1";
    //     $arrayPostData['messages'][1]['stickerId'] = "131";
    //     replyMsg($arrayHeader,$arrayPostData);
    // }
function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>
