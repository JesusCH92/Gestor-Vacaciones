## Levantar entorno
- docker-compose -f docker-compose.yml -f docker-compose.db.yml up -d

## bajar el entorno
- docker rm -f $(docker ps -a -q)