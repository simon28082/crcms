<?php
echo 'aaa';
$server = new \Swoole\Http\Server("0.0.0.0", 22);


$server->on('request',function(\Swoole\Http\Request $request,\Swoole\Http\Response $response) use ($server){
    echo 123;
    $response->end(123);
    $server->close($request->fd);
});


$server->on('close',function(\Swoole\Http\Server $server,$fd,int $reactorId){

    echo "close\n{$fd}\n";
});


$server->start();