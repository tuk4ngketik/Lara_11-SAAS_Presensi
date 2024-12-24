-- Dilakukan oleh HR / Admin --
drop table if exists perusahaan_department;
create table perusahaan_department(
    id_department int(10) primary key not null auto_increment,
    id_perusahaan int(10) not null,  
    nama_department varchar(100),
    deskripsi_department text,
    created_at datetime,
    created_by int(10),
    updated_at timestamp,
    updated_by int(10)
);
 