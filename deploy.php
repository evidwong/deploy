<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'test');

// Project repository
set('repository', 'git@github.com:evidwong/deploy.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

set('writable_use_sudo', false);

task('NCPf', function () {
    $result = run('ssh -NCPf root@192.168.111.223 -L 3221:10.168.3.111:22');
    writeln("Current dir: $result . 11111111111111");
});

// Hosts

host('127.0.0.1')
    ->stage('test')
    ->user('root')
    ->port('3221')
    // 并指定公钥的位置
    ->identityFile('~/.ssh/id_rsa.pub')
    // 指定项目部署到服务器上的哪个目录
    ->set('deploy_path', '/data/test')
    ->set('http_user', 'www');

// Tasks

// 自定义任务：缓存路由，recipe/laravel.php 默认的流程里没有这个，所以加上，息看需要
after('artisan:config:cache', 'artisan:route:cache');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
