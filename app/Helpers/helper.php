<?php


/**
 * @param int $status
 * @param string|null $msg
 * @param iterable|object|null $data
 * @return \Illuminate\Http\JsonResponse
 */
function responseJson($data = null, ?string $msg = null, int $status = 200)
{
    $response = [
        'status' => ($status == 200) ? 1 : 0,
        'message' => $msg,
        'data' => $data,
    ];
    return response()->json($response, $status);
}

function days()
{
    return [
        1 => __("Sat"),
        2 => __("Sun"),
        3 => __("Mon"),
        4 => __("Tue"),
        5 => __("Wen"),
        6 => __("Thr"),
        7 => __("Fri")];
}