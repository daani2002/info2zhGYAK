drop database if exists minta_zh;

create database minta_zh
	default character set utf8
    default collate utf8_general_ci;

use minta_zh;

create table fajta(
	id int auto_increment primary key,
    nev varchar(50) not null
);

insert into fajta(id, nev) values(1, 'kutya');
insert into fajta(id, nev) values(2, 'macska');

create table allat(
	id int auto_increment primary key,
    nev varchar(50) not null,
    fajtaId int references fajta(id)
);

insert into allat(id, nev, fajtaId) values(1, 'blöki', 1);
insert into allat(id, nev, fajtaId) values(2, 'mirci', 2);
insert into allat(id, nev, fajtaId) values(3, 'zokni', 1);

create table etel(
	id int auto_increment primary key,
    nev varchar(50) not null
);

insert into etel(id, nev) values(1, 'leves');
insert into etel(id, nev) values(2, 'csont');
insert into etel(id, nev) values(3, 'pite');

create table kedvencetel(
	allatId int references allat(id),
    etelId int references etel(id), 
    primary key(allatId, etelId)
);

insert into kedvencetel(allatId, etelId) values(1, 1);
insert into kedvencetel(allatId, etelId) values(1, 2);
insert into kedvencetel(allatId, etelId) values(2, 3);
insert into kedvencetel(allatId, etelId) values(3, 1);
insert into kedvencetel(allatId, etelId) values(3, 3);

select etel.nev, count(*)
from fajta f
	inner join allat on f.id = allat.fajtaId
	inner join kedvencetel on allat.id = kedvencetel.allatId
    inner join etel on kedvencetel.etelId = etel.id
where f.nev = 'kutya'
group by etel.nev
order by etel.nev;



