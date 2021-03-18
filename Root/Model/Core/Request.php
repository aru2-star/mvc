<?php
class Model_Core_Request
{
    public function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        }
        return false;
    }


    public function getGet($value = null, $optional = null)
    {
        if (!$value) {
            return $_GET;
        }

        if (array_key_exists($value, $_GET)) {
            return $_GET[$value];
        }

        return $optional;
    }

    public function getPost($value = null, $optional = null)
    {
        if (!$value) {
            return $_POST;
        }

        if (array_key_exists($value, $_POST)) {
            return $_POST[$value];
        }

        return $optional;
    }
}
