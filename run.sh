docker-compose build
docker-compose up
docker exec -i hc_mysql db_import < Helpchannel.sql
