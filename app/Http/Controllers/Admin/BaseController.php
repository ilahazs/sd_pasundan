<?php
/**
 * Copyright (c) 2019. Five Code Development - PT. Lima Kode Teknologi
 * Created by Faerul Salamun (faerulsalamun@five-code.com) on 7/28/19, 9:01 PM
 * Last modified 7/28/19, 9:01 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class BaseController extends Controller
{
    private function getCode($code)
    {
        $serialized = [
            "1××" => "Informational.",
            "100" => "Continue.",
            "101" => "Switching Protocols.",
            "102" => "Processing.",
            "2××" => "Success.",
            "200" => "Success.",
            "201" => "Created.",
            "202" => "Accepted.",
            "203" => "Non-authoritative Information.",
            "204" => "No Content.",
            "205" => "Reset Content.",
            "206" => "Partial Content.",
            "207" => "Multi-Status.",
            "208" => "Already Reported.",
            "226" => "IM Used.",
            "3××" => "Redirection.",
            "300" => "Multiple Choices.",
            "301" => "Moved Permanently.",
            "302" => "Found.",
            "303" => "See Other.",
            "304" => "Not Modified.",
            "305" => "Use Proxy.",
            "307" => "Temporary Redirect.",
            "308" => "Permanent Redirect.",
            "4××" => "Client Error.",
            "400" => "Bad Request.",
            "401" => "Unauthorized.",
            "402" => "Payment Required.",
            "403" => "Forbidden.",
            "404" => "Not Found.",
            "405" => "Method Not Allowed.",
            "406" => "Not Acceptable.",
            "407" => "Proxy Authentication Required.",
            "408" => "Request Timeout.",
            "409" => "Conflict.",
            "410" => "Gone.",
            "411" => "Length Required.",
            "412" => "Precondition Failed.",
            "413" => "Payload Too Large.",
            "414" => "Request-URI Too Long.",
            "415" => "Unsupported Media Type.",
            "416" => "Requested Range Not Satisfiable.",
            "417" => "Expectation Failed.",
            "418" => "I'm a teapot.",
            "421" => "Misdirected Request.",
            "422" => "Unprocessable Entity.",
            "423" => "Locked.",
            "424" => "Failed Dependency.",
            "426" => "Upgrade Required.",
            "428" => "Precondition Required.",
            "429" => "Too Many Requests.",
            "431" => "Request Header Fields Too Large.",
            "444" => "Connection Closed Without Response.",
            "451" => "Unavailable For Legal Reasons.",
            "499" => "Client Closed Request.",
            "5××" => "Server Error.",
            "500" => "Internal Server Error.",
            "501" => "Not Implemented.",
            "502" => "Bad Gateway.",
            "503" => "Service Unavailable.",
            "504" => "Gateway Timeout.",
            "505" => "HTTP Version Not Supported.",
            "506" => "Variant Also Negotiates.",
            "507" => "Insufficient Storage.",
            "508" => "Loop Detected.",
            "510" => "Not Extended.",
            "511" => "Network Authentication Required.",
            "599" => "Network Connect Timeout Error.",
        ];

        return $serialized[$code];
    }

    public function respond($code = 200, $message = '', $data = '', $page = false)
    {
        $output['meta'] = [
            'code' => $code,
            'message' => empty($message) ? $this->getCode($code) : $message,
        ];

        if (!empty($data))
            $output['data'] = $page ? $data['data'] : $data;

        if ($page) {
            $output['page'] = [
                'from' => $data['from'],
                'to' => $data['to'],
                'current_page' => $data['current_page'],
                'last_page' => $data['last_page'],
                'per_page' => $data['per_page'],
                'total' => $data['total'],
            ];
        }

        return response()->json($output, $code);
    }


    public function respondv2($msg = '', $data = [], $error = true, $code = 200)
    {
        $res['result'] = $error;
        $res['text'] = empty($msg) ? $this->getCode($code) : $msg;

        if (!$error)
            $res['errors'] = $data;
        else {
            if (!empty($data))
                $res = array_merge($res, $data);
        }


        return response()->json($res, $code);
    }

    public function courseCodeGenerator($name, $char = 3, $number = 2)
    {
        $replace = preg_replace("/[^A-Za-z0-9]/", '', $name);
        $length = strlen($replace);
        $extra = '';

        if ($length < $char)
            $extra = $this->randomStr(3 - $length);

        $replace .= $extra;

        $sub_fst = strtoupper(substr($replace, 0, $char));
        $ran_2d = rand(pow(10, $number - 1), (pow(10, $number) - 1));

        $concat = $sub_fst . $ran_2d;

        if ($this->codeExists($concat))
            return $this->courseCodeGenerator($name, $char, $number);

        return $concat;
    }

    private function codeExists($referral)
    {
        return $this->courseRepository->where("course_code", $referral)->exists();
    }

    private function randomStr($length)
    {
        $random = str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 5));
        $take = substr($random, 0, $length);

        return $take;
    }


    function generate_code()
    {
        $first = 'CT';
        $day = substr(date('D'), 0, 1);
        $month = substr(date('F'), 0, 1);
        $year = substr(date('Y'), -1);

        do {
            $code = $first . $month . $day . $year . rand(10000000, 99999999);

            $count = Order::where('order_number', '=', $code)->count();
        } while ($count > 0);

        return $code;
    }

    function generate_unique($nominal)
    {
        do {
            $unique = rand(100, 999);
            $total = $nominal + $unique;

            $order = Order::where('order_total', '=', $total)->count();

            $count = $order;
        } while ($count > 0);

        return $unique;
    }
}
