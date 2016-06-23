create table season(
	season serial primary key,
	startdate date not null,
	enddate date not null
);
/**
 * TABELAS DE CONFIGURAÇÃO
 */
create table language(
	id_language SERIAL PRIMARY KEY,
	lang varchar(100)
);
create table country(
	id_country serial primary key,
	country varchar(100) not null,
	abbreviation varchar(2) not null
);
create table injuries(
	id_injury serial primary key,
	min_games integer not null,
	max_games integer not null
);
create table positions(
	id_position serial primary key,
	side varchar(1),
	position varchar(2)
);
/**
 * fim
 */
/**
 * TABELAS DE CONTA
 */
create table manager(
	id_manager serial primary key,
	name varchar(100),
	nickname varchar(100),
	age varchar(100),
	seasons integer
);
create table manager_statistics(
	id_manager_statistics serial primary key,
	id_manager integer not null,
		CONSTRAINT managerstatistics_idmanager_fkey FOREIGN KEY (id_manager) REFERENCES manager(id_manager) 
);
create table account(
	id_account SERIAL PRIMARY KEY,
	id_manager integer not null,
		CONSTRAINT account_manager_fkey FOREIGN KEY(id_manager) REFERENCES manager(id_manager)
	email varchar(100) not null,
	password varchar(256) not null,
	refeer integer,
		CONSTRAINT account_refeer_fkey FOREIGN KEY (refeer) REFERENCES account(id_account)
);
create table account_data(
	id_account_data SERIAL PRIMARY KEY,
	id_account integer not null,
		CONSTRAINT accountdata_idaccount_fkey FOREIGN KEY (id_account) REFERENCES account(id_account),
	language integer not null,
		CONSTRAINT account_language_fkey FOREIGN KEY (language) REFERENCES language(id_language),
	slvip integer,
	timezone integer,
	status varchar(1)
);
/**
 * fim
 */
/**
 * TABELAS DE SESSÃO E LOGIN
 */
create table session(
	id_session serial primary key,
	id_account integer not null,
		CONSTRAINT session_idaccount_fkey FOREIGN KEY (id_account) REFERENCES account(id_account),
	session varchar(256) not null,
	valid boolean,
	startdate timestamp default now()
);
/**
 * fim
 */
/**
 * CLUBTABLES
 */
create table club(
	id_club serial primary key,
	id_country integer not null,
		CONSTRAINT club_country_fkey FOREIGN KEY (id_country) REFERENCES country(id_country),
	id_account integer not null,
		CONSTRAINT club_account_fkey FOREIGN KEY (id_account) REFERENCES account(id_account),
	name varchar(25) not null,
	createdate date default now(),
	status varchar(1) default 'A'
);
create table club_info(
	id_club_info serial primary key,
	id_club integer not null,
		CONSTRAINT clubinfo_idclub_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	nickname varchar(25) default 'null',
	stadium varchar(25)  default 'null',
	city varchar(25)  default 'null'
);
create table club_fans(
	id_club_fans serial primary key,
	id_club integer not null,
		CONSTRAINT clubfans_club_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	fans integer not null default 6000
);
create table club_friends(
	id_friendship serial primary key, 
	friend_one integer not null,
		CONSTRAINT clubfriends_friendone FOREIGN KEY (friend_one) REFERENCES club(id_club),
	friend_two integer not null,
		CONSTRAINT clubfriends_friendone FOREIGN KEY (friend_two) REFERENCES club(id_club),
	when date
);
create table club_visits(
	id_club_visits serial primary key,
	id_club integer not null,
		CONSTRAINT clubvisits_idclub_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	id_club_visited integer not null,
		CONSTRAINT clubvisits_idclubvisited_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	visitdate date
);
create table club_sponsorship();
create table club_finances();
create table club_stadium();
create table club_facilities();
create table club_history();
create table club_trophies();
/**
 * fim
 */
/**
 * PLAYERS
 */
create table players(
	id_player serial primary key,
	id_player_club integer not null,
		CONSTRAINT player_club_fkey FOREIGN KEY(id_player_club) REFERENCES club(id_club),
	name varchar(150) not null,
	nickname varchar(25) not null,
	age numeric(4,2) not null,
	height numeric(4,2) not null,
	weight numeric(4,2) not null,
	leg varchar(1) not null
);
create table players_position(
	id_player_position serial not null, 
	id_player integer not null,
		CONSTRAINT playersposition_idplayer_fkey FOREIGN KEY(id_player) REFERENCES players(id_player),
	id_position integer not null,
		CONSTRAINT playersposition_idposition_fkey FOREIGN KEY(id_position) REFERENCES positions(id_position)
);
create table players_attr(
	id_player_attr serial primary key,
	id_player integer not null,
		CONSTRAINT playerattr_idplayer_fkey FOREIGN KEY (id_player) REFERENCES players(id_player),
	stamina numeric (5,3),
	speed numeric (5,3),
	resistance numeric (5,3),
	injury_propensity numeric (5,3),
	jump numeric (5,3),
	professionalism numeric (5,3),
	agressive numeric (5,3),
	adptability numeric (5,3),
	learning numeric (5,3),
	workate numeric (5,3),
	concentration numeric (5,3),
	decision numeric (5,3),
	positioning numeric (5,3),
	vision numeric (5,3),
	unpredictability numeric (5,3),
	communication numeric (5,3)
);	
create table players_attr_gk(){
	id_player_gk_attr serial primary key,
	id_player integer not null,
		CONSTRAINT playerattrgk_idplayer_fkey FOREIGN KEY (id_player) REFERENCES players(id_player),
	handling numeric (5,3),
	aerial numeric (5,3),
	foothability numeric (5,3),
	oneanone numeric (5,3),
	reflexes numeric (5,3),
	rushingout numeric (5,3),
	kicking numeric (5,3),
	throwing numeric (5,3)
}
create table players_attr_line(
	id_player_line_attr serial primary key,
	id_player integer not null,
		CONSTRAINT playerattrline_idplayer_fkey FOREIGN KEY(id_player) REFERENCES players(id_player),
	cross numeric (5,3),
	pass numeric (5,3),
	technical numeric (5,3),
	ballcontrol numeric (5,3),
	dribble numeric (5,3),
	longshot numeric (5,3),
	finish numeric (5,3),
	heading numeric (5,3),
	freekick numeric (5,3),
	marking numeric (5,3),
	tackling numeric (5,3)
);
create table players_history(
	id_player_history serial primary key, 
	id_player integer not null,
		CONSTRAINT playerhistory_player_fkey FOREIGN KEY (id_player) REFERENCES players(id_player),
	season integer not null,
		CONSTRAINT playerhistory_season_fkey FOREIGN KEY (season) REFERENCES season(season),
	id_club integer not null,
		CONSTRAINT playerhistory_club_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	games int DEFAULT 0,
	goals int DEFAULT 0,
	assists int DEFAULT 0,
	yellowcards int DEFAULT 0,
	redcards int DEFAULT 0,
	mvp int default 0,
	score numeric(4,2) default 0
);
create table players_injury(
	id_player_injury serial primary key,
	id_player integer not null,
		CONSTRAINT playerinjury_player_fkey FOREIGN KEY (id_player) REFERENCES players(id_player),
	id_injury integer not null, 
		CONSTRAINT playerinjury_injury_fkey FOREIGN KEY (id_injury) REFERENCES injuries(id_injury),
	games integer not null,
	status boolean not null
);
create table players_cards(
	id_player_cards serial primary key,
	id_player integer not null,
		CONSTRAINT playercards_cards_fkey FOREIGN KEY (id_player) REFERENCES players(id_player),
	cards integer not null
);
/**
 * fim
 */
/**
 * TRAINING
 */
create table training();
create table player_attr_training();
create table player_attr_gk_training();
create table player_attr_line_training();
/**
 * fim
 */
/**
 * MARKET
 */
create table transferlist(
	id_transferlist serial primary key,
	id_player integer not null,
		CONSTRAINT transferlist_player_fkey FOREIGN KEY (id_player) REFERENCES players(id_player),
	startDate timestamp without time zone not null,
	endDate timestamp without time zone not null
);
create table watchlist(
	id_watchlist serial primary key,
	id_player integer not null,
		CONSTRAINT watchlist_player_fkey FOREIGN KEY(id_player) REFERENCES players(id_player),
	id_club integer not null,
		CONSTRAINT watchlist_club_fkey FOREIGN KEY (id_club) REFERENCES club(id_club)
);
/**
 * fim
 */
/**
 * COMPETITIONS
 */
create table competition_types(
	id_competition_type serial primary key, 
	type varchar(1) not null,
);
create table competition(
	id_competition serial primary key,
	id_competition_type integer not null,
		CONSTRAINT competition_idcompetitiontype_fkey FOREIGN KEY(id_player) REFERENCES competition_types(id_competition_type),
	season integer not null,
		CONSTRAINT competition_season_fkey FOREIGN KEY(season) REFERENCES season(season),
	name varchar(50) not null,
	id_country integer null,
		CONSTRAINT competition_country_fkey FOREIGN KEY(id_country) REFERENCES country(id_country),
	totalclubs integer not null
);
create table competition_statistics(
	id_competition_statistics serial primary key,
	id_competition integer not null,
		CONSTRAINT competitionsstatistics_idcompetition_fkey FOREIGN KEY(id_competition) REFERENCES competition(id_competition),
	id_club integer not null,
		CONSTRAINT competitionsstatistics_idclub_fkey FOREIGN KEY(id_club) REFERENCES club(id_club),
);
create table competition_statistics_players(
	id_competition_statistics_player serial primary key,
	id_competition integer not null,
		CONSTRAINT competitionsstatisticsplayers_idcompetition_fkey FOREIGN KEY(id_competition) REFERENCES competition(id_competition),
	id_player integer not null,
		CONSTRAINT competitionstatisticsplayers_idplayer_fkey FOREIGN KEY(id_player) REFERENCES players(id_player),
	mvp integer not null default 0,
	goals integer not null default 0,
	assists integer not null default 0,
	yellowcards integer not null default 0,
	redcards integer not null default 0,
	score numeric(4,2) not null default 0.0
);
/**
 * fim
 */
/**
 * LEAGUE
 */
create table league(
	id_league serial PRIMARY KEY,
	id_competition integer not null,
		CONSTRAINT league_idcompetition_fkey FOREIGN KEY(id_competition) REFERENCES competition(id_competition),
	division integer,
	group integer,
	totalgames integer not null,
	turn integer not null
);
create table league_table(
	id_league_table serial primary key,
	id_league integer not null,
		CONSTRAINT leaguetable_idleague_fkey FOREIGN KEY(id_league) REFERENCES league(id_league),
	id_club integer not null,
		CONSTRAINT leaguetable_idclub_fkey FOREIGN KEY(id_club) REFERENCES club(id_club),
	pts integer not null DEFAULT 0,
	win integer not null DEFAULT 0,
	win_home integer not null default 0,
	win_away integer not null default 0,
	loss integer not null DEFAULT 0,
	loss_home integer not null default 0,
	loss_away integer not null default 0,
	draw integer not null DEFAULT 0,
	goalsP integer not null DEFAULT 0,
	goalsP_home integer not null default 0,
	goalsP_away integer not null default 0,
	goalsC integer not null DEFAULT 0
	goalsC_home integer not null default 0,
	goalsC_away integer not null default 0, 
	yellowcards integer not null default 0,
	redcards integer not null default 0
);
/**
 * fim
 */
/**
 * MATCHES
 */
create table matches(
	id_match serial primary key,
	id_competition integer,
	id_turn integer,
	home integer not null,
	away integer not null
);
/**
 * fim
 */