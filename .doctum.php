<?php

use Doctum\RemoteRepository\GitHubRemoteRepository;
use Doctum\Doctum;
use Doctum\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('config')
    ->in($dir = 'src');

$versions = GitVersionCollection::create($dir)
    ->addFromTags('2.*')
    ->addFromTags('3.*')
    ->addFromTags('4.*')
    ->add('master', 'master branch');

return new Doctum($iterator, [
    'title'                => 'Laravel_Piwik',
    'versions'             => $versions,
    'build_dir'            => __DIR__.'/../docs/api/%version%',
    'cache_dir'            => __DIR__.'/../cache/%version%',
    'remote_repository'    => new GitHubRemoteRepository('RobBrazier/Laravel_Piwik', dirname($dir)),
    'default_opened_level' => 2,
]);
