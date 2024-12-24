
drop table if exists perusahaan;
create table perusahaan(
    id_perusahaan bigint  primary key not null auto_increment,
    id_pendaftar int (10),
    logo_perusahaan LONGBLOB,
    nama_perusahaan varchar(100) not null,
    website varchar(100),  
    alamat_perusahaan text,
    email_perusahaan varchar(50),
    telp_perusahaan varchar(20),
    industri varchar(100),
    deskripsi_perusahaan text,
    status_aktif enum ('0', '1') default '0',
    status_berlangganan enum ('Free', 'Premium') default 'Free', 
    created_at datetime,
    created_by int(10),
    updated_at datetime,
    updated_by int(10)
); 