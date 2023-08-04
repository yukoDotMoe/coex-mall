<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebSocketController extends Controller
{
    public function handle(Request $request)
    {
        $server = stream_socket_server("tcp://127.0.0.1:8080", $errno, $errstr);

        if (!$server) {
            die("Error: $errstr ($errno)");
        }

        echo "WebSocket server is listening on 127.0.0.1:8080\n";

        $clients = [$server];

        while (true) {
            $read = $clients;
            $write = $except = null;

            if (!stream_select($read, $write, $except, 0)) {
                continue;
            }

            foreach ($read as $socket) {
                if ($socket === $server) {
                    $newClient = stream_socket_accept($server);
                    if ($newClient) {
                        $clients[] = $newClient;
                    }
                } else {
                    $data = fread($socket, 1024);
                    if (!$data) {
                        $key = array_search($socket, $clients);
                        fclose($socket);
                        unset($clients[$key]);
                    } else {
                        // Decode the JSON data into an array
                        $receivedData = json_decode($data, true);

                        // Handle WebSocket messages from clients
                        // Implement your logic here

                        // Send a response (echoing the received data for demonstration purposes)
                        $responseData = json_encode($receivedData); // Encode array as JSON
                        fwrite($socket, $responseData);
                    }
                }
            }
        }
    }
}
