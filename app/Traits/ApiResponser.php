<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{

  /**
   * Build a success response
   * @param strin or array $data
   * @param int $code
   * @param iluminate\Http\JsonResponse
  */
  public function successResponse($data, $code = Response::HTTP_OK)
  {
    return response()->json(['data' => $data], $code );
  }
  
  /**
   * Build a success response
   * @param strin $message
   * @param int $code
   * @param iluminate\Http\JsonResponse
  */
  public function errorResponse($message, $code)
  {
      return response()->json(['error' => $message, 'code'  => $code], $code);
  }
}