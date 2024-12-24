-- Dilakukan oleh karywan -- 
drop table if exists absensi;
create table absensi(
    id_absensi bigint primary key not null auto_increment,
    id_perusahaan bigint not null,  
    id_karyawan bigint not null, 
    valid_date date COMMENT "tgl yg seharusnya, tool untuk keterlambatan", 
    valid_day varchar(10) COMMENT "hari yg seharusnya", 
    shift int(2),   
    latlong_masuk varchar(100),
    lokasi_masuk varchar(100) COMMENT "nama lokasi absen tdk pke id", 
    jam_masuk datetime,
    foto_masuk LONGBLOB,
    latlong_pulang varchar(100),
    lokasi_pulang varchar(100) COMMENT "nama lokasi absen tdk pke id", 
    jam_pulang datetime,
    foto_pulang LONGBLOB,
    total_waktu varchar(20),
    created_at datetime, 
    updated_at timestamp 
);
 
 