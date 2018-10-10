<?php

return new \Phalcon\Config([
    'logger' => [
        'dir' => __Dir__.'/../../logs'
    ],
    'database' => [
        'adapter'     => 'Mongo',
        'host'        => '172.27.0.3',
        'username'    => '',
        'password'    => '',
        'dbname'      => 'test',
        'charset'     => 'utf8',
        'timeout'     => 5000
    ],
    'jwt' => [
        'key' => 'TEST-PHALCON-2018'
        # This is the Bearer token.
        # eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IlRFU1QtUEhBTENPTiIsImlhdCI6MTUxNjIzOTAyMn0._hJ3s4C0snRT7oBFA7CDDxTggOAZf7ZxR1DzKYQOVxQ
    ],
]);
