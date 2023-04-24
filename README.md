# Eventcub GitHub PHPH Repositories API

This application queries GitHub's API and returns repositories with the topic "php". The API exposes the following endpoints:

-   `/api/php` - returns repositories with the topic "php", without any filter or sorting.
-   `/api/popularity/php` - returns repositories sorted by popularity (stargazers_count).
-   `/api/activity/php` - returns repositories sorted by activity (updated_at).

## Instructions

### Prerequisites

-   Git
-   PHP 7.4 or later
-   Composer

### Installation

1. Clone the repository using the command `git clone https://github.com/khobbie/eventcube-github-api.git`
2. Navigate to the project root directory
3. Copy the `.env.example` file and rename it to `.env` using the command `cp .env.example .env`
4. Set the `GITHUB_TOKEN` and `GITHUB_BASE_URL` variable in the `.env` file to your personal access token with the `repo` scope.
   `GITHUB_BASE_URL=https://api.github.com/search/repositories`.
   You can generate a new token by following the instructions [here](https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token).
5. Install the project dependencies using the command `composer install`

### Usage

1. Start the application using the command `php artisan serve`
2. The application will be available at `http://127.0.0.1:8000`
3. Use a tool like `Postman` or a web browser to test the API endpoints:
    - `http://127.0.0.1:8000/api/php`
    - `http://127.0.0.1:8000/api/popularity/php`
    - `http://127.0.0.1:8000/api/activity/php`
4. You can also specify the `page` and `per_page` query parameters to test pagination, for example: `http://127.0.0.1:8000/api/php?page=2&per_page=50`

5. Postman published collection on the APIs [here](https://documenter.getpostman.com/view/1937580/2s93Y5PKr2)

## API Endpoints

### `/api/php`

### `/popularity/php`

### `/api/activity/php`

#### Query Parameters

-   `page` - (optional) The page number of the results. Defaults to 1.
-   `per_page` - (optional) The number of results per page. Defaults to 100. Maximum value is 1000.

#### Response

The response is a JSON object with the following properties:

-   `page` - The page of repositories with the topic "php".
-   `count_per_page` - The total number of repositories with the topic "php".
-   `repositories` - An array of repositories. Each repository has the following properties:
    -   `id` - The ID of the repository.
    -   `name` - The name of the repository.
    -   `full_name` - The full name of the repository.
    -   `html_url` - The URL of the repository on GitHub.
    -   `language` - The primary language of the repository.
    -   `updated_at` - The date and time when the repository was last updated.
    -   `pushed_at` - The date and time of the last push to the repository.
    -   `stargazers_count` - The number of users who have starred the repository.
