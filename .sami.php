<?php

use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('config')
    ->in($dir = 'src');

$versions = GitVersionCollection::create($dir)
    ->addFromTags('2.0.*')
    ->addFromTags('2.1.*')
    ->add('master', 'master branch')
    ->add('29-widen-range-of-api-methods', 'next')
;

return new Sami($iterator, array(
    'versions'             => $versions,
    'build_dir'            => __DIR__.'/../docs/api/%version%',
    'cache_dir'            => __DIR__.'/../cache/%version%',
    'remote_repository'    => new GitHubRemoteRepository('RobBrazier/Laravel_Piwik', dirname($dir)),
));