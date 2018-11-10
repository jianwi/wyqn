<?php
/*
 * @Author: DuJianjun
 * @Date: 2018-06-16 10:44:15
 * @Last Modified by: jianwi.cn
 * @Last Modified time: 2018-06-17 17:44:24
 */
class API
{
     // curl http
     public function opencurl($url, $data=null, $header="")
     {
         $ch=curl_init($url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_HEADER, 0);
         if (!empty($data)) {
             curl_setopt($ch, CURLOPT_POST, 1);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
         }
         if (strstr($url, "https")) {
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
         }
         $result=curl_exec($ch);
         return $result;
         curl_close($ch);
     }
 
     public function trimall($str){
         $blank=array(" "," ","\t","\n","\r");
         return str_replace($blank,"",$str);
     }
    public function getWeather()
    {
        $url="https://free-api.heweather.com/s6/weather/forecast?location={$_SERVER["REMOTE_ADDR"]}&key=14d0ec2eef0c4c50b90653defc775082";
        return $this->opencurl($url);
    }

    public function getLibrary($bkn,$page)
    {
        $url="http://222.24.94.243:8088/opac/search?q={$bkn}&pager.offset={$page}";
        $test=$this->opencurl($url);
        return $test;
        
    }
    function getBookDetail($pattern,$bkn,$page){
        $data=$this->getLibrary($bkn,$page);
         preg_match_all($pattern,$data,$result);
         return $result;
        
    }
    public function getDayWord()
    {
        $url="http://open.iciba.com/dsapi/";
        $data=$this->opencurl($url);
        $data=json_decode($data);
        return $data;
    }
}
