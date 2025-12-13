<?php

//To avoid implicit type conversions and make the logic more predictable.
declare(strict_types=1);

namespace Domain\Rover;

final class Rover
{
    private const PLANET_MAX = 199;
    private array $obstacles;

    private int $x;
    private int $y;
    private string $direction;

    public function __construct(int $x, int $y, string $direction, array $obstacles = [])
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
        $this->obstacles = $obstacles;
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
        if ($this->direction === 'N' && $this->y < self::PLANET_MAX) {
            $this->y++;
            return;
        }

        if ($this->direction === 'E' && $this->x < self::PLANET_MAX) {
            $this->x++;
            return;
        }

        if ($this->direction === 'S' && $this->y > 0) {
            $this->y--;
            return;
        }

        if ($this->direction === 'W' && $this->x > 0) {
            $this->x--;
            return;
        }
    }

    private function nextPosition(): array
    {
        return match ($this->direction) {
            'N' => [$this->x, $this->y + 1],
            'E' => [$this->x + 1, $this->y],
            'S' => [$this->x, $this->y - 1],
            'W' => [$this->x - 1, $this->y],
        };
    }

    private function obstacleAhead(): ?array
    {
        [$nextX, $nextY] = $this->nextPosition();

        foreach ($this->obstacles as $obstacle) {
            if ($obstacle[0] === $nextX && $obstacle[1] === $nextY) {
                return $obstacle;
            }
        }

        return null;
    }

    public function execute(string $commands): ?array
    {
        foreach (str_split($commands) as $command) {

            if ($command === 'F') {
                $obstacle = $this->obstacleAhead();

                if ($obstacle !== null) {
                    return ['obstacle' => $obstacle];
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