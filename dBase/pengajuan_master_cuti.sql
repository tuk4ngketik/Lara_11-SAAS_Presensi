-- Dilakukan oleh karywan -- 
drop table if exists pengajuan_master_cuti;
create table pengajuan_master_cuti(
    id_master_cuti bigint primary key not null auto_increment,
    id_perusahaan bigint not null,  
    id_karyawan bigint not null,  
    tahun varchar(5) not null,
    kuota_cuti int COMMENT "Cuti yang didapat selama 1 thn",
    cuti_terpakai int COMMENT "Cuti yg sudah dipakai",
    created_by int COMMENT "Yg membuat",
    updated_by int COMMENT "Yg melakukan update",
    created_at datetime, 
    updated_at timestamp 
); 