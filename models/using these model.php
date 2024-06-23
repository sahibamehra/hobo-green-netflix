// Creating a User
$user = new User(1, "username", "email@example.com", "password123");

// Creating a Profile
$profile = new Profile(1, 2, "John", "van", "Doe", "john.doe@example.com", "password123", "Action");

// Creating a Serie
$serie = new Serie(1, "Breaking Bad", "https://www.imdb.com/title/tt0903747/", 1);

// Accessing properties
echo $user->getUsername(); // Output: username
echo $profile->getVoornaam(); // Output: John
echo $serie->getSerieTitel(); // Output: Breaking Bad
