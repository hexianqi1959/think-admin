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

namespace TAnt\App\Service;

use app\BaseService;
use TAnt\App\Model\DataBaseLog;
use TAnt\Contract\InterfaceService;

class DataBaseLogService extends BaseService implements InterfaceService
{
    public function __construct(DataBaseLog $model)
    {
        $this->model = $model;
    }

    /**
     * 获取日志列表.
     */
    public function list(int $pageNo, int $pageSize)
    {
        $total = $this->model->count();
        $logs = $this->model->alias('d')->join('user u', 'd.user_id = u.id')
            ->limit($pageSize)->page($pageNo)->order('d.create_time desc')
            ->field('d.*, u.nickname')
            ->select();

        return [
            'data'       => $logs,
            'pageSize'   => $pageSize,
            'pageNo'     => $pageNo,
            'totalPage'  => count($logs),
            'totalCount' => $total,
        ];
    }

    /**
     * 删除日志.
     *
     * @param mixed $id
     */
    public function delete($id)
    {
        $ids = explode(',', $id);

        if (empty($ids)) {
            return false;
        }

        $this->model->whereIn('id', $ids)->delete();

        return true;
    }
}
