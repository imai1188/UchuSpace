CREATE ROLE postgres WITH LOGIN PASSWORD 'password';
ALTER ROLE postgres WITH SUPERUSER CREATEDB CREATEROLE;
