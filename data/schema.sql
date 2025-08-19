CREATE TABLE Gallery(
    ID INTEGER PRIMARY KEY AUTOINCREMENT,
    Name VARCHAR(100) NOT NULL,
    Type VARCHAR(100) NOT NULL,
    Size INT NOT NULL, -- size in bytes
    Width INT NOT NULL,
    Height INT NOT NULL,
    UploadTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

INSERT INTO Gallery(Name, Type, Size, Width, Height) VALUES('a cat', 'jpeg', 715630, 2560, 1714);
INSERT INTO Gallery(Name, Type, Size, Width, Height) VALUES('a dog', 'webp', 162172, 2500, 1875);
INSERT INTO Gallery(Name, Type, Size, Width, Height) VALUES('a car', 'avif', 46631, 600, 410);
INSERT INTO Gallery(Name, Type, Size, Width, Height) VALUES('a monkey', 'jpeg', 1383324, 3214, 2410);
INSERT INTO Gallery(Name, Type, Size, Width, Height) VALUES('a bird', 'jpeg', 29010, 521, 450);