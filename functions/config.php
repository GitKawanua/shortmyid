<?php

    $sejakThn   = 2019;
    $sampaiThn  = (int)date('Y');
    $url = $_SERVER['HTTP_HOST'];
    $urlbase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
    $defer = "defer";

// SITE NAME

if ( !defined('SITE_NAME') )
{
    define('SITE_NAME', "Short My ID");
}

if ( !defined('SITE_DESC') )
{
    define('SITE_DESC', "URL Shortener");
}

if ( !defined('SITE_AUTHOR') )
{
    define('SITE_AUTHOR', "Kawanua ID");
}

// URL LOCATION (Don't forget "/" at the end !)

if ( !defined('BASE_URL') )
{
    define('BASE_URL', $urlbase);
}

// DATABASE CONFIGURATION

if ( !defined('HOST_NAME') )
{
    define('HOST_NAME', "localhost:3306");
}

if ( !defined('DB_NAME') )
{
    define('DB_NAME', "");
}

if ( !defined('USER_NAME') )
{
    define('USER_NAME', "");
}

if ( !defined('USER_PASSWORD') )
{
    define('USER_PASSWORD', "");
}

// RECAPTCHA CONFIG

if ( !defined('SITE_KEY') )
{
    define('SITE_KEY', "YOUR_SITE_KEY");
}

if ( !defined('SECRET_KEY') )
{
    define('SECRET_KEY', "YOUR_SECRET_KEY");
}

function cssArray() {
    $cssList = array(
        "https://static.my.id/libs/bootstrap/4.3.1/css/bootstrap.min.css", 
        "https://static.my.id/libs/bootstrap-sweetalert/1.0.1/sweetalert.css", 
        "https://font.my.id/libs/inter/3.1.0/un/inter.css", 
        "https://font.my.id/libs/font-awesome/5.11.2/css/all.min.css", 
        "css/main.css" 
    );
    $cssSum = count($cssList);

    for($x = 0; $x < $cssSum; $x++) {
        echo '<link rel="stylesheet" href="' . $cssList[$x] . '">';
    }
}

function jsArray() {
    global $defer;
    $jsList = array(
        "https://static.my.id/libs/jquery/3.4.1/jquery.min.js", 
        "https://static.my.id/libs/popper.js/1.15.0/umd/popper.min.js", 
        "https://static.my.id/libs/bootstrap/4.3.1/js/bootstrap.min.js", 
        "https://font.my.id/libs/font-awesome/5.11.2/js/all.min.js", 
        "https://static.my.id/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"
    );
    $jsSum = count($jsList);

    for($x = 0; $x < $jsSum; $x++) {
        echo '<script ' . $defer . ' src="' . $jsList[$x] . '"></script>';
    }
}

function prefetchArray() {
    $fetchList = array(
        "//static.my.id", 
        "//font.my.id", 
        "//www.google.com", 
        "//www.gstatic.com",
        "//img.shields.io"
    );
    $fetchSum = count($fetchList);

    for($x = 0; $x < $fetchSum; $x++) {
        echo '<link rel="dns-prefetch" href="' . $fetchList[$x] . '">';
    }
}

function getDomainOnly($host){
    $host = strtolower(trim($host));
    $host = ltrim(str_replace("http://","",str_replace("https://","",$host)),"www.");
    $count = substr_count($host, '.');
    if($count === 2){
        if(strlen(explode('.', $host)[1]) > 3) $host = explode('.', $host, 2)[1];
    } else if($count > 2){
        $host = getDomainOnly(explode('.', $host, 2)[1]);
    }
    $host = explode('/',$host);
    return $host[0];
}

function showSponsor() {
    global $url, $host;
    $getdomain = getDomainOnly($host);
    $sponsorDiv = 'Localhost by Wampserver';
    $herokuDiv = 'Hosting by <a href="https://heroku.com" target="_blank" rel="noopener noreferrer"><strong>Heroku</strong></a>';

    switch ($url) {
        case "localhost";
            echo $sponsorDiv;
            break;
        case $getdomain == "herokuapp.com";
            echo $herokuDiv;
            break;
        default:
            echo 'Hosting by <a href="https://circlehosting.com" target="_blank" rel="noopener noreferrer"><strong>CircleHosting</strong></a>';
    }
}