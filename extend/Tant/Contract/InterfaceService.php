<?php

namespace TAnt\Contract;

interface InterfaceService
{
    public function list(int $pageNo, int $pageSize, array $params = []);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function info($id);
}
