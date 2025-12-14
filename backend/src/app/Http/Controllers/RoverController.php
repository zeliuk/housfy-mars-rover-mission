<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Domain\Rover\Rover;
use Domain\Planet\Planet;

final class RoverController extends Controller
{
    public function execute(Request $request)
    {
        $data = $request->validate([
            'position.x' => 'required|integer',
            'position.y' => 'required|integer',
            'direction' => 'required|in:N,E,S,W',
            'commands' => 'required|string',

            'planet.width' => 'required|integer|min:1',
            'planet.height' => 'required|integer|min:1',
            'planet.obstacles' => 'array',
            'planet.obstacles.*.0' => 'required|integer',
            'planet.obstacles.*.1' => 'required|integer',
        ]);

        $planet = new Planet(
            $data['planet']['width'] - 1,
            $data['planet']['height'] - 1,
            $data['planet']['obstacles'] ?? []
        );

        $rover = new Rover(
            $data['position']['x'],
            $data['position']['y'],
            $data['direction']
        );

        try {
            $result = $rover->execute($data['commands'], $planet);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Unexpected error',
            ], 500);
        }

        if ($result !== null) {

            $obstacle = $result['obstacle'] ?? null;

            return response()->json([
                'status' => 'OBSTACLE',
                'position' => [
                    'x' => $rover->x(),
                    'y' => $rover->y(),
                ],
                'direction' => $rover->direction(),
                'obstacle' => $obstacle !== null ? [
                    'x' => $obstacle[0],
                    'y' => $obstacle[1],
                ] : null,
            ]);
        }


        return response()->json([
            'status' => 'OK',
            'position' => [
                'x' => $rover->x(),
                'y' => $rover->y(),
            ],
            'direction' => $rover->direction(),
        ]);
    }
}