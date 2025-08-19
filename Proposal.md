For this gallery we need four pages:
1. List of photos
2. Add new photo
3. Delete photo
4. See photo

Also we need store our data into a single database:

CREATE TABLE Gallery(
    ID INTEGER PRIMARY KEY AUTOINCREMENT,
    Name VARCHAR(100) NOT NULL,
    Type VARCHAR(100) NOT NULL,
    Size INT NOT NULL,
    Width INT NOT NULL,
    Height INT NOT NULL,
    UploadTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

Gallery pages description:

Home page: Display the list of photos and provide links to add and delete them.
Add new photo: Provide a form for adding a new photo.
Delete photo: Asks if we actually want to delete an photo and then depending on user's choice deletes it or no.
View photo: Opens a photo on the page.
