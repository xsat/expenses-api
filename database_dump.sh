#!/bin/bash

# This is path to your directory with mysqldump
path='C:\xampp\mysql\bin\'

# Your database name
database=waste_of_money

${path}mysqldump --host=localhost \
                --user=root \
                --no-data \
                --result-file=${database}.sql \
                --databases ${database}
