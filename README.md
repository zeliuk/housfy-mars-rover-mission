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

The project follows a Test-Driven Development (TDD) approach using PHPUnit.

The core business logic is implemented in a framework-independent domain layer,
located in the `Domain` directory. This domain is not coupled to Laravel or HTTP.

Tests are written first under `tests/Unit`, and production code is implemented
incrementally to satisfy those tests.

---

## Domain structure

The `Rover` domain model represents the rover state (position and direction).

At this stage, the Rover only exposes its initial state. All behavior is added
progressively following TDD principles.

All domain classes use strict typing to avoid implicit type conversions and ensure
predictable behavior.

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