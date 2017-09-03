#!/bin/bash

# This is the path to your directory with mysqldump
path='C:\xampp\mysql\bin\'

# Your database name
database=expenses

${path}mysqldump --host=localhost \
                 --user=root \
                 --no-data \
                 --result-file=${database}.sql \
                 --databases ${database}
