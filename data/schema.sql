CREATE TABLE gallery(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(100) NOT NULL,
    path VARCHAR(255) NOT NULL,
    size INT NOT NULL,
    width INT NOT NULL,
    height INT NOT NULL,
    uploadtime TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

--INSERT INTO gallery(Name, Type, Size, Width, Height) VALUES('a cat', 'jpeg', 715630, 2560, 1714);
--INSERT INTO gallery(Name, Type, Size, Width, Height) VALUES('a dog', 'webp', 162172, 2500, 1875);
--INSERT INTO gallery(Name, Type, Size, Width, Height) VALUES('a car', 'avif', 46631, 600, 410);
--INSERT INTO gallery(Name, Type, Size, Width, Height) VALUES('a monkey', 'jpeg', 1383324, 3214, 2410);
--INSERT INTO gallery(Name, Type, Size, Width, Height) VALUES('a bird', 'jpeg', 29010, 521, 450);