<?php

namespace App\Http\Controllers\API\File;

use App\Http\Requests\API\File\AddRequest;
use App\Jobs\HttpDownload;
use App\Http\Requests\API\File\Add\UrlRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddController extends Controller
{
    /**
     * Add file to bucket by url
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function url(UrlRequest $request)
    {
        HttpDownload::dispatch($request->url, $request->bucket);
    }

    /**
     * Return status of current file/task
     *
     * @param Request $request
     * @param int $id file/task ID
     */
    public function status(int $id)
    {


//в ответе на запрос загрузку/добавления файла — мы возвращаем ID задачи
//
//
//по этому ID тот кто отправил запрос — сможет отслеживать текущее состояние задачи (загрузки файла)
//
//
//текущее состояние — пишется в БД, в таблицу http_download_task, эту таблицу соотв. нужно будет ещё создать
    }
}
