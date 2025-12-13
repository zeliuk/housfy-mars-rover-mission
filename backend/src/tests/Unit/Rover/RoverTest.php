<?php

declare(strict_types=1);

namespace Tests\Unit\Rover;

use PHPUnit\Framework\TestCase;
use Domain\Rover\Rover;
use Domain\Planet\Planet;

final class RoverTest extends TestCase
{
    public function test_rover_starts_with_position_and_direction(): void
    {
        $rover = new Rover(0, 0, 'N');

        $this->assertSame(0, $rover->x());
        $this->assertSame(0, $rover->y());
        $this->assertSame('N', $rover->direction());
    }

    //Rover turns right test
    public function test_rover_turns_right_from_north_to_east(): void
    {
        $rover = new Rover(0, 0, 'N');
        $rover->turnRight();
        $this->assertSame('E', $rover->direction());
    }

    public function test_rover_turns_right_from_east_to_south(): void
    {
        $rover = new Rover(0, 0, 'E');
        $rover->turnRight();
        $this->assertSame('S', $rover->direction());
    }

    public function test_rover_turns_right_from_south_to_west(): void
    {
        $rover = new Rover(0, 0, 'S');
        $rover->turnRight();
        $this->assertSame('W', $rover->direction());
    }

    public function test_rover_turns_right_from_west_to_north(): void
    {
        $rover = new Rover(0, 0, 'W');
        $rover->turnRight();
        $this->assertSame('N', $rover->direction());
    }

    //Rover turns left test
    public function test_rover_turns_left_from_north_to_west(): void
    {
        $rover = new Rover(0, 0, 'N');
        $rover->turnLeft();
        $this->assertSame('W', $rover->direction());
    }

    public function test_rover_turns_left_from_west_to_south(): void
    {
        $rover = new Rover(0, 0, 'W');
        $rover->turnLeft();
        $this->assertSame('S', $rover->direction());
    }

    public function test_rover_turns_left_from_south_to_east(): void
    {
        $rover = new Rover(0, 0, 'S');
        $rover->turnLeft();
        $this->assertSame('E', $rover->direction());
    }

    public function test_rover_turns_left_from_east_to_north(): void
    {
        $rover = new Rover(0, 0, 'E');
        $rover->turnLeft();
        $this->assertSame('N', $rover->direction());
    }

    //Rover forward test
    public function test_rover_moves_forward_when_north(): void
    {
        $rover = new Rover(0, 0, 'N');

        $rover->moveForward();

        $this->assertSame(0, $rover->x());
        $this->assertSame(1, $rover->y());
        $this->assertSame('N', $rover->direction());
    }

    public function test_rover_moves_forward_when_east(): void
    {
        $rover = new Rover(0, 0, 'E');

        $rover->moveForward();

        $this->assertSame(1, $rover->x());
        $this->assertSame(0, $rover->y());
        $this->assertSame('E', $rover->direction());
    }

    public function test_rover_moves_forward_when_south(): void
    {
        $rover = new Rover(1, 1, 'S');

        $rover->moveForward();

        $this->assertSame(1, $rover->x());
        $this->assertSame(0, $rover->y());
        $this->assertSame('S', $rover->direction());
    }

    public function test_rover_moves_forward_when_west(): void
    {
        $rover = new Rover(1, 1, 'W');

        $rover->moveForward();

        $this->assertSame(0, $rover->x());
        $this->assertSame(1, $rover->y());
        $this->assertSame('W', $rover->direction());
    }

    //Rover commands
    public function test_rover_executes_single_left_command(): void
    {
        $planet = new Planet(199, 199);
        $rover = new Rover(0, 0, 'N');
        $rover->execute('L', $planet);
        $this->assertSame('W', $rover->direction());
    }

    public function test_rover_executes_multiple_commands(): void
    {
        $planet = new Planet(199, 199);
        $rover = new Rover(0, 0, 'N');

        $rover->execute('FFR', $planet);

        $this->assertSame(0, $rover->x());
        $this->assertSame(2, $rover->y());
        $this->assertSame('E', $rover->direction());
    }

    //Rover mars planet limit
    public function test_rover_does_not_move_beyond_northern_limit(): void
    {
        $planet = new Planet(199, 199);
        $rover = new Rover(0, 199, 'N');

        $rover->execute('F', $planet);

        $this->assertSame(0, $rover->x());
        $this->assertSame(199, $rover->y());
    }

    public function test_rover_does_not_move_beyond_southern_limit(): void
    {
        $planet = new Planet(199, 199);
        $rover = new Rover(0, 0, 'S');

        $rover->execute('F', $planet);

        $this->assertSame(0, $rover->x());
        $this->assertSame(0, $rover->y());
    }

    public function test_rover_does_not_move_beyond_eastern_limit(): void
    {
        $planet = new Planet(199, 199);
        $rover = new Rover(199, 0, 'E');

        $rover->execute('F', $planet);

        $this->assertSame(199, $rover->x());
        $this->assertSame(0, $rover->y());
    }

    public function test_rover_does_not_move_beyond_western_limit(): void
    {
        $planet = new Planet(199, 199);
        $rover = new Rover(0, 0, 'W');

        $rover->execute('F', $planet);

        $this->assertSame(0, $rover->x());
        $this->assertSame(0, $rover->y());
    }

    //Rover reports obstacle
    public function test_rover_stops_and_reports_obstacle(): void
    {
        $planet = new Planet(199, 199, [[0, 1]]);
        $rover = new Rover(0, 0, 'N');

        $result = $rover->execute('F', $planet);

        $this->assertSame(0, $rover->x());
        $this->assertSame(0, $rover->y());
        $this->assertSame([0, 1], $result['obstacle']);
    }


}