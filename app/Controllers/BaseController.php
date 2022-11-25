<?php

namespace App\Controllers;

abstract class BaseController
{
    public function render(string $view, array $variables): ?array
    {
        if (count($variables)) {
            extract($variables);
        }

        require_once "views/" . $view . ".php";
        return $variables;
    }
}