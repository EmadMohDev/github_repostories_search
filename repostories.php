<?php

// inital values 
(isset($_REQUEST['top'])  && $_REQUEST['top'] != "" ) ? $top= $_REQUEST['top'] : $top=10  ;
(isset($_REQUEST['date'])  && $_REQUEST['date'] != "" ) ? $date= $_REQUEST['date'] : $date="2019-01-10"  ;
(isset($_REQUEST['language'])  && $_REQUEST['language'] != "" ) ? $lang= $_REQUEST['language'] : $lang=""  ;

  
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.github.com/search/repositories?q=created:>$date&sort=stars&order=desc&per_page=$top",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    "user-agent: http://developer.github.com/v3/#user-agent-required"
  ),
));

$response = curl_exec($curl);
curl_close($curl);

$repostories = json_decode($response) ;
 

 $count = 0 ; 
 $resultHtml = "" ;
 $langues = array() ;
 $languesHtml =  "" ;

foreach ($repostories->items as $repostory) {
  $count++ ;

// to collect unique language to can filter with
  if(isset($repostory->language) && $repostory->language != ""){
    $langues[$repostory->language]=$repostory->language ;
  }

// to filter by language 
    if(isset($_REQUEST['language']) && $_REQUEST['language'] != ""){
        if($repostory->language == $_REQUEST['language']) {
            $resultHtml =  drawTable($repostory, $count,  $resultHtml) ;
        }
    }else{
        $resultHtml =  drawTable($repostory, $count,  $resultHtml) ;
    }
}

// draw html with filter items 
function drawTable($repostory, $count,  $resultHtml){
    $repostoryHtml =  "<tr>
    <td>".$count."</td>
    <td>".$repostory->id."</td>
    <td>".$repostory->language."</td>
    <td>".$repostory->stargazers_count."</td>
    <td>".date_format(date_create($repostory->created_at),"Y-m-d")."</td>
   </tr>" ;
   
   
   
 return   $resultHtml = $resultHtml.$repostoryHtml ;
}


// create Langauge selector
foreach($langues as $langue){
   $selected =  ( isset( $_REQUEST['language'])   && $_REQUEST['language'] != "" &&  $langue ==  $_REQUEST['language'] )? 'selected':''  ;
    $languesHtml .=  "<option  $selected >$langue</option>"  ;
}

// create top selector
$tops = array(10,50,100);
$topHtml = "" ;

foreach($tops as $top){
    $selected =  ( isset( $_REQUEST['top'])   && $_REQUEST['top'] != "" &&  $top ==  $_REQUEST['top'] )? 'selected':''  ;
    $topHtml  .=  "<option value='".$top."'  $selected > Top $top  </option>" ;

}

?>



