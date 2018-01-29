<?php
namespace Tarekdj\Composer\Downloader;

use Composer\Package\PackageInterface;
use Composer\Downloader\TarDownloader;
use Composer\Downloader\ChangeReportInterface;
use splitbrain\PHPArchive\Tar;


class PHPArchiveTarDownloader extends TarDownloader
{
    /**
     * @param string $file path to the archive file
     * @param string $path path where the extension should be extracted to
     */
    protected function extract($file, $path)
    {
        $archive = new Tar();
        $archive->open($file);
        $archive->extract($path);
    }
}