<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

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
     * @param \Exception $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }


    /**
     * Convert a validation exception into a JSON response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Validation\ValidationException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {
        $msg = collect(collect($exception->errors())->first())->first();
        $errors = $this->errorsInArrayOfStr($exception);
        $response = $this->errorResponse($msg, $errors, $exception->status);


        return response()->json($response, $exception->status);
        /*    return response()->json([

                'message' => $exception->getMessage(),
                'errors' => $exception->errors(),
            ], $exception->status);*/
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param ValidationException $exception
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    protected function invalid($request, ValidationException $exception)
    {

        foreach ($exception->errors() as $errors) {
            foreach ($errors as $error) {
                toast($error, 'error');
            }
        }
        return redirect($exception->redirectTo ?? url()->previous())
            ->withInput(\Arr::except($request->input(), $this->dontFlash))
            ->withErrors($exception->errors(), $exception->errorBag);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? responseJson([], $exception->getMessage(), 401)
            : redirect()->guest($exception->redirectTo() ?? route('login'));
    }

    /**
     * change  array for validation errors to array of strings without keys o
     * @param ValidationException $exception
     * @return array
     */
    protected function errorsInArrayOfStr(ValidationException $exception): array
    {

        $errors_bag = [];
        foreach ($exception->errors() as $errors) {
            foreach ($errors as $error) {
                $errors_bag[] = $error;
            }
        }

        return $errors_bag;
    }

    /**
     * reformat data for response  datum  pattern
     * @param string|null $msg
     * @param array|null $errors
     * @param int|null $status
     * @return array
     */
    protected function errorResponse(?string $msg = null, ?array $errors = [], ?int $status = 0): array
    {
        return [
            'status' => $status==401?2:0,
            'message' => $msg,
            'errors' => $errors,
            'data' => null,
        ];
    }
}
