
## About Project

The project is a product review system with the following feature:

1. Each user can add comments to a product by sending the product name and comment
2. Products and the number of comments must be stored in the following file:
    -  "/opt/myprogram/product_comments.txt"
3. Products and the number of comments must be in the following format:
    -  Product name: Total number of comments
4. Adding new comments for a product must increase the total number of comments on that product
5. If the product name does not exist in the system, that product will be added to the system
6. Each user can register a maximum of 2 comments for each product

Please consider the below points:
    <pre>
        <ul>
            <li> Use MySQL as database to store data</li>
            <li> Create a folder in this path "/opt/myprogram/" </li>
            <li> Change the owner to www-data:www-data with chown </li>
        </ul>
    </pre>

## Installation

in project directory :

use cp .env.example .env,

use composer install,

use php artisan key:generate,

use php artisan migrate,

at last use php artisan jwt:secret

