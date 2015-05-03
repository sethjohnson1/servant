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
	id int not null auto_increment,
	primary key(id),
	created datetime,
	modified datetime,
	question_id int,
	-- not using terminal_id but just a text value from the route
	terminal_id int,
	terminal_name varchar(200),
	response varchar(200),
	position int,
	button_color varchar(20),
	ip varchar(20),
	email varchar(100),
	first_name varchar(100),
	last_name varchar(100),
	zip varchar(40)
);

-- this table isn't used at all, keeping around anyway
drop table if exists terminals;
create table terminals(
	id int not null auto_increment,
	primary key(id),
	created datetime,
	modified datetime,
	name varchar(100)
);
