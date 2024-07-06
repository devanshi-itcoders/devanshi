<?php

/**
 * Encrypt data with base64
 */
if(!function_exists('encryptData')){
    function encryptData($encryptPhrase) {
        return base64_encode($encryptPhrase);
    }
}

/**
 * Decrypt data with base64
 */
if(!function_exists('decryptData')){
    function decryptData($decryptPhrase) {
        return base64_decode($decryptPhrase);
    }
}