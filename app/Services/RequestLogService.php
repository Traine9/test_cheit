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

    public function index()
    {
        return $this->_requestLogRepository->index();
    }

    public function show($id)
    {
        return $this->_requestLogRepository->show($id);
    }

    public function store($request)
    {
        return $this->_requestLogRepository->store($request);
    }

    public function update($id, $request)
    {
        return $this->_requestLogRepository->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->_requestLogRepository->destroy($id);
    }

    public function rules()
    {
        return $this->_requestLogRepository->rules();
    }
}
