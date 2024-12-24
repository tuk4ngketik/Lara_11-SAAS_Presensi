-- Dilakukan oleh karywan -- 
drop table if exists pengajuan_sakit;
create table pengajuan_sakit(
    id_sakit bigint primary key not null auto_increment,
    id_perusahaan bigint not null,   
    id_karyawan bigint not null, 
    tgl_awal date not null, 
    tgl_akhir date not null,
    jumlah_hari int(3),
    surat_sakit LONGBLOB  COMMENT 'foto surat sakit',
    keterangan tinytext, 
    id_atasan int COMMENT "persetujuan atasan",
    id_hr int COMMENT "HRD tg mnyetujui",
    status enum ('Disetujui', 'Ditolak','Ditangguhkan','Menunggu') default 'Menunggu',
    created_at datetime, 
    updated_at timestamp 
);
 
 