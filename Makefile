.DEFAULT_GOAL := help
help:
	@echo "Available commands: up down logs"
up:
	docker compose up -d
down:
	docker compose down
logs:
	docker compose logs -f