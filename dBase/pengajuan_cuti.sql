-- Dilakukan oleh karywan --
drop table if exists pengajuan_cuti;
create table pengajuan_cuti(
    id_cuti bigint primary key not null auto_increment,
    id_perusahaan bigint not null,  
    id_karyawan bigint not null, 
    id_jenis_cuti int(10) COMMENT "Jenis cuti | tb => pengajuan_jenis_cuti", 
    jenis_cuti varchar(50) COMMENT "Yang akan di tampilkan di list cuti tdk merujuk id_jenis_cuti",  
    tgl_awal date not null, 
    tgl_akhir date not null,
    jumlah_hari int(3),
    keterangan tinytext,
    id_pengganti int COMMENT "teman yg yg mengganti pekerjaan",
    id_atasan int COMMENT "persetujuan atasan",
    id_hr int COMMENT "HRD yg mnyetujui",
    status enum ('Disetujui', 'Ditolak','Ditangguhkan','Menunggu') default 'Menunggu', 
    created_at datetime, 
    updated_at timestamp 
); 
 