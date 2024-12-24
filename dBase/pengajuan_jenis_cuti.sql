-- Dilakukan oleh karywan -- 
drop table if exists pengajuan_jenis_cuti;
create table pengajuan_jenis_cuti(
    id_jenis_cuti int(10)  primary key not null auto_increment,
    id_perusahaan bigint not null,   
    jenis_cuti varchar(100) not null COMMENT "Tahunan, menikah, melahirkan, Istri melahirkan, Umroh, Haji, Kedukaan keluarga",
    satuan_cuti enum ('Hari', 'Bulan'),
    maksimal_cuti int(2) not null COMMENT "maksimal per pengajuan",
    created_by int(10),
    updated_by int(10),
    created_at datetime,
    updated_at timestamp
);

INsert INTO pengajuan_jenis_cuti (id_perusahaan, jenis_cuti, satuan_cuti, maksimal_cuti, created_at)
                    values(3, 'Tahunan',  'Hari', 3, NOW()),
                          (3, 'Melahirkan', 'Bulan', 3, NOW()),
                          (3, 'Istri melahirkan', 'Hari', 2, NOW());