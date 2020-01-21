<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function render($request, Exception $exception)
    {

        if ($exception instanceof \PDOException) 
        {
            $mensajeError = 'Atención, ha ocurrido un error grave con la conexión a la Base de Datos. Contáctese con el administrador del sistema para revisar y corregir esta anomalía del Sistema.';
            abort(404, $mensajeError);
        }

        if ($exception instanceof \NotFoundHttpException)
        {
            $mensajeError = 'Atención, es imposible mostrar información. La URL es incorrecta. Contáctese con el administrador del sistema para revisar y corregir esta situación.';
            abort(404, $mensajeError);  
        }


        if ($this->isHttpException($exception)) {
            switch ($exception->getStatusCode()) {

                // not authorized
                case '403':
                    $mensajeError = 'ERROR 403 - Contáctese con el administrador del sistema para revisar y corregir esta situación.';
                    abort(404, $mensajeError);  
                    break;

                // not found
                case '404':
                    $mensajeError = 'ERROR 404 - Contáctese con el administrador del sistema para revisar y corregir esta situación.';
                    return view('test.visor', compact('mensajeError'));  
                    break;

                // internal error
                case '500':
                    $mensajeError = 'ERROR 500 - Contáctese con el administrador del sistema para revisar y corregir esta situación.';
                    abort(404, $mensajeError);  
                    break;

                default:
                    return $this->renderHttpException($e);
                    break;
            }
        }

        return parent::render($request, $exception);

    }
}
