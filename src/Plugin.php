<?php

namespace Tarekdj\Composer;


use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Package\Link;
use Composer\Plugin\PreFileDownloadEvent;
use Composer\Plugin\PluginEvents;
use Composer\Plugin\PluginInterface;

use Tarekdj\Composer\Downloader\PHPArchiveTarDownloader;

class Plugin implements PluginInterface
{
    /**
     * @var IOInterface
     */
    protected $io;

    /**
     * @var Composer
     */
    protected $composer;

    /**
     * @var PHPArchiveTarDownloader
     */
    protected $downloader;

    /**
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->io = $io;
        $this->composer = $composer;
        //$this->getDownloader();

        $this->addDownloader();
    }

    public function getDownloader()
    {
        if (is_null($this->downloader)) {
            $this->setDownloader(new PHPArchiveTarDownloader($this->io, $this->composer->getConfig())); 
        }
        
        return $this->downloader;
    }

    public function setDownloader(PHPArchiveTarDownloader $downloader)
    {
        $this->downloader = $downloader;
    }

    public function addDownloader()
    {
        $this->composer->getDownloadManager()->setDownloader("tar", $this->getDownloader());    
    }
}