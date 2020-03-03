<?php

namespace App\Http\Controllers;

use App\Services\RequestLogService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RequestLogController extends Controller
{
    private $_requestLogService;

    public function __construct(RequestLogService $requestLogService) {
        $this->_requestLogService = $requestLogService;
    }

    public function index(Request $request) {
        $logs = $this->_requestLogService->index();

        return response()->json(['data' => $logs], Response::HTTP_OK);
    }

    public function show($id, Request $request) {
        $rules = array_only($this->_requestLogService->rules(), ['id']);

        $validator = Validator::make(['id' => $id], $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], Response::HTTP_BAD_REQUEST);
        }

        $log = $this->_requestLogService->show($id);

        if (empty($log)) {
            return response()->json(['errors' => ['UserLog' => 'not found']], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['data' => $log], Response::HTTP_OK);
    }

    public function get($id) {
        $log = $this->_requestLogService->show($id);

        if (empty($log)) {
            return view('welcome');
        }

        return view('log', [
            'log' => $log->toArray(),
        ]);
    }

    public function store(Request $request) {
        $rules = array_except($this->_requestLogService->rules(), ['id']);

        $fields = array_only($request->all(), array_keys($rules));
        $validator = Validator::make($fields, $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], Response::HTTP_BAD_REQUEST);
        }

        $log = $this->_requestLogService->store($fields);

        return response()->json(['data' => $log], Response::HTTP_OK);
    }

    public function create() {
        return view('requestLogForm');
    }

    public function update($id, Request $request) {
        $rules = $this->_requestLogService->rules();

        $fields = array_only($request->all(), array_keys($rules));

        $validator = Validator::make(array_merge($fields, ['id' => $id]), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], Response::HTTP_BAD_REQUEST);
        }

        $log = $this->_requestLogService->update($id, $fields);

        if (empty($log)) {
            return response()->json(['errors' => ['UserLog' => 'not found']], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['data' => $log], Response::HTTP_OK);
    }

    public function updateForm($id) {
        $log = $this->_requestLogService->show($id);

        if (empty($log)) {
            return view('welcome');
        }

        return view('requestLogForm', [
            'log' => $log->toArray(),
        ]);
    }

    public function destroy($id, Request $request) {
        $rules = array_only($this->_requestLogService->rules(), ['id']);

        $validator = Validator::make(['id' => $id], $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], Response::HTTP_BAD_REQUEST);
        }

        $log = $this->_requestLogService->destroy($id);

        if (empty($log)) {
            return response()->json(['errors' => ['UserLog' => 'not found']], Response::HTTP_NOT_FOUND);
        }

        return response()->json(null, Response::HTTP_OK);
    }
}
