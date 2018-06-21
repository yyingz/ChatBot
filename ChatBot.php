<?php
    $accessToken = "Lq8/yqdrOY4yfgWeUAP2rFojWCVox5J2FwhyxRYbQ6quFzDcc8chiA/hdHferUNPKivRIKFmtS43Xfw8uZfsNN/6kg/qiCZt2yF7Ve0+3Yeo+99ke6oEd1Cb5/GcwNDDnfKTIptA1wGdBU+8bmZIPwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    
    $message = $arrayJson['events'][0]['message']['text'];

    switch($message) {
        case "สวัสดี" OR "ดีจ้า" OR "hello" OR "Hello" OR "Hi" OR "hi":
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
            replyMsg($arrayHeader,$arrayPostData);
            break;
        case "เที่ยวไหนดี" OR "ไปเที่ยวกัน" OR "อยากไปเที่ยว"  OR "แนะนำที่เที่ยว" OR "แนะนำสถานที่ท่องเที่ยว":
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "https://map.nostramap.com/NostraMap/?layer/midyear2018,feed/th";
            $arrayPostData['messages'][1]['type'] = "text";
            $arrayPostData['messages'][1]['text'] = "https://map.nostramap.com/NostraMap/?layer/sea2018,feed/th";
            replyMsg($arrayHeader,$arrayPostData);
            break;
        case "หิวจัง" OR "กินไรดี" OR "กินข้าวกัน" OR "หิว" OR "กินอะไรดี" OR "แนะนำร้านอาหาร" OR "restaurant":
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "https://map.nostramap.com/NostraMap/?layer/michelin,feed/th";
            $arrayPostData['messages'][1]['type'] = "text";
            $arrayPostData['messages'][1]['text'] = "https://map.nostramap.com/NostraMap/?layer/wongnai,feed/th";
            replyMsg($arrayHeader,$arrayPostData);
            break;
        case "ดูหนัง" OR "ดูหนังกัน" OR "อยากดูหนัง" OR "movie":
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "http://www.majorcineplex.com/booking2/search_showtime/cinema=1";
            $arrayPostData['messages'][1]['type'] = "text";
            $arrayPostData['messages'][1]['text'] = "https://www.sfcinemacity.com/showtime/cinema/9924";
            replyMsg($arrayHeader,$arrayPostData);
            break;
        case "คิดถึงจัง" OR "คิดถึง" OR "คิดถึงนะ":
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "คิดถึงเหมือนกัน";
            $arrayPostData['messages'][1]['type'] = "sticker";
            $arrayPostData['messages'][1]['packageId'] = "1";
            $arrayPostData['messages'][1]['stickerId'] = "2";
            replyMsg($arrayHeader,$arrayPostData);
            break;
        case "นอน" OR "นอนละ" OR "ง่วง" OR "ฝันดี" OR "ราตรีสวัส" OR "goodnight" OR "Goodnight":
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "จะไปแล้วเหรอ";
            $arrayPostData['messages'][1]['type'] = "sticker";
            $arrayPostData['messages'][1]['packageId'] = "1";
            $arrayPostData['messages'][1]['stickerId'] = "9";
            replyMsg($arrayHeader,$arrayPostData);
            break;
        default:
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "พิมพ์ให้ถูกซิ!!!";
            replyMsg($arrayHeader,$arrayPostData);
            break;
    }

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
