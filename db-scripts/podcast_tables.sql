

CREATE TABLE Channel(
    Channel_id int (10),
    Title varchar (75),
    Description varchar(150),
    Primary Key(Channel_id)
)

CREATE TABLE Gen_Metadata(
    Gen_meta_id int(10),
    link varchar(150),
    Image_location varchar(150),
    owner_name varchar(75),
    owner_email varchar(150),
    podcast_type varchar(30),
    author varchar(100), 
    lang varchar(10),
    explicit_status varchar(3),
    Primary Key(Gen_meta_id)
)

CREATE TABLE Metadata(
    Metadata_id int(10),
    Storage_link varchar(150),
    Runtime int(15),
    Format varchar(15),
    File_name varchar(100),
    Created varchar(50),
    Published date,
    duration timestamp,
    explicit_status varchar(3),
    Gen_meta_id int(10),
    Primary Key(Metadata_id)
    Foreign Key (Gen_meta_id)
        REFERENCES Gen_Metadata(Gen_meta_id)
        ON DELETE SET NULL,
)

CREATE Table Episode(
    Episode_id
    Title varchar(75),
    summary varchar(100),
    Num varchar(5),
    author varchar(75),
    Series_id int(10),
    Primary Key(Episode_id),
    Foreign Key (Series_id)
        REFERENCES Series(Series_id)
        ON DELETE SET NULL,
)


CREATE TABLE Series(
    Series_id int(10),
    Title varchar(75),
    subtitle varchar(75),
    Descr varchar(150),
    summary varchar(75),
    num varchar(5),
    Primary Key(Series_id)
)

CREATE TABLE Platform(
    Platform_id int(10),
    Name varchar(50),
    Primary Key(Platform_id)
)

CREATE TABLE Available_on(
    Available_id int(10),
    Platform_id int(10),
    Primary Key(Available_id),
    Foreign Key (Platform_id)
        REFERENCES Platform(Platform_id)
        ON DELETE SET NULL,
)

CREATE TABLE Tag(
    Tag_id int(10),
    Name varchar(50),
    Primary Key(Tag_id)
)

CREATE TABLE Tags(
    Tags_id int(10),
    Tag_id int(10),
    Foreign Key (Tag_id)
        REFERENCES Tag(Tag_id)
        ON DELETE SET NULL,
)

CREATE TABLE Podcast(
    Podcast_id int(10),
    Episode varchar(15), 
    Description varchar(150),
    Tags_id int(10),
    Metadata_id int(10),
    Channel_id int(10),
    Primary Key(Podcast_id),
     Foreign Key (Tags_id)
        REFERENCES Tags(Tags_id)
        ON DELETE SET NULL,
    Foreign Key (Metadata_id)
        REFERENCES Metadata(Metadata_id)
        ON DELETE SET NULL,
    Foreign Key (Channel_id)
        REFERENCES Channel(Channel_id)
        ON DELETE SET NULL
)