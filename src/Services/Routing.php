<?php

namespace src\Services;

final class Routing
{
    public static function routeComposee(string $route): array
    {
        $routeComposee = ltrim($route, HOME_URL);
        $routeComposee = rtrim($routeComposee, '/');
        $routeComposee = explode('/', $routeComposee);

        for ($i = sizeof($routeComposee); $i < 4; $i++) {
            $routeComposee[$i] = null;
        }
        return $routeComposee;
    }
}
