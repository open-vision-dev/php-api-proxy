
request-fwd is php script used to forward you GET/POST request to any destination sever 
usefull if you are testing on a remote server with sandbox or api that only accessible through it you setup a ssh/vpn link to your vm/cloud/deployment server
then use this script to git scrape apis in real 

it include basic authentication (credits to Intervention/HttpAuth)

** Usage **

you define your post/get you want to send via your tool/app/script-language of your choice then pass it additonal parameter called [dest] refers to destination
if there is port plase bind in the address and don't type http or https by default it uses https http NONO then match your app basic auth credentials with
script $this->secret variable you will get responses directly 

<bold>examples </bold>
#### CURL POST EXAMPLE 

[service api link]  = http://www.dream-server/magic/wood/jungle<br />
[data] =  ['kitten' => 'sadasdasd' ,'food' => ['apple','orange','chicken']
[your magic php-script url] = http://www.some.fancy.server.com 

curl --data "kitten=sadsadsadad&food=['apple','orange','etc']&dest=www.dream-server/magic/wood/jungle/"   http://www.some.fancy.server.com 


  
