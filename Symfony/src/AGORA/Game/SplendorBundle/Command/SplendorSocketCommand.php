<?php


namespace AGORA\Game\SplendorBundle\Command;


use AGORA\Game\SplendorBundle\Socket\SplendorSocket;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Symfony\Bundle\WebServerBundle\WebServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SplendorSocketCommand extends Command {

    protected function configure() {
        $this->setName('sockets:start-splendor')
            ->setHelp("Starts the game of Splendor socket demo")
            ->setDescription('Start Splendor Socket');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $output->writeln([
            'Splendor socket',// A line
            '============',// Another line
            'Starting Splendor, open your browser and enjoy !.',// Empty line
        ]);

        $service = $this->getApplication()->getKernel()->getContainer()->get('agora_game.splendor');

        $server = IoServer::factory(
            new HttpServer(new WebServer(new SplendorSocket($service))),
            8088
        );

        $server->run();

    }


}