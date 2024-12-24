--   Users adalah orng yg mendaftar diri 
drop table if exists perusahaan_pendaftar;
create table perusahaan_pendaftar(
    id_pendaftar int(10) primary key not null auto_increment,
    nama varchar(100) not null,  
    email varchar(50)not null,
    password varchar(225) not null,
    telp varchar(20),
    aipi varchar(10),
    hash_verifikasi varchar(100),
    maks_verifikasi datetime,
    terverifikasi enum('Y', 'N') default 'N',
    created_at datetime, 
    updated_at timestamp
);

-- Dilakukan oleh HR / Admin
drop table if exists perusahaan;
create table perusahaan(
    id_perusahaan int(10) primary key not null auto_increment,
    id_pendaftar int (10),
    logo_perusahaan varchar(100),
    nama_perusahaan varchar(100) not null,  
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


-- Dilakukan oleh HR / Admin
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
 

-- Dilakukan oleh HR / Admin
drop table if exists perusahaan_jabatan;
create table perusahaan_jabatan (
    id_jabatan int(10) primary key not null auto_increment,
    id_perusahaan int(10) not null,  
    id_department int(10) not null,  
    nama_jabatan varchar(100),  
    kode_jabatan varchar(100),
    deskripsi_jabatan text,
    created_at datetime,
    created_by int(10),
    updated_at datetime,
    updated_by int(10)
);

-- Dilakukan oleh HR / Admin
drop table if exists karyawans;
create table karyawans(
    id_karyawan int(10) primary key not null auto_increment,
    id_perusahaan int(10) not null,
    id_jabatan int(10),
    id_lokasi int(10),  
    nik varchar(30) not null,
    nama_karyawan varchar(100),
    pendidikan enum ('-','SD', 'SLTP','SLTA', 'D3', 'S1', 'S2', 'S3'),
    tgl_lahir date,
    tempat_lahir varchar(20),
    telp_karyawann varchar(20),
    email_karyawann varchar(50),
    passwd_karyawann varchar(225),
    alamat_karyawan text,
    tgl_bergabung date,
    status_karyawan enum ('Karyawan Tetap', 'Kontrak', 'Harian', 'Magang'),
    status_pernikahan enum('Menikah', 'Belum Menikah'),
    status_aktif enum ('Y', 'N'),
    created_at datetime,
    created_by int(10),
    updated_at datetime,
    updated_by int(10)
); 


-- Dilakukan oleh HR / Admin
drop table if exists karyawan_keluarga;
create table karyawan_keluarga(
    id_keluarga int(10) primary key not null auto_increment,
    id_karyawan int(10) not null,
    id_perusahaan int(10) not null, 
    nama_lengkap varchar(100),
    tgl_lahir date, 
    hubungan enum('Ayah', 'Ibu', 'Anak',  'Kakak', 'Adik'),
    pendidikan enum ('-','SD', 'SMP','SLTA', 'D3', 'S1', 'S2', 'S3'),
    created_at datetime,
    created_by int(10),
    updated_at datetime,
    updated_by int(10)
); 


-- Dilakukan oleh HR / Admin
drop table if exists absensi_waktu;
create table absensi_waktu(
    id_absensi_waktu int(20) primary key not null auto_increment, 
    id_perusahaan int(10) not null, 
    shift enum ('1', '2', '3'),
    masuk time,
    pulang time,
    created_at datetime,
    created_by int(10),
    updated_at timestamp,
    updated_by int(10)
);


-- Dilakukan oleh HR / Admin
drop table if exists absensi_lokasi;
create table absensi_lokasi(
    id_lokasi int(20) primary key not null auto_increment,
    id_perusahaan int(10) not null,
    nama_lokasi varchar(100),
    alamat_lokasi text,
    lat varchar(30),
    lgt varchar(30),  
    max_jarak varchar(10), 
    created_at datetime,
    created_by int(10),
    updated_at timestamp,
    updated_by int(10)
);


-- Dilakukan oleh HR / Admin
drop table if exists absensi_skejul;
create table absensi_skejul(
    id_skejul int(20) primary key not null auto_increment,
    id_perusahaan int(10) not null,   
    id_karyawan int(10) not null,   
    tanggal_mulai date,
    tanggal_akhir date,
    lat varchar(30),
    lgt varchar(30),  
    nama_lokasi varchar(100),
    alamat_lokasi text,
    max_jarak varchar(10), 
    created_at datetime,
    created_by int(10),
    updated_at timestamp,
    updated_by int(10)
);

-- Dilakukan oleh karywan
drop table if exists absensi;
create table absensi(
    id_absensi int(20) primary key not null auto_increment,
    id_perusahaan int(10) not null,  
    id_karyawan int(10) not null,  
    latlong_masuk varchar(100),
    jam_masuk datetime,
    foto_masuk text,
    latlong_pulang varchar(100),
    jam_pulang datetime,
    foto_pulang text,
    total_waktu varchar(20)
);

-- Dilakukan oleh Admin saat rekap
drop table if exists alpa;
create table alpa(
    id_alpa int(20) primary key not null auto_increment,
    id_perusahaan int(10) not null,  
    id_karyawan int(10) not null,  
    keterangan enum ('Izin', 'Sakit') default 'Izin',
    deskripsi_alpa text,
    foto_alpa  text,
    tanggal datetime
);

drop table if exists cuti_jenis;
create table cuti_jenis(
    id_jeniscuti int(20) primary key not null auto_increment,
    id_perusahaan int(10) not null,   
    jenis_cuti varchar(50),
    lama_cuti varchar(10),
    created_at datetime,
    created_by int(10),
    updated_at datetime,
    updated_by int(10)
);

-- Dilakukan oleh karywan, approval by atasan --
drop table if exists cuti;
create table cuti(
    id_cuti int(20) primary key not null auto_increment,
    id_jeniscuti int(20),
    id_perusahaan int(10) not null,
    id_karyawan int(10) not null,
    tgl_mulai date,
    tgl_akhir date
);