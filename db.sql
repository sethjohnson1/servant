drop table if exists questions;
create table questions(
-- used an int for ease of remembering - as there will only be a few
	id int not null auto_increment,
	primary key(id),
	created datetime,
	modified datetime,
	name text,
	answers varchar(400)
);

drop table if exists answers;
create table answers(
	id varchar(36) not null,
	primary key(id),
	created datetime,
	modified datetime,
	question_id int,
	terminal_id int,
	response varchar(200),
	position int,
	ip varchar(20),
	email varchar(100),
	first_name varchar(100),
	last_name varchar(100),
	zip varchar(40)
	
);

drop table if exists terminals;
create table terminals(
	id int not null auto_increment,
	primary key(id),
	created datetime,
	modified datetime,
	name varchar(100)
);
