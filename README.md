# Mars Rover Kata

This project is an implementation of the Mars Rover Kata.
The main goal is to practice clean code and simple architecture, using tests to guide the implementation.

The project simulates a rover moving on a square planet.
The rover receives commands and moves step by step.
If an obstacle is found, the rover stops and reports it.

---

## Tech Stack

- Backend: Laravel 10 with PHP 8.2
- Frontend: Vue.js 3
- Tests: PHPUnit
- Environment: Docker

---

## Problem Description

The rover starts at a position `(x, y)` and faces a direction:
`N`, `E`, `S` or `W`.

Commands:
- `F` → move forward
- `L` → turn left
- `R` → turn right

Before moving forward, the rover checks for obstacles.
If an obstacle is detected:
- the rover stops
- the remaining commands are not executed
- the obstacle position is returned

The planet is a square grid of **200 × 200**.
The rover cannot leave the planet limits.

---

## Development Approach

The project follows a Test-Driven Development approach.
Core rover logic is implemented as a separate domain layer,
independent from HTTP and framework concerns.

---

## Project setup

The project is fully Dockerized. A single `docker-compose.yml` file at the root
starts both backend (Laravel 10) and frontend (Vue.js).

The backend runs on PHP 8.2 and is exposed as an API-only Laravel application.

---

## Testing and TDD

The project uses **PHPUnit** for testing.

All business rules are tested at the unit level, focusing on observable behavior
rather than implementation details.

Tests are located under:

```
tests/Unit
```

The domain logic is tested independently from the framework.

---

## Domain Structure

The domain is implemented under the `Domain` namespace and is independent from Laravel.

### Rover

The `Rover` domain model represents:
- current position (`x`, `y`)
- current direction (`N`, `E`, `S`, `W`)
- execution of command sequences

The rover:
- can turn left and right
- can move forward
- executes commands sequentially
- aborts execution when an obstacle or invalid move is detected

### Planet

The `Planet` domain model represents:
- planet limits (200 × 200)
- obstacle positions

The planet is responsible for deciding whether a position is valid.

---

## Run the Project

### Requirements
- Docker
- Docker Compose

### Start the project (backend + frontend)

From the project root:

```bash
docker compose up --build
```

This command starts:
- Laravel backend (API) on http://localhost:8000
- Vue frontend on http://localhost:5173

---

## Run the tests

From the project root:

```bash
docker compose exec backend php artisan test
```

This runs the PHPUnit test suite inside the Docker container.