create table Movie (
             id int not null, 
			 title varchar(100) not null, 
			 year int, 
			 rating varchar(10), 
			 company varchar(50),
			 primary key(id), -- All movie should have valid and unique id; 
			 check (length(title) > 0) -- All movie should have a none empty title;
)ENGINE = INNODB;

create table Actor (
             id int, 
			 last varchar(20) not null, 
			 first varchar(20) not null, 
			 sex varchar(6) not null,
			 dob date not null, 
			 dod date,
			 primary key(id)-- All actors should have valid and unique id;
)ENGINE = INNODB;
			 
create table Sales (
             mid int not null, 
			 ticketSold int, 
			 totalIncome int,
			 primary key(mid), -- The movie id should be unique and valid;
			 foreign key(mid) references Movie(id), -- The sales must be associated with a valid movie;
			 check ((ticketSold > 0) and (totalIncome > 0)) -- You can't sell minus number of tickets and get minus income;
)ENGINE = INNODB;

create table Director (
             id int not null, 
			 last varchar(20) not null, 
			 first varchar(20) not null, 
			 dob date not null,  
			 dod date,
			 primary key(id)  -- All directors should have unique id;
)ENGINE = INNODB;
			 
create table MovieGenre (
             mid int not null, 
			 genre varchar(20) not null,
			 foreign key(mid) references Movie(id) -- The movie id in this table must represent a real movie; 
)ENGINE = INNODB;

create table MovieDirector (
             mid int not null, 
			 did int not null,
			 foreign key(mid) references Movie(id), -- The movie id in this table must represent a real movie;
			 foreign key(did) references Director(id) -- The director id in this table must represent a real director;
)ENGINE = INNODB;
			 
create table MovieActor (
             mid int not null, 
			 aid int not null, 
			 role varchar(20),
			 foreign key(mid) references Movie(id), -- The movie id in this table must represent a real movie;
			 foreign key(aid) references Actor(id)-- The actor id in this table must represent a real actor;
)ENGINE = INNODB;
			 
create table MovieRating (
             mid int not null, 
			 imdb int, 
			 rot int,
			 primary key(mid), -- One movie should have only one rating;
			 foreign key(mid) references Movie(id), -- You can only rate a real movie;
			 check ((imdb > 0) and (rot > 0))-- The rating of a movie should be valid;
)ENGINE = INNODB;
			 
create table Review (
             name varchar(20), 
			 time timestamp not null, 
			 mid int not null, 
			 rating int, 
			 comment varchar(500),
			 foreign key(mid) references Movie(id), -- You can only write review for a real movie;
			 check (rating > 0) -- You can't give a movie minus rating.(Even if it's really bad)
)ENGINE  = INNODB;

create table MaxPersonID (id int not null)ENGINE = INNODB;
create table MaxMovieID (id int not null)ENGINE = INNODB;

