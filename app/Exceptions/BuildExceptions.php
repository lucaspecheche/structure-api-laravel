<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class BuildExceptions extends \Exception
{
    protected $shortMessage;
    protected $message;
    protected $description;
    protected $httpCode;

    public function __construct(array $exception)
    {
        $this->shortMessage = array_get($exception, 'shortMessage', 'internalError');
        $this->message      = array_get($exception, 'message', trans('exceptions.internal_error'));
        $this->description  = array_get($exception, 'description', '');
        $this->httpCode     = array_get($exception, 'httpCode', Response::HTTP_UNPROCESSABLE_ENTITY);
        parent::__construct();
    }

    public function render()
    {
        return response($this->getError(), $this->httpCode);
    }

    public function getError()
    {
        return [
            'shortMessage' => $this->shortMessage,
            'message'      => $this->message,
            'description'  => $this->description,
        ];
    }
}
