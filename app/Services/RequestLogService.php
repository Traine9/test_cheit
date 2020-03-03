<?php

namespace App\Services;
use App\Repositories\RequestLogRepository;

class RequestLogService
{
    private $_requestLogRepository;

    public function __construct(RequestLogRepository $logRepository)
    {
        $this->_requestLogRepository = $logRepository;
    }
}
