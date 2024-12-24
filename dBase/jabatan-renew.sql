 
-- Dilakukan oleh HR / Admin --
drop table if exists perusahaan_jabatan;
create table perusahaan_jabatan (
    id_jabatan int(10) primary key not null auto_increment,
    id_perusahaan int(10) not null,  
    -- id_department int(10) not null,  --
    nama_jabatan varchar(100),  
    kode_jabatan varchar(100),
    deskripsi_jabatan text,
    created_at datetime,
    created_by int(10),
    updated_at timestamp,
    updated_by int(10)
); 