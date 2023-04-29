## MovieRate Parser

## About

MovieRate Parser is a web scraping project built using Laravel framework version 10.8 and PHP version 8.1. The application scrapes movie data from the website movierate.co and stores it in a MySQL database. It also provides a basic user interface to view and search the scraped data.
Parse logic based oon library - Goutte.

## Installation

1. Clone the repository:
<pre>
git clone https://github.com/Alice932/MovieRate.git
</pre>

2. Navigate to the project directory and install the dependencies:
<pre>
cd MovieRate
composer install
</pre>

3. Create a .env file based on .env.example:
<pre>
cp .env.example .env
</pre>

4. Create a database and add the corresponding information to the .env file.

5. Run the migrations:
<pre>
php artisan migrate
</pre>

6. Start the local server and open the browser to navigate to http://localhost:8000:
<pre>
php artisan serve
</pre>

7. Edit app/Console/Commands/ParseMoviesCommand:
<pre>
$maxPages = 100; //change to count of pages that you need
</pre>
Same with ParseSerialsCommand and ParseNewsCommand

8. Launch parsing command:
<pre>
php artisan parse:movies

php artisan parse:serials

php artisan parse:news
</pre>

## Project sitemap

1. <b>Home Page:</b> Displays information about some movies. <i>(/)</i>
2. <b>Movies Index Page:</b> Displays a list of all the movies in our database. <i>(/movies)</i>
3. <b>Movies Show Page:</b> Displays detailed information about a particular movie. <i>(/movie/id)</i>
4. <b>TV Shows Index Page:</b> Displays a list of all the TV shows in our database. <i>(/serials)</i>
5. <b>TV Shows Show Page:</b> Displays detailed information about a particular TV show. <i>(/serial/id)</i>
6. <b>News Index Page:</b> Displays a list of all the news in our database. <i>(/news)</i>
7. <b>News Show Page:</b> Displays detailed information about news. <i>(/news/id)</i>
