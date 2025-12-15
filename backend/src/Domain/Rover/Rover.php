<?php

declare(strict_types=1);

namespace Domain\Rover;
use Domain\Planet\Planet;

final class Rover
{
    private int $x;
    private int $y;
    private string $direction;

    public function __construct(int $x, int $y, string $direction)
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function direction(): string
    {
        return $this->direction;
    }

    public function turnRight(): void
    {
        $directions = ['N', 'E', 'S', 'W'];
        $currentIndex = array_search($this->direction, $directions, true);
        $this->direction = $directions[($currentIndex + 1) % count($directions)];
    }

    public function turnLeft(): void
    {
        $directions = ['N', 'W', 'S', 'E'];
        $currentIndex = array_search($this->direction, $directions, true);
        $this->direction = $directions[($currentIndex + 1) % count($directions)];
    }

    public function moveForward(): void
    {
        match ($this->direction) {
            'N' => $this->y++,
            'E' => $this->x++,
            'S' => $this->y--,
            'W' => $this->x--,
        };
    }

    // Calculates the next position without mutating the rover state
    private function nextPosition(): array
    {
        return match ($this->direction) {
            'N' => [$this->x, $this->y + 1],
            'E' => [$this->x + 1, $this->y],
            'S' => [$this->x, $this->y - 1],
            'W' => [$this->x - 1, $this->y],
        };
    }

    // Executes commands sequentially and stops at the first obstacle found
    public function execute(string $commands, Planet $planet): ?array
    {
        foreach (str_split($commands) as $command) {

            if ($command === 'F') {
                [$nextX, $nextY] = $this->nextPosition();

                if (! $planet->roverCanMoveTo($nextX, $nextY)) {
                    return ['obstacle' => $planet->planetObstacleAt($nextX, $nextY)];
                }

                $this->moveForward();
                continue;
            }

            match ($command) {
                'L' => $this->turnLeft(),
                'R' => $this->turnRight(),
                default => null,
            };
        }

        return null;
    }


}