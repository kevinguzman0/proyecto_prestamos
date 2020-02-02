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

        if ($exception instanceof \ErrorException) 
        {

            $mensajeError = 'Atención, ha ocurrido un error controlado pero no clasificado con el sistema o con la Base de Datos. No podrá hacer uso de esta sección específica del sistema pero el resto estará disponible. Tome una foto de la pantalla completa y contáctese con el administrador del sistema para revisar y corregir esta anomalía del Sistema.';
            abort(404, $mensajeError);

        }

        return parent::render($request, $exception);

    }

    

}
