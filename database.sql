create table season(
	id_season serial primary key,
	startdate date not null,
	enddate date not null, 
	status boolean not null
);


create table language(
	id_language SERIAL PRIMARY KEY,
	lang varchar(100)
);
create table country(
	id_country serial primary key,
	country varchar(100) not null,
	abbreviation varchar(2) not null
);
create table injury(
	id_injury serial primary key,
	description varchar(100) not null,
	min_games int not null,
	max_games int not null
);




create table account(
	id_account SERIAL PRIMARY KEY,
	email varchar(100) not null,
	password varchar(256) not null,
	father int,
		CONSTRAINT account_father_fkey FOREIGN KEY (father) REFERENCES account(id_account),
	language int not null,
		CONSTRAINT account_language_fkey FOREIGN KEY (language) REFERENCES language(id_language),
	slvip int,
	timezone int
);
create table session(
	id_session serial primary key,
	id_account int not null,
		CONSTRAINT session_idaccount_fkey FOREIGN KEY (id_account) REFERENCES account(id_account),
	session varchar(256) not null,
	valid boolean,
	startdate timestamp default now()
);



create table club(
	id_club serial primary key,
	id_country int not null,
		CONSTRAINT club_country_fkey FOREIGN KEY (id_country) REFERENCES country(id_country),
	id_account int not null,
		CONSTRAINT club_account_fkey FOREIGN KEY (id_account) REFERENCES account(id_account),
	clubname varchar(25) not null,
	createdate date default now()
);
create table club_info(
	id_club_info serial primary key,
	id_club int not null,
		CONSTRAINT clubinfo_idclub_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	nickname varchar(25) default 'null',
	manager varchar(25)  default 'null',
	stadium varchar(25)  default 'null',
	city varchar(25)  default 'null'
);
create table club_fans(
	id_club_fans serial primary key,
	id_club int not null,
		CONSTRAINT clubfans_club_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	fans int not null default 6000
);
create table club_friends(
	id_friendship serial primary key, 
	friend_one int not null,
		CONSTRAINT clubfriends_friendone FOREIGN KEY (friend_one) REFERENCES club(id_club),
	friend_two int not null,
		CONSTRAINT clubfriends_friendone FOREIGN KEY (friend_two) REFERENCES club(id_club),
	when date
);
create table club_visits(
	id_club_visits serial primary key,
	id_club int not null,
		CONSTRAINT clubvisits_idclub_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	id_club_visited int not null,
		CONSTRAINT clubvisits_idclubvisited_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	when date
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
		CONSTRAINT playerattr_club_fkey FOREIGN KEY (id_player) REFERENCES players(id_player)
);
create table players_history(
	id_player_history serial primary key, 
	id_player int not null,
		CONSTRAINT playerhistory_player_fkey FOREIGN KEY (id_player) REFERENCES players(id_player),
	id_season int not null,
		CONSTRAINT playerhistory_season_fkey FOREIGN KEY (id_season) REFERENCES season(id_season),
	id_club int not null,
		CONSTRAINT playerhistory_club_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	games int DEFAULT 0,
	goals int DEFAULT 0,
	assists int DEFAULT 0,
	yellowcards int DEFAULT 0,
	redcards int DEFAULT 0,
	mvp int default 0,
	score numeric(4,2) default 0
);
create table player_injury(
	id_player_injury serial primary key,
	id_player int not null,
		CONSTRAINT playerinjury_player_fkey FOREIGN KEY (id_player) REFERENCES players(id_player),
	id_injury int not null, 
		CONSTRAINT playerinjury_injury_fkey FOREIGN KEY (id_injury) REFERENCES injury(id_injury),
	games int not null,
	status boolean not null
);
create table player_cards(
	id_player_cards serial primary key,
	id_player int not null,
		CONSTRAINT playercards_cards_fkey FOREIGN KEY (id_player) REFERENCES players(id_player),
	cards int not null
);
/*
	yellow card gives 1 point
	red card gives 3 points
	every 3 points, player will be not available for 1 game.
	if 5 points, player will be not available for 2 games.
	CAN'T BE AVAILABLE FOR MORE GAMES? HOW? 
*/




create table transferlist(
	id_transferlist serial primary key,
	id_player int not null,
		CONSTRAINT transferlist_player_fkey FOREIGN KEY (id_player) REFERENCES players(id_player),
	startDate timestamp without time zone not null,
	endDate timestamp without time zone not null
);