Project design:

For this gallery we need four pages:
1. List of photos
2. Add new photo
3. Delete photo
4. View photo

Also we need store our data into a single database:

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

Gallery pages description:

Home page: Display the list of photos and provide links to add and delete them.
Add new photo: Provide a form for adding a new photo.
Delete photo: Asks if we actually want to delete a photo and then depending on user's choice deletes it or no.
View photo: Opens a photo on the page.
