-- Dilakukan oleh HR / Admin --
drop table if exists perusahaan_department_divisi;
create table perusahaan_department_divisi(
    id_divisi int(10) primary key not null auto_increment,
    id_department int(10) not null,  
    id_perusahaan int(10) not null,  
    nama_divisi varchar(100),
    deskripsi_divisi text,
    created_at datetime,
    created_by int(10),
    updated_at timestamp,
    updated_by int(10)
);
 