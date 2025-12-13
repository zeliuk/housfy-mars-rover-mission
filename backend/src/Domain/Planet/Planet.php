<?php

declare(strict_types=1);

namespace Domain\Planet;

final class Planet
{
    private int $maxX;
    private int $maxY;
    private array $obstacles;

    public function __construct(int $maxX, int $maxY, array $obstacles = [])
    {
        $this->maxX = $maxX;
        $this->maxY = $maxY;
        $this->obstacles = $obstacles;
    }

    public function roverCanMoveTo(int $x, int $y): bool
    {
        // planet limits
        if ($x < 0 || $y < 0 || $x > $this->maxX || $y > $this->maxY) {
            return false;
        }

        // obstacles
        foreach ($this->obstacles as $obstacle) {
            if ($obstacle[0] === $x && $obstacle[1] === $y) {
                return false;
            }
        }

        return true;
    }

    public function planetObstacleAt(int $x, int $y): ?array
    {
        foreach ($this->obstacles as $obstacle) {
            if ($obstacle[0] === $x && $obstacle[1] === $y) {
                return $obstacle;
            }
        }

        return null;
    }
}