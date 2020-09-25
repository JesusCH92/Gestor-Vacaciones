<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ErrorListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        // You get the exception object from the received event
        $exception = $event->getThrowable();

        if ($exception instanceof AccessDeniedHttpException) {
            throw new NotFoundHttpException();  // ! Replace 403 code for 404, not reveal information
        }

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        elseif ($exception instanceof HttpExceptionInterface) {
            $request = $event->getRequest();
            $format = $request->attributes->get('_format');

            if ('json' !== $format || 'v1' !== $request->attributes->get('version')) {
                return;
            }

            $exception = $event->getThrowable();

            // Customize your response object to display the exception details
            $response = new JsonResponse();
            $response
                ->setData(
                    [
                        'error' => $exception->getStatusCode(),
                        'message' => $exception->getMessage(),
                    ]
                );
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {

            $message = sprintf(
                'Error: %s',
                $exception->getMessage()
            );

            // Customize your response object to display the exception details
            $response = new Response();
            $response->setContent($message);
        }

        // sends the modified response object to the event
        $event->setResponse($response);
    }
}