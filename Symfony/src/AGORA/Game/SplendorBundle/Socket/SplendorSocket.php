<?php


namespace AGORA\Game\SplendorBundle\Socket;


use AGORA\Game\SplendorBundle\Service\SplendorService;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SplendorSocket implements MessageComponentInterface {

    protected $service;
    protected $clients;


    public function __construct(SplendorService $srvc) {
        $this->service = $srvc;
        $this->clients = [];
    }

    /**
     * When a new connection is opened it will be passed to this method
     * @param ConnectionInterface $conn The socket/connection that just connected to your application
     * @throws \Exception
     */
    function onOpen(ConnectionInterface $conn) {
        if (!in_array($conn, $this->clients)) {
            array_push($this->clients, $conn);
        }
    }

    /**
     * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
     * @param ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn) {
        $k = array_search($conn, $this->clients);
        array_splice($this->clients, $k, 1);
    }

    /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     * @param ConnectionInterface $conn
     * @param \Exception $e
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        // TODO: Implement onError() method.
    }

    /**
     * Triggered when a client sends data through the socket
     * @param \Ratchet\ConnectionInterface $from The socket/connection that sent the message to your application
     * @param string $msg The message received
     * @throws \Exception
     */
    function onMessage(ConnectionInterface $from, $msg) {
        $content = json_decode($msg);
        switch ($content->type) {
            case "takeTokens":
                $tokens = $this->service->getTokens(intval($content->gameId), intval($content->userId)
                    , explode(",", $content->tokens));
                if ($tokens != null) {
                    $tokensPlayer = $tokens[0]; $tokensGame = $tokens[1];
                    $data = array("type" => $content->type, "userId" => $content->userId, "tokensPlayer" => $tokensPlayer
                    , "tokensGame" => $tokensGame);
                    $data = json_encode($data);
                    foreach ($this->clients as $client) {
                        $client->send($data);
                    }
                }
                break;
            case "":
                break;
        }

    }
}