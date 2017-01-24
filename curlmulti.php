<?php

function multi ($nodes) {
	$file = fopen ("cron.txt","a+");
	$str = PHP_EOL.$nodes[0].PHP_EOL.PHP_EOL;
	fputs ( $file, $str);
	if ( !$file )
	{
	  echo("Ошибка открытия файла");
	}
	
        $mh = curl_multi_init();
        $curl_array = array();
        foreach($nodes as $i => $url)
        {
            $curl_array[$i] = curl_init($url);
	    curl_setopt($curl_array[$i], CURLOPT_HEADER, false);
            curl_setopt($curl_array[$i], CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl_array[$i], CURLOPT_TIMEOUT, 5);
	    curl_setopt($curl_array[$i], CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
            curl_multi_add_handle($mh, $curl_array[$i]);
	    
        }
        $running = NULL;
        do {
            curl_multi_exec($mh,$running);
        } while($running > 0);
       
        $res = array();
        foreach($nodes as $i => $url)
        {
            $res[$i][$url] = json_encode(curl_multi_getcontent($curl_array[$i]));
        }
       
        foreach($nodes as $i => $url){
            curl_multi_remove_handle($mh, $curl_array[$i]);
        }
	fclose ($file);
        curl_multi_close($mh);       
        return $res;
}
//раз в 2 секунды
$urls1 = ['gb/bakkara/cron', 'gb/horse/cron','gb/horsev/cron', 'gb/dogs/cron','gb/omaha/cron', 'gb/texas/cron','gb/mouse/cron', 'gb/horse8/cron',
	'gb/keno/cron', 'gb/kenolong/cron','gb/blackjack/cron', 'gb/dogslong/cron','gb/horselong/cron', 'gb/mouselong/cron','gb/moto/cron', 'gb/horsehd/cron',
	'gb/fortunelong/cron', 'gb/fortuneplus/cron','gb/fortune/cron', 'gb/vsls/cron','gb/fortunezz/cron', 'gb/blind/cron','gb/fortunespot/cron', 'gb/cockroach/cron',
	'gb/fortunespotz/cron', 'gb/kenospot/cron','gb/fortunespotzz/cron', 'gb/texasspot/cron','gb/fortunepluss/cron', 'gb/fortunes/cron','gb/kenodeluxes/cron', 'gb/kenodeluxe/cron',
	'gb/kenofspot/cron', 'gb/dogsf/cron','gb/mousef/cron', 'gb/horse8f/cron','gb/dogs8f/cron', 'gb/fortunefs/cron','gb/fortunefzs/cron', 'gb/fortunefps/cron',
	'gb/goal/cron', 'gb/ladybugs/cron','gb/dogsv/cron', 'gb/fortunesr/cron','gb/bgfortune/cron', 'gb/bgdice/cron','gb/bglucky5/cron', 'gb/bglucky7/cron',
	'gb/kenogreen/cron', 'gb/betgames/cron','gb/betgames/cron', 'gb/soccer/cron','gb/fortunefr/cron', 'gb/ibfortune/cron','gb/ibbingo/cron', 'gb/ibdogs/cron',
	'gb/ibhorse/cron', 'gb/ibliveroulette/cron','gb/ibpoker/cron', 'gb/ibkeno/cron','gb/ibtexas/cron', 'gb/ibblackjack/cron','gb/ibhorse8/cron', 'gb/ibdogs8/cron',
	'gb/circusfortune/cron', 'gb/bgpoker/cron','gb/bgbaccarat/cron', 'gb/kenogreenp/cron','gb/cron/apipabkswupdatebalancerequest'];

//раз в минуту
$urls2 = ['gb/cron/accessgbs','gb/cron/depositstatus','gb/cron/withdrawstatus','gb/cron/smsdeliver','gb/cron/betsobserver',
	 'gb/cron/emoneybet','gb/cron/parsecurrencies','gb/cron/betofficereport'];

//раз в 5 сек
$urls3 = ['gb/kenogreen/stakes', 'gb/fortunefr/stakes', 'gb/kenogreenp/stakes'];

//2 раза в неделю в 10 утра
$urls4 = ['gb/cron/alertmanagers'];

//раз в 6 сек
$urls5 = ['gb/cron/chip/bakkara', 'gb/cron/chip/blackjack', 'gb/fortuneplus/stakes', 'gb/cron/apiwalletbetresultrequest'];

//каждый час в 0 минут
$urls6 = ['gb/cron/reportreport'];

//каждые 5 минут
$urls7 = ['gb/cron/sendmail', 'gb/adscron/adsinsertts', 'gb/adscron/adsgetspaceslinks', 'gb/adscron/adsgettrackinglinks', 'gb/adscron/adsgetpaybonuscodes', 'gb/adscron/adsgetregbonuscodes'];

//каждый понедельник в 9 утра 
$urls8 = ['gb/ibfortune/cron','gb/ibbingo/cron', 'gb/ibdogs/cron',
	'gb/ibhorse/cron', 'gb/ibliveroulette/cron','gb/ibpoker/cron', 'gb/ibkeno/cron','gb/ibtexas/cron', 'gb/ibblackjack/cron','gb/ibhorse8/cron', 'gb/ibdogs8/cron'];

$test = [
'gb/texaslive/cron/',
'gb/texaslive/cron/',
'gb/texaslive/cron/'
];



$ur = [$test /*$urls1, $urls2, $urls3, $urls4, $urls5, $urls6, $urls7, $urls8 */];

foreach ($ur as $urls) {
    foreach ($urls as $u) {
    $url = [];
	for ($i = 1; $i <= 10; $i++) { 
	    array_push($url, $u); 
	}
	multi($url);
    }
}


echo 'end';

/*
gb/cron/apipabkswupdatebalancerequest
gb/kenogreenp/cron
gb/ibdogs8/cron
gb/ibhorse8/cron
gb/ibblackjack/cron
gb/ibtexas/cron
gb/ibpoker/cron
gb/ibliveroulette/cron
gb/ibhorse/cron
gb/ibdogs/cron
gb/ibbingo/cron
gb/ibfortune/cron
gb/betgames/cron
gb/betgames/cron
gb/kenogreen/cron
gb/cron/betofficereport
gb/cron/withdrawstatus

 * 
 */