  
-- Dilakukan oleh HR / Admin --
drop table if exists karyawan_nonaktif_recs;
create table karyawan_nonaktif_recs(
    id_nonaktif int(20) primary key not null auto_increment,
    id_karyawan int(10) not null COMMENT 'agar bs merujuk ke karyawan_keluarga jika masuk lgi',
    id_perusahaan int(10) not null, 
    nama_karyawan varchar(50),
    tgl_lahir date,
    telp_karyawan varchar(50),
    alamat_karyawan varchar(50),
    nama_jabatan varchar(50) COMMENT 'tdk prlu id nama langsung',
    nama_department varchar(50)  COMMENT 'tdk prlu id nama langsung',
    nama_divisi varchar(50) COMMENT 'tdk prlu id nama langsung',
    tgl_non_aktif date  COMMENT 'tgl non aktif agar bs kpn saja',
    alasan_non_aktif enum('Keluar','Pensiun','Pecat') not null, 
    keterangan text, 
    created_at datetime,
    created_by int(10),
    updated_at timestamp,
    updated_by int(10)
); 
