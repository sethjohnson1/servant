drop table if exists questions;
create table questions(
	id varchar(42) not null,
	primary key(id),
	created datetime,
	modified datetime,
	name text,
	terminal varchar(100)
);

drop table if exists answers;
create table answers(
	id varchar(42) not null,
	primary key(id),
	created datetime,
	modified datetime,
	question_id varchar(42),
	terminal varchar(100)
);