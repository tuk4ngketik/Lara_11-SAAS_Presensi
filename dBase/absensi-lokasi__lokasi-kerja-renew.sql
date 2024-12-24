-- MEnentukasn lokasi kerja --
drop table if exists absensi_lokasi;
create table absensi_lokasi(
    id_lokasi int(20) primary key not null auto_increment,
    id_perusahaan int(20) not null,
    nama_lokasi varchar(100),
    lat varchar(30),
    lgt varchar(30), 
    alamat_lokasi text,
    deskripsi_lokasi text, 
    max_jarak varchar(10), 
    created_at datetime,
    created_by int(10),
    updated_at timestamp,
    updated_by int(10)
);  