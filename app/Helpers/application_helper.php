<?php

if (!function_exists('toJSON')) {
    /**
     * @param array $array
     * @return string
     */
    function toJSON(array $array) :string {
        try {
            return json_encode($array, JSON_THROW_ON_ERROR);
        }
        catch (JsonException $exception) {
            if (ENVIRONMENT !== 'production') {
                die('Error in application_helper.php::toJSON; Message: ' . $exception->getMessage());
            }

            return '{}';
        }
    }
}

if (!function_exists('toArray')) {
    /**
     * @param string $json
     * @return array
     */
    function toArray(string $json) :array {
        try {
            return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        }
        catch (JsonException $exception) {
            if (ENVIRONMENT !== 'production') {
                die('Error in application_helper.php::toArray; Message: ' . $exception->getMessage());
            }

            return [];
        }
    }
}

if (!function_exists('formatTimestampAsDate')) {
    /**
     * @param string $timestamp
     * @return string
     */
    function formatTimestampAsDate(string $timestamp) :string {
        try {
            return (new DateTime($timestamp))->format('d.m.Y');
        }
        catch (Exception $exception) {
            if (ENVIRONMENT !== 'production') {
                die('Error in application_helper.php::formatTimestampAsDate; Message: ' . $exception->getMessage());
            }

            return '';
        }
    }
}