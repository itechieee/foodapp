<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if (\Request::is('api/*')) { 
            if ($e instanceof \App\Exceptions\AppNotFoundException) {
                $code = 1001;
                if (!empty($e->getMessage()) && is_numeric($e->getMessage())) {
                    $code = $e->getMessage();
                }
                $response = appmsgError($code);
                $response['code'] = 404;
                return response($response, 404);
            } 

            
            if ($e instanceof \App\Exceptions\AppUnauthorizedException) {
                $code = 1002;
                if (!empty($e->getMessage()) && is_numeric($e->getMessage())) {
                    $code = $e->getMessage();
                }
                $response = appmsgError($code);
                return $this->failureResponse($response,'' ,401);
            }

            if ($e instanceof \App\Exceptions\AppUnprocessableException) {
                $code = 1003;
                if (!empty($e->getMessage()) && is_numeric($e->getMessage())) {
                    $code = $e->getMessage();
                }
                $response = appmsgError($code);
                return $this->failureResponse($response,'' ,422);
            }

            if($this->isHttpException($e)){
                switch ($e->getStatusCode()) {
                    // 404 not found
                    case '404':
                        $response = appmsgError(1004);
                        return $this->failureResponse($response,'' ,404);
                    break;
        
                    // internal error
                    case '500':
                        $response = appmsgError(1005);
                        return $this->failureResponse($response,'' ,422);
                    break;    
                }
            }
        }
        

        return parent::render($request, $e);
        // if(!$request->expectsJson()) return parent::render($request, $e);
        
    }

    private function failureResponse($data = array(), $message = 'Failure', $code = null)
    {
        $response = [
            'error'     => $data,
            'status'    => false,
            'message'   => $message ? $message : 'Failure',
            'status_code'      => $code 
        ];
        
        return response()->json(
            (object)$response,
            $code
        );
    }
}
