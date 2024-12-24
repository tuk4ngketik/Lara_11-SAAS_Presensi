-- Dilakukan oleh karywan -- 
drop table if exists pengajuan_klaim;
create table pengajuan_klaim(
    id_klaim int(10)  primary key not null auto_increment,
    id_karyawan bigint not null,   
    id_perusahaan bigint not null,   
    judul_klaim varchar(100) not null COMMENT "Parkir, Kwitansi, reimburse Obat, dll",
    keterangan_klaim tinytext,
    created_by int(10),
    updated_by int(10),
    created_at datetime,
    updated_at timestamp
);
 
drop table if exists pengajuan_jenis_klaim_foto;
create table pengajuan_klaim_foto(
    id_foto_klaim int(10)  primary key not null auto_increment,
    id_klaim bigint not null COMMENT "Foto klaim | tb => pengajuan_klaim",   
    foto_klaim  LONGBLOB  COMMENT 'bukti foto klaim berupa surat, kwitansi dll',  
    created_at datetime,
    updated_at timestamp
);
