<?php

declare(strict_types=1);

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace TAnt;

use think\Service;
use TAnt\Command\Backup\Backup;
use TAnt\Command\Install\Install;
use Doctrine\Common\Annotations\Reader;
use think\annotation\InteractsWithRoute;
use think\annotation\InteractsWithInject;

class AppService extends Service
{
    use InteractsWithRoute;
    use InteractsWithInject;

    /** @var Reader */
    protected $reader;

    public function register()
    {
        $this->registerCommand();
    }

    public function boot(Reader $reader)
    {
        $this->reader = $reader;

        //注解路由
        $this->registerAnnotationRoute();

        //自动注入
        $this->autoInject();
    }

    /**
     * 注册命令行.
     *
     * @return void
     */
    protected function registerCommand()
    {
        $this->commands([
            Install::class,
            Backup::class,
        ]);
    }
}
