<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

class Route 
{

    static $routes = [

    ];

    function assetsLocal($path, $cached = true) {
        $p = str_replace('\\', '/', dirname(dirname(debug_backtrace()[0]['file'])));
        $p = substr($p, strpos($p, 'src')+3);
        
        $prefixUrl = $p;
        $urlFinal = $prefixUrl . '/assets/' . $path;

        $prefixFisico = Route::getRouteAction($urlFinal . '/(.*)');

        $caminhoFinal = $prefixFisico;

        if (!$cached)
            return $urlFinal;
        
        $finalPath = $urlFinal . '/' . pathinfo($path, PATHINFO_FILENAME) . '.' . pathinfo($path, PATHINFO_EXTENSION) . '?_=' . filemtime($caminhoFinal);

        return $finalPath;
    }

    function getRouteAction($uri) {

        $founds = null;

        foreach (self::$routes as $route) {
            // die(var_dump($route));
            if (@preg_match($route->pattern, $uri, $f)) {

                $args = [];
                foreach ($route->parameters as $p => $pa) {

                    $pa = str_replace('}', '', str_replace('{', '', $pa));

                    $args[$pa] = @explode('/', $uri)[$p];

                    // die(var_dump($route->parameters, , explode('/', $route->uri)[$p]));
                    // // die(var_dump($));

                    // if (preg_match("/".$pa['regex']."/", $uri, $val))
                    //     die(var_dump($val));
                    
                }
                
                $route->query_params = $args;
                // die(var_dump($args));
                
                $founds = $route->action;
            }

        }

        

        return $founds;
    }

}

function translate($data, $options = [], $default = '') {

    $data = strtolower($data);
    $options = array_change_key_case($options);

    if (array_key_exists($data, $options))
        return $options[$data];

    return $default;

}

function pdo_sql_debug($sql_string, array $params = null) {
    if (!empty($params)) {
        $indexed = $params == array_values($params);
        foreach($params as $k=>$v) {
            if (is_object($v)) {
                if ($v instanceof \DateTime) $v = $v->format('Y-m-d H:i:s');
                else continue;
            }
            elseif (is_string($v)) $v="'$v'";
            elseif ($v === null) $v='NULL';
            elseif (is_array($v)) $v = implode(',', $v);

            if ($indexed) {
                $sql_string = preg_replace('/\?/', $v, $sql_string, 1);
            }
            else {
                if ($k[0] != ':') $k = ':'.$k; //add leading colon if it was left out
                $sql_string = str_replace($k,$v,$sql_string);
            }
        }
    }
    return $sql_string;
}


function prepare($sql, $columns = [], $mode = PDO::FETCH_OBJ, $all = false) {
    global $pdo;

    $results = new StdClass();

    $results->columns = null;
    $results->sql = pdo_sql_debug($sql, $columns);
    $results->query = null;
    $results->count = null;
    $results->data = null;
    $results->exception = null;
    $results->id = null;
    $results->status = null;

    try {
        $query = $pdo->prepare($sql);
        $query->execute($columns);

        $results->columns = $columns;
        $results->query = (bool) $query;
        $results->count = $query->rowCount();

        if (!empty($mode)) {
            $type = $all ? 'fetchAll' : 'fetch'; 
            $results->data = $query->rowCount() > 0 ? $query->$type($mode) : [];
            
        }
        else
            $results->id = $pdo->lastInsertId();

            
    } catch (\Throwable $th) {
        $results->exception = str_replace(' at row 1', '', $th->errorInfo[0]);
    }
    
    $results->status = !empty($results->query);

    return $results;
}

function prepareAll($sql, $columns = [], $mode = PDO::FETCH_OBJ) {
return prepare($sql, $columns, $mode, true);
}

function response($arr = [], $code = 200, $sleep = 0, $type = 'json', $headers = []) {
    global $_REQ;
    
    $statusCode = [
        500 => "HTTP/1.1 500 Internal Server Error",

        429 => "HTTP/1.1 429 Too Many Requests",
        422 => "HTTP/1.1 422 Unprocessable Entity",
        405 => "HTTP/1.1 405 Method Not Allowed",
        404 => "HTTP/1.1 404 Not Found",
        403 => "HTTP/1.1 403 Forbidden",
        401 => "HTTP/1.1 401 Unauthorized",
        400 => "HTTP/1.1 400 Bad Request",

        200 => "HTTP/1.1 200 OK",
        201 => "HTTP/1.1 201 Created",
        204 => "HTTP/1.1 204 No Content",
    ];

    // HEADERS

    header(translate($code, $statusCode, 200));
    header('Content-Type: application/json');
    header('X-Powered-By: PRODESP');
    // header("Access-Control-Allow-Origin: *");
    // header('Access-Control-Allow-Credentials: true');

    foreach ($headers as $h => $header) {
        header($header);
    }

    sleep($sleep);

    // RESPONSE

    if (!empty($arr))
        die(json_encode($arr));

    exit;
}

function dd() {
    return die(dump(func_get_args()));
}


// function encryptData($data, $key) {
//     $cipher = "AES-256-CBC";
//     $iv = random_bytes(openssl_cipher_iv_length($cipher));
//     $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
//     return base64_encode($encrypted . '::' . $iv);
// }

// function decryptData($encryptedEmail, $key) {
    
//     $cipher = "AES-256-CBC";
  
//     // Verifica se a string contém o separador '::'
//     if (strpos(base64_decode($encryptedEmail), '::') === false) {
//         return false; // Se não tiver '::', os dados estão corrompidos
//     }
    
//     list($encryptedData, $iv) = explode('::', base64_decode($encryptedEmail), 2); // Separa os dados criptografados do IV

//     // Verifica se ambos os componentes estão presentes
//     if (!isset($encryptedData, $iv)) {
//         return false;
//     }

//     // Verifica o comprimento do IV
//     $ivLength = openssl_cipher_iv_length($cipher);
//     if (strlen($iv) !== $ivLength) {
//         return false; // Se o IV não tiver o tamanho correto
//     }


//     // Descriptografa o email
//     return openssl_decrypt($encryptedData, $cipher, $key, 0, $iv);
// }