c:\xampp\mysql\bin\mysql.exe -u root -e "DROP DATABASE IF EXISTS evaluasi_kurikulum; CREATE DATABASE evaluasi_kurikulum;"
c:\xampp\mysql\bin\mysql.exe -u root evaluasi_kurikulum < database\schema.sql
c:\xampp\mysql\bin\mysql.exe -u root evaluasi_kurikulum < database\seed.sql
