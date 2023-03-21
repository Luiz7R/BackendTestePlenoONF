<?php

use Carbon\Carbon;

/**
 * Return a JSON response with the given error message and status code.
 *
 * @param string $message
 * @param int $statusCode
 * @return \Illuminate\Http\JsonResponse
 */
function errorResponse($message, $statusCode)
{
    return response()->json($message, $statusCode);
}

function formatarData($data)
{
    return Carbon::parse($data)->format('d/m/Y');
}

function formatarValor($valor)
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}
