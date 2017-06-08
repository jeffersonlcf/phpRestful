<?php
/* DB CONFIG */
define ( "DB_HOST", 'localhost' );
define ( "DB_USER", 'root' );
define ( "DB_PASSWORD", '' );
define ( "DB_NAME", 'finalproject' );
define ( "DB_CHARSET", 'utf8' );
define ( "DB_DEBUGMODE", 1 );
define ( "DB_VENDOR", 'mysql' );

/* ROUTES CONFIG */
define ( "ROUTE_STUDENT", 'students' );
define ( "ROUTE_ANSWERS", 'answers' );
define ( "ROUTE_AVERAGE", 'avg' );
define ( "ROUTE_STANDAR", 'std' );

/* AUTHENTICATION */
define ( "AUTH_USER", 'user' );
define ( "AUTH_PASS", 'pass' );

/* HTTP status codes 2xx */
define ( "HTTPSTATUS_OK", 200 );
define ( "HTTPSTATUS_CREATED", 201 );
define ( "HTTPSTATUS_NOCONTENT", 204 );

/* HTTP status codes 3xx (with slim the output is not produced i.e. echo statements are not processed) */
define ( "HTTPSTATUS_NOTMODIFIED", 304 );

/* HTTP status codes 4xx */
define ( "HTTPSTATUS_BADREQUEST", 400 );
define ( "HTTPSTATUS_UNAUTHORIZED", 401 );
define ( "HTTPSTATUS_FORBIDDEN", 403 );
define ( "HTTPSTATUS_NOTFOUND", 404 );
define ( "HTTPSTATUS_REQUESTTIMEOUT", 408 );
define ( "HTTPSTATUS_TOKENREQUIRED", 499 );

/* HTTP status codes 5xx */
define ( "HTTPSTATUS_INTSERVERERR", 500 );

?>