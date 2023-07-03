<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; // Ne pas oublier d'importer NotFoundHttpException


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

    public function register()
    {
        // On modifier le comportement pour l'exception NotFoundHttpException
        $this->renderable(function (NotFoundHttpException $e, $request) {
            // Si la requête contient "api/*"
            if ($request->is("api/*")) {
                // On retourne une réponse 404 avec un message en JSON
                return response()->json([
                    "message" => "Ressource introuvable"
                ], 404);
            }
        });
    }
}




