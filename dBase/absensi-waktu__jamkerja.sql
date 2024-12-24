 
-- Dilakukan oleh HR / Admin --
-- Adalah jam kerja perusahaan --
drop table if exists absensi_waktu;
create table absensi_waktu(
    id_waktu int(20) primary key not null auto_increment, 
    id_perusahaan int(10) not null, 
    shift enum ('1', '2', '3'),
    masuk time,
    pulang time,
    created_at datetime,
    created_by int(10),
    updated_at timestamp,
    updated_by int(10)
); 