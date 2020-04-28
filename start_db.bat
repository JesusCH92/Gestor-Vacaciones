@echo off

title start_db
echo Starting Database...
docker-compose -f docker-composer.db.yml up
pause
