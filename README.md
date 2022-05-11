## Laravel 8.8 Application With Basic User and Admin Module

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:


## Download and setup

<p dir="auto">
Just download the code and setup in your server accessible directory. <br/>
For Example, create 'laramaster' at /var/www/html/laramaster and add downloaded code
</p>

<p dir="auto">
Copy the .env.example to .env file <br/>
Update the database configuration in your .env file
</p>

<p dir="auto">
generate application key using below command
<pre class="notranslate">
<code class="notranslate">php artisan key:generate</code>
</pre>
</p>

<p dir="auto">
Goto your project root directory and run the below command to install dependencies
<pre class="notranslate">
<code class="notranslate">composer install</code>
</pre>
</p>

<p dir="auto">
Run the migration at your project root directory to create require database tables.
<pre class="notranslate">
<code class="notranslate">php artisan migrate</code>
</pre>
</p>

<p dir="auto">
Run the seeder to add default admin.
<pre class="notranslate">
<code class="notranslate">php artisan db:seed --class=AdminUserSeeder</code>
</pre>
</p>

<p dir="auto">
Your Defautl Admin Details Is: <br/>
Email: developer8here@gmail.com <br/>
Password: master99
</p>

<p dir="auto">
I have used Anyar free HTML for frontend.
</p>

<p dir="auto">
For any query or suggestion you can contact me at <a href="mailto:developer8here@gmail.com">developer8here@gmail.com</a>
</p>
