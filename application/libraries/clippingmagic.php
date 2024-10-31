<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Clippingmagic Library for CodeIgniter 
 */

class Clippingmagic{

    function ClippingMagicRemoveBG ($image,$Authorization,$savePath){
       
        $ch = curl_init('https://clippingmagic.com/api/v1/images');

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array('Authorization: Basic '.$Authorization));
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            array(
            'image.url' => $image,
            'format' => 'result',
            'test' => 'true' // TODO: Remove for production
            // TODO: Add more upload options here
            ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // Parse the headers to get the image id & secret
        $headers = [];
        curl_setopt($ch, CURLOPT_HEADERFUNCTION,
        function($curl, $header) use (&$headers) {
            $len = strlen($header);
            $header = explode(':', $header, 2);
            if (count($header) < 2) // ignore invalid headers
            return $len;
            $headers[strtolower(trim($header[0]))][] = trim($header[1]);
            return $len;
        });

        $data = curl_exec($ch);

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {

            $imageId = $headers['x-amz-meta-id'][0];
            $imageSecret = $headers['x-amz-meta-secret'][0];

            $temp_url = explode('uploads',$savePath);
            $url = base_url().'uploads'.$temp_url[1];

            file_put_contents($savePath, $data);

            $res = array('status'=> 200,'data'=> $data,'imageId'=>$imageId,'imageSecret'=>$imageSecret,'url'=>$url);

        } else {
            $error =  json_decode($data,true);
            $res = array('status'=> $error['error']['status'],'message'=>$error['error']['message'],'data'=>'','imageId'=>'','imageSecret'=>'');
        }
       
        curl_close($ch);
        return $res;       
    }    
}
?>