 
drop table if exists attr_pendidikan; 
create table attr_pendidikan(
        pendidikan varchar(10) not null,
        created_at datetime,
        created_by int(2),
        updated_at timestamp,
        updated_by int(2)
);


 INSERT INTO attr_pendidikan(pendidikan, created_at, created_by )
    VALUES ('-',   NOW(), 0 ),
           ('SD',   NOW(), 0 ),
           ( 'SLTP',   NOW(), 0 ),
           ( 'SLTA',   NOW(), 0 ),
           ( 'D1',   NOW(), 0 ),
           ( 'D2',   NOW(), 0 ),
           ( 'D3',  NOW(), 0 ),
           ( 'S1',  NOW(), 0 ), 
           ( 'S2',   NOW(), 0 ),
           ( 'S3',  NOW(), 0 );


-- Dilakukan oleh HR / Admin --
drop table if exists karyawans;
create table karyawans(
    id_karyawan bigint primary key not null auto_increment,
    id_perusahaan bigint not null,
    id_department int(10),
    id_divisi int(10),
    id_jabatan int(10),
    id_lokasi int(10),  
    id_waktu int(10) COMMENT 'jam kerja default, id tb: absensi_waktu',  
    nik varchar(30) not null,
    nama_karyawan varchar(100),
    foto_karyawan LONGBLOB  COMMENT 'foto full karyawan',
    foto_extract LONGBLOB COMMENT 'face extract', 
    pendidikan varchar(10),
    tgl_lahir date,
    tempat_lahir varchar(50),
    telp_karyawan varchar(20),
    email_karyawan varchar(50),
    password_karyawan varchar(225),
    alamat_karyawan text,
    tgl_bergabung date, 
    status_karyawan enum ('Karyawan Tetap', 'Karyawan Kontrak', 'Harian', 'Magang'),
    status_pernikahan enum('Menikah', 'Belum Menikah'), 
    created_at datetime,
    created_by int(10),
    updated_at timestamp,
    updated_by int(10)
); 
