drop table if exists password_reset;
create table password_reset(
    id_reset int(10) primary key not null auto_increment,  
    tabel enum('perusahaan_pendaftar', 'karyawans') COMMENT 'pendaftar / karyawan',   
    email varchar(50) not null,
    link varchar(225) not null  COMMENT 'hash nama:email:created_at', 
    kadaluarsa datetime,  
    create_new datetime COMMENT ' tgl create pswd baru',
    created_at datetime
);