<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Success Response
     * 
     * @param array $data
     * @param string $message
     * @param int $code
     * @return json|string
     */

    public function successResponse($data = array(), $message = 'Success', $code = 200)
    {
        $response = [            
            'status'    => true,
            'message'   => $message ? $message : 'Success',
            'status_code'      => $code ? $code : $this->getStatusCode(),
            'data'      => $data,
        ];

        return response()->json(
            (object)$response,
            $this->getStatusCode()  
        );
    }

    /**
     * Failure Response
     * 
     * @param array $data
     * @param string $message
     * @param int $code
     * @return json|string
     */
    public function failureResponse($data = array(), $message = 'Failure', $code = null)
    {
        $response = [
            'error'     => $data,
            'status'    => false,
            'message'   => $message ? $message : 'Failure',
            'status_code'      => $code ? $code : $this->getStatusCode()
        ];
        return response()->json(
            (object)$response,
            $this->getStatusCode()
        );
    }

    public function respond($data, $headers = [])
    {
        return $this->jsonResponse($data, $this->getStatusCode(), $headers);
    }
    
     /**
     * respond with pagincation
     *
     * @param Paginator $lessions
     * @param array $data
     * @return mix
     */
    public function respondWithPagination($lessions, $data)
    {
        $data = array_merge($data, [
            'paginator'   => [
                'total_count'   => $lessions->total(),
                'total_pages'   => ceil($lessions->total() / $lessions->perPage()),
                'current_page'  => $lessions->currentPage(),
                'limit'         => $lessions->perPage()
             ]
        ]);
        return $this->respond($data);
    }

     /**
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCreated($message)
    {
        return response('', IlluminateResponse::HTTP_CREATED);
    }

    
    /**
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondDeleted()
    {
        return response('', IlluminateResponse::HTTP_NO_CONTENT);
    }

    /**
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondAccepted($message)
    {
        return response('', IlluminateResponse::HTTP_ACCEPTED);
    }

    /**
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondSuccess($message)
    {
        return response('', IlluminateResponse::HTTP_OK);
    }

    /**
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUpdated($message)
    {
        return response('', IlluminateResponse::HTTP_OK);
    }

    /**
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    protected function respondUnprocessableEntity($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }

    protected function respondForbiddenEntity($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_FORBIDDEN)->respondWithError($message);
    }

    protected function respondUnAuthorizedEntity($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)->respondWithError($message);
    }
}