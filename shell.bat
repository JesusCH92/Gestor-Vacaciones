@echo off

title shell
docker run --rm -it -v %CD%:/app --env-file %CD%/docker.env --network=lasalle_network fnandot/php-cli:7.3-mpwar /bin/zsh -l
