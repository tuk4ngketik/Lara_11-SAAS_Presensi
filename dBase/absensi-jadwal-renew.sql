 
-- Dilakukan oleh HR / Admin --
-- Table penjadualan karyawan -- 
drop table if exists absensi_jadwal;
create table absensi_jadwal(
    id_jadwal int(20) primary key not null auto_increment,
    id_lokasi int(10)  COMMENT 'tb => absensi lokasi, jika val "0" = tdk ditentukan lokasinya',
    id_waktu int(10)  COMMENT 'tb => absensi waktu, jika val "0" = tdk ditentukan waktunya', 
    id_perusahaan int(10) not null,   
    id_karyawan int(10) not null,   
    tgl_awal date,
    tgl_akhir date,
    created_at datetime,
    created_by int(10),
    updated_at timestamp,
    updated_by int(10) 
); 