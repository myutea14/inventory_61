<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
public function render($request, Throwable $e) {
if ($request->is('api/*')) {
return response()->json([
'status' => 'error',
'data' => null,
'message' => $e->getMessage(),
], method_exists($e,'getStatusCode') ?
$e->getStatusCode() :
500);
}
return parent::render($request, $e);
}
}