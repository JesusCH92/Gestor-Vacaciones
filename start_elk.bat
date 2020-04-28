@echo off

title start_elk
echo Starting ELK...
docker-compose -f docker-composer.elk.yml up
pause
