
create table season(
	season serial primary key,
	startseason date not null,
	endseason date not null
);
/**
 * TABELAS DE CONFIGURA�?ÃO
 */
create table languages(
	id_language SERIAL PRIMARY KEY,
	lang varchar(5),
	laguage varchar(100)
);
create table countries(
	id_country serial primary key,
	country varchar(100) not null, -- english name
	abbreviation varchar(2) not null
);
create table injuries(
	id_injury serial primary key,
	min_games integer not null,
	max_games integer not null
);
create table timezones(
	id_timezone serial primary key,
	timezone varchar(100)
);
/**
 * fim
 */
 /**
  * TABELAS DE CONTA
  */
 create table account(
 	id_account SERIAL PRIMARY KEY,
 	email varchar(100) not null,
 	password varchar(256) not null,
 	refeer integer,
 		CONSTRAINT account_refeer_fkey FOREIGN KEY (refeer) REFERENCES account(id_account)
 );
 create table account_data(
 	id_account_data SERIAL PRIMARY KEY,
 	id_account integer not null default 1,
 		CONSTRAINT accountdata_idaccount_fkey FOREIGN KEY (id_account) REFERENCES account(id_account),
 	id_language integer not null default 1,
 		CONSTRAINT account_language_fkey FOREIGN KEY (id_language) REFERENCES languages(id_language),
 	id_timezone integer not null,
 		FOREIGN KEY (id_timezone) REFERENCES timezones(id_timezone),
 	slvip integer DEFAULT 14
 );
 create table account_permission(
   id_account_permission SERIAL PRIMARY KEY,
   id_account integer not null,
     FOREIGN KEY (id_account) REFERENCES account(id_account),
   permission char(2) not null, -- 'FT','GT','MT','LT','GOD'
     CHECK (permission = ANY (ARRAY['FT'::bpchar,'GT'::bpchar,'MT'::bpchar,'LT'::bpchar,'GOD'::bpchar]))
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
 	startdate timestamp default now(),
 	ip varchar(100)
 );
/**
 * fim
 */
/**
 * CLUBTABLES
 */
/**
 * CLUBTABLES
 */
create table club(
	id_club serial primary key,
	id_country integer not null,
		CONSTRAINT club_country_fkey FOREIGN KEY (id_country) REFERENCES countries(id_country),
	clubname varchar(60) not null default 'Available Team',
	created date default now(),
	status varchar(1) default 'P',
		CHECK (status = ANY (ARRAY['P'::bpchar,'A'::bpchar,'I'::bpchar,'B'::bpchar])) -- pending, approved, inactived, banned
);
create table club_account(
	id_club_account serial primary key,
	id_account integer not null,
		FOREIGN KEY (id_account) REFERENCES account(id_account),
	id_club integer REFERENCES club(id_club)
);
create table club_info(
	id_club_info serial primary key,
	id_club integer not null,
		CONSTRAINT clubinfo_idclub_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
  manager varchar(50) default 'The Manager',
	nickname varchar(25) default 'null',
	stadium varchar(25)  default 'null',
  fansname varchar(50) default null,
  logo varchar(200) default 'null',
  primaryColor varchar(7) default 'null',
  secondaryColor varchar(7) default 'null',
  history varchar(300) default 'null',
	location json -- '{"latitude": 0, "longitude": 0 , "changes" : 0}'
);
create table club_supporters(
	id_club_fans serial primary key,
	id_club integer not null,
		FOREIGN KEY (id_club) REFERENCES club(id_club),
	supporters integer not null default 6000,
	cardholder integer not null default 300
);

create table buddies(
	id_friendship serial primary key,
	buddyA integer not null,
		FOREIGN KEY (buddyA) REFERENCES club(id_club),
	buddyB integer not null,
		FOREIGN KEY (buddyB) REFERENCES club(id_club),
	status char(1) not null,
		CHECK (status = ANY (ARRAY['P'::bpchar,'A'::bpchar])),
	friendship_date date
);
create table club_visits(
	id_club_visits serial primary key,
	id_club integer not null,
		CONSTRAINT clubvisits_idclub_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	id_club_visited integer not null,
		CONSTRAINT clubvisits_idclubvisited_fkey FOREIGN KEY (id_club) REFERENCES club(id_club),
	visitdate date
);
create table sponsors(
	id_sponsor serial primary key,
	sponsorname varchar(200)
);
create table club_sponsorship(
	id_club_sponsorship serial primary key,
	id_sponsor integer,
		FOREIGN KEY (id_sponsor) REFERENCES sponsors(id_sponsor),
	type varchar(2),
		CHECK (type = ANY (ARRAY['M'::bpchar,'S'::bpchar,'E'::bpchar, 'N'::bpchar])), -- MASTER, STADIUM, Equipment, stadium Naming rights
	weeks integer not null,
	money numeric(17,2)
);
create table club_sponsorship_stadium(
	id_club_sponsorship_stadium serial primary key,
	id_club_sponsorship integer,
		FOREIGN KEY (id_club_sponsorship) REFERENCES club_sponsorship(id_club_sponsorship),
	sector varchar(1) not null
);
create table club_finances(
	id_club_finances serial primary key,
	id_club integer not null,
		FOREIGN KEY (id_club) REFERENCES club(id_club),
	money numeric(17,2) not null default '30000000',
	tickets numeric(17,2) not null default 0,
	tv numeric(17,2) not null default 0,
	merchandise numeric(17,2) not null default 0,
	food numeric(17,2) not null default 0,
	sponsor numeric(17,2) not null default 0,
	wage numeric(17,2) not null default 0,
	constructions numeric(17,2) not null default 0,
	interests numeric(17,2) not null default 0
);
create table club_finances_weekly(
	id_club_finances_weekly serial primary key,
	id_club integer not null,
		FOREIGN KEY (id_club) REFERENCES club(id_club),
	week integer not null,
	money numeric(17,2) not null ,
	tickets numeric(17,2) not null default 0,
	tv numeric(17,2) not null default 0,
	merchandise numeric(17,2) not null default 0,
	food numeric(17,2) not null default 0,
	sponsor numeric(17,2) not null default 0,
	wage numeric(17,2) not null default 0,
	constructions numeric(17,2) not null default 0,
	interests numeric(17,2) not null default 0
);
create table club_finances_season(
	id_club_finances_season serial primary key,
	id_club integer not null,
		FOREIGN KEY (id_club) REFERENCES club(id_club),
	season integer not null,
		FOREIGN KEY(season) REFERENCES season(season),
	money numeric(17,2) not null,
	tickets numeric(17,2) not null default 0,
	tv numeric(17,2) not null default 0,
	merchandise numeric(17,2) not null default 0,
	food numeric(17,2) not null default 0,
	sponsor numeric(17,2) not null default 0,
	wage numeric(17,2) not null default 0,
	constructions numeric(17,2) not null default 0,
	interests numeric(17,2) not null default 0
);
create table club_stadium(
	id_club_stadium serial primary key,
	id_club integer not null,
		FOREIGN KEY (id_club) REFERENCES club(id_club),
	capacity integer not null default 6000,
	seated integer not null default 0,
	pitchcover integer not null default 0,
	draining integer not null default 0,
	sprinklers integer not null default 0,
	heating integer not null default 0,
	floodlights integer not null default 0
);
-- create table facilities(
-- 	id_facilities serial primary key,
-- 	facilitie varchar(100),
-- 	maxlevel intenger,
-- 	money_per_level_week numeric(17,2),
-- 	cost_per_level_week numeric(17,2)
-- );
-- create table club_facilities(
-- 	id_club_facilities serial primary key,
-- 	id_club integer not null REFERENCES club(id_club),
-- 	id_facilities integer not null references facilities(id_facilities),
-- 	level intenger not null default 0
-- );
create table club_facilities(
	id_club_facilities serial primary key,
	id_club integer not null,
		FOREIGN KEY (id_club) REFERENCES club(id_club),
	marketing integer not null default 0,
	medicalcenter integer not null default 0,
	physio integer not null default 0,
	traininggrounds integer not null default 0,
	youthacademy integer not null default 0,
	toilets integer not null default 0,
	parking integer not null default 0,
	hotdogs integer not null default 0,
	restaurant integer not null default 0,
	merchandisestore integer not null default 0
);
-- create table club_history();
/**
 * fim
 */
/**
 * PLAYERS
 */

 create table positions(
	 	id_position serial primary key,
		position varchar(2),
			CHECK (position = ANY (ARRAY['GK'::bpchar,'D'::bpchar,'DM'::bpchar, 'M'::bpchar,'OM'::bpchar, 'F'::bpchar])),
		side varchar(1),
			CHECK (side = ANY (ARRAY['L'::bpchar,'R'::bpchar,'C'::bpchar]))
		-- deffense_disposition integer,
		-- midfielder_disposition integer,
		-- attack_disposition integer
 );

create table players(
	id_player serial primary key,
	id_player_club integer not null,
		CONSTRAINT player_club_fkey FOREIGN KEY(id_player_club) REFERENCES club(id_club),
	id_country integer not null,
		FOREIGN KEY(id_country) REFERENCES countries(id_country),
	name varchar(150) not null,
	nickname varchar(25) not null,
	age numeric(4,2) not null,
	height integer not null,
	weight integer not null,
	leg varchar(1) not null
);
create table players_appearance(
	id_player_appearance serial primary key,
	id_player integer,
		FOREIGN KEY (id_player) REFERENCES players(id_player),
		UNIQUE(id_player),
	body integer,
	eyes integer,
	hair integer,
	bear integer
);
create table players_position(
	id_player_position serial primary key not null,
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
	adaptability numeric (5,3),
	leadership numeric (5,3),
	workrate numeric (5,3),
	concentration numeric (5,3),
	decision numeric (5,3),
	positioning numeric (5,3),
	vision numeric (5,3),
	unpredictability numeric (5,3),
	communication numeric (5,3)
);
create table players_attr_gk(
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
);
create table players_attr_line(
	id_player_line_attr serial primary key,
	id_player integer not null,
		CONSTRAINT playerattrline_idplayer_fkey FOREIGN KEY(id_player) REFERENCES players(id_player),
	crossing numeric (5,3),
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
	rating numeric(4,2) default 0 -- nota média
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
 create table competition_type(
   id_competition_type serial primary key,
   type varchar(2) not null,
   CHECK (type = ANY (ARRAY['L'::bpchar,'C'::bpchar,'T'::bpchar, 'F'::bpchar, 'FL'::bpchar, 'P'::bpchar])) -- p = playoffs, fl= friendly league
 );

 create table competition(
   id_competition serial primary key,
   id_competition_type integer not null,
     CONSTRAINT competition_idcompetitiontype_fkey FOREIGN KEY(id_competition_type) REFERENCES competition_type(id_competition_type),
   season integer not null,
 		CONSTRAINT competition_season_fkey FOREIGN KEY(season) REFERENCES season(season),
   id_country integer,
   teams integer not null,
   games integer not null,
   gamesplayed integer not null default 0,
	 official boolean
 );
 create table club_trophies(
	id_club_trophies serial primary key,
	id_club integer,
		FOREIGN KEY (id_club) references club(id_club),
	id_competition integer,
		FOREIGN KEY (id_competition) references competition(id_competition),
	place integer
);
 create table cup(
   id_cup serial primary key,
   id_competition integer not null,
     FOREIGN KEY(id_competition) REFERENCES competition(id_competition),
	 cupname varchar(100) not null,
   homeaway bool not null,
   awaygoal bool not null
 );
 create table league(
   id_league serial PRIMARY KEY,
   id_competition integer not null,
     CONSTRAINT league_idcompetition_fkey FOREIGN KEY(id_competition) REFERENCES competition(id_competition),
	 leaguename varchar(100) not null,
   division integer,
   divgroup varchar(1)
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
  goalsC integer not null DEFAULT 0,
  goalsC_home integer not null default 0,
  goalsC_away integer not null default 0,
  yellowcards integer not null default 0,
  redcards integer not null default 0
 );
 create table league_table_positions(
	 id_league_table_positions serial primary key,
	 id_league_table integer,
		foreign key (id_league_table) references league_table(id_league_table),
	 gamesplayed integer not null,
	 position integer not null
 );
 create table weather_types(
	id_weather serial primary key,
	weather varchar(100),
	weather_icon varchar(100),
	condition integer
 );
 create table matches(
  id_match serial primary key,
  type varchar(1),
   CHECK (type = ANY (ARRAY['L'::bpchar,'C'::bpchar,'T'::bpchar, 'F'::bpchar])),
	id_location integer,
		FOREIGN KEY (id_location) REFERENCES club_stadium(id_club_stadium),
  day date,
  hour varchar(5),
  id_weather integer,
   FOREIGN KEY (id_weather) REFERENCES weather_types(id_weather),
  pitch integer,
  home integer not null,
    FOREIGN KEY (home) REFERENCES club(id_club),
  away integer not null,
    FOREIGN KEY (away) REFERENCES club(id_club),
	attendance integer
);
create table league_calendar(
 id_match_calendar serial primary key,
 id_league integer not null,
   FOREIGN KEY (id_league) REFERENCES league(id_league),
 id_match integer,
   FOREIGN key (id_match) references matches(id_match),
 day date,
 hour varchar(5)
);
 create table matches_stats(
  id_match_stats serial primary key,
  id_match integer not null,
    FOREIGN KEY(id_match) references matches(id_match),
  homegoals integer not null,
  awaygoals integer not null,
	homepossession integer not null,
	homefaults integer,
	homesetpieces integer,
	homecorners integer,
	homeshots integer,
	homeshotsontarget integer,
	homeshotsonpost integer,
	homeshotsoutbox integer,
	homespasses integer,
	homepassessuccess integer,
	homeyellowcards integer,
	homeredcards integer,
	homepenalty integer,
	homepenaltysuccess integer,
	awaypossession integer not null,
	awayfaults integer,
	awaysetpieces integer,
	awaycorners integer,
	awayshots integer,
	awayshotsontarget integer,
	awayshotsonpost integer,
	awayshotsoutbox integer,
	awayyellowcards integer,
	awayredcards integer,
	awaypasses integer,
	awaypassessuccess integer,
	awaypenalty integer,
	awaypenaltysuccess integer
 );
 create table matches_stats_players(
	 id_match_stats_players serial primary key,
	 id_player integer references players(id_player),
	 goals integer,
	 assists integer,
	 rating numeric(4,2),
	 mvp boolean,
	 yellowcards integer,
	 redcards integer,
	 passing integer,
	 passing_success integer,
	 crosses integer,
	 crosses_success integer,
	 faults integer,
	 shots integer,
	 shotsontarget integer,
	 shotsonpost integer,
	 shotsoutbox integer,
	 dribbles integer,
	 dribbles_success integer,
	 badcontrol integer,
	 aerials integer,
	 aerialswon integer,
	 offsides integer,
	 tackles integer,
	 interceptions integer,
	 owngoals integer,
	 saves integer,
	 conceded integer
 );
-- create table competition_statistics(
-- 	id_competition_statistics serial primary key,
-- 	id_competition integer not null,
-- 		CONSTRAINT competitionsstatistics_idcompetition_fkey FOREIGN KEY(id_competition) REFERENCES competition(id_competition),
-- 	id_club integer not null,
-- 		CONSTRAINT competitionsstatistics_idclub_fkey FOREIGN KEY(id_club) REFERENCES club(id_club)
-- );
-- create table competition_statistics_players(
-- 	id_competition_statistics_player serial primary key,
-- 	id_competition integer not null,
-- 		CONSTRAINT competitionsstatisticsplayers_idcompetition_fkey FOREIGN KEY(id_competition) REFERENCES competition(id_competition),
-- 	id_player integer not null,
-- 		CONSTRAINT competitionstatisticsplayers_idplayer_fkey FOREIGN KEY(id_player) REFERENCES players(id_player),
-- 	mvp integer not null default 0,
-- 	goals integer not null default 0,
-- 	assists integer not null default 0,
-- 	yellowcards integer not null default 0,
-- 	redcards integer not null default 0,
-- 	score numeric(4,2) not null default 0.0
-- );
 /**Feed**/
create table tweet(
   id_tweet serial primary key,
   id_club integer not null,
     foreign key(id_club) references club(id_club),
   tweetdate timestamp without time zone default now(),
   retweet integer,
   reply_to integer
 );

 create table tweetContent(
   id_tweet_content serial primary key,
   id_tweet integer not null,
     foreign key(id_tweet) references tweet(id_tweet),
   type varchar(1) not null default 'C',
   tweet varchar(200) not null,
   likes integer default 0,
   tags text[]
 );
 create table tweetLikes(
  id_like serial primary key,
  id_tweet integer not null,
    foreign key(id_tweet) references tweet(id_tweet),
  id_club integer,
  foreign key(id_club) references club(id_club)
 );



insert into season (startseason, endseason) values('2017-03-19', '2017-06-06');
insert into competition_type(type) values ('L');
insert into countries (country,abbreviation) values ('Brazil','br');
insert into positions (position,side) values('GK','C');
insert into positions (position,side) values('D','C');
insert into positions (position,side) values('D','L');
insert into positions (position,side) values('D','R');
insert into positions (position,side) values('DM','C');
insert into positions (position,side) values('DM','L');
insert into positions (position,side) values('DM','R');
insert into positions (position,side) values('M','C');
insert into positions (position,side) values('M','L');
insert into positions (position,side) values('M','R');
insert into positions (position,side) values('OM','C');
insert into positions (position,side) values('OM','L');
insert into positions (position,side) values('OM','R');
insert into positions (position,side) values('F','C');
