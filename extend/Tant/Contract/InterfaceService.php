<?php

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace TAnt\Contract;

interface InterfaceService
{
    public function list(int $pageNo, int $pageSize, array $params = []);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function info($id);
}
