create table season(
	id_season serial primary key,
	startDate date not null,
	endDate date not null, 
	status boolean not null
);

create table languages(
	id_language SERIAL PRIMARY KEY,
	lang varchar(100)
);
create table account(
	id_account SERIAL PRIMARY KEY,
	email varchar(100) not null,
	password varchar(256) not null,
	father int,
		CONSTRAINT account_father_fkey FOREIGN KEY (father) REFERENCES id_account,
	language int not null,
		CONSTRAINT account_language_fkey FOREIGN KEY (language) REFERENCES language(id_language),
	slvip int,
	timezone int
);
create table country(
	id_country serial primary key,
	country varchar(100) not null,
	abbreviation varchar(2) not null,
	timezone int not null
);
create table club(
	id_club serial primary key,
	id_country int not null,
		CONSTRAINT club_country_fkey FOREIGN KEY (id_country) REFERENCES country(id_country),
	id_account int not null,
		CONSTRAINT club_account_fkey FOREIGN KEY (id_account) REFERENCES account(id_account),
		UNIQUE(id_account),
	clubname varchar(25) not null
);

create table club_info(
	id_club_info serial primary key,
	id_club int not null,
		CONSTRAINT clubinfo_idclub_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	nickname varchar(25),
	createdate date default now(),
	manager varchar(25),
	stadium varchar(25),
	clubtown varchar(25)
);
create table club_fans(
	id_club_fans serial primary key,
	id_club int not null,
		CONSTRAINT clubfans_club_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	fans int not null default 6000
);
create table players(
	id_player serial primary key,
	id_player_club int not null,
		CONSTRAINT player_club_fkey FOREIGN KEY(id_player_club) REFERENCES club(id_club),
	-- id_position int not null,
	-- 	CONSTRAINT
	name varchar(150) not null,
	nickname varchar(25) not null,
	age numeric(4,2) not null,
	height numeric(4,2) not null,
	weight numeric(4,2) not null,
	rec numeric(4,3) not null
);
create table players_attr(
	id_player_attr serial primary key,
	id_player int not null,
		CONSTRAINT playerattr_club_fkey FOREIGN KEY (id_player) REFERENCES player(id_player)
);
create table players_history(
	id_player_history serial primary key, 
	id_player int not null,
		CONSTRAINT playerhistory_player_fkey FOREIGN KEY (id_player) REFERENCES player(id_player),
	id_season int not null,
		CONSTRAINT playerhistory_season_fkey FOREIGN KEY (id_season) REFERENCES season(id_season),
	id_club int not null,
		CONSTRAINT playerhistory_club_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	games int DEFAULT 0,
	goals int DEFAULT 0,
	assists int default 0,
	yellowcards default 0,
	redcards default 0,
	mvp default 0,
	score default 0
);
create table injury(
	id_injury serial primary key,
	description varchar(100) not null,
	min_games int not null,
	max_games int not null
);
create table player_injury(
	id_player_injury serial primary key,
	id_player int not null,
		CONSTRAINT playerinjury_player_fkey FOREIGN KEY (id_player) REFERENCES player(id_player),
	id_injury int not null, 
		CONSTRAINT playerinjury_injury_fkey FOREIGN KEY (id_injury) REFERENCES injury(id_injury)
	status boolean not null
);
create table transferlist(
	id_transferlist serial primary key,
	id_player int not null,
		CONSTRAINT transferlist_player_fkey FOREIGN KEY (id_player) REFERENCES player(id_player),
	startDate timestamp without time zone not null,
	endDate timestamp without time zone not null,
);