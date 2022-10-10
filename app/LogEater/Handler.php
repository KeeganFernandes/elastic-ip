<?php

namespace App\LogEater;

use Exception;
use Illuminate\Support\Facades\Http;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use ParseError;
use Throwable;

use function PHPUnit\Framework\throwException;

class Handler extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    /**
     * @inheritDoc
     */
    protected function write(array $record): void
    {
        $exception = $record["context"]["exception"] ?? null;

        $exception_message = "";

        if ($exception) {
            $exception_message = $exception->__toString();
        }

        $data = [
            "message" => $record["message"],
            "backtrace" => $exception_message,
            "level" => strtolower($record["level_name"]) ?? "debug",
            "environment" => config("app.env"),
            "created_at" => $record["datetime"]->format("Y-m-d H:i:s"),
        ];

        $request = Http::withHeaders(["Project-Key" => config("logging.channels.log_eater.project_key")])->post(config("logging.channels.log_eater.log_eater_url"), $data);
    
        if ($request->failed()) {
            throw new Exception($request->body(), 1);
        }
    }
}
