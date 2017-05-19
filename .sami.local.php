<?php

use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('config')
    ->in($dir = 'src');

return new Sami($iterator, array(
    'title'                => 'Laravel_Piwik',
    'remote_repository'    => new GitHubRemoteRepository('RobBrazier/Laravel_Piwik', dirname($dir)),
    'default_opened_level' => 2,
));