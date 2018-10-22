<?php
/**
 * Created by PhpStorm.
 * User: guillaume
 * Date: 20/04/2018
 * Time: 15:49
 */

namespace AGORA\Game\GameBundle\Command;


use AGORA\Game\Socket\Socket;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SocketCommand extends Command {
    protected function configure() {
        $this->setName('sockets:avecesar')
            // the short description shown while running "php bin/console list"
            ->setHelp("Starts the game of 6 qui prend socket demo")
            // the full command description shown when running the command with
            ->setDescription('Starts the Ave Cesar socket')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln([
            'Ave Cesar socket',// A line
            '============',// Another line
        ]);

        $container = $this->getApplication()->getKernel()->getContainer();

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Socket($container)
                )
            ),
            8090
        );

        $server->run();
    }
}
