# TELL IT

**Tell it** is a news/info management software it is a *soon to be realeased full-packaged application* that will be of great help to the media industry. The scheduled completion date is **January 31 2017** and release of version 1.0. is February 28 2017. There is currently a live version at [Verbatim Express](http://verbatimexpress.com)

###System Users

1. Administrator - Manages Reporters, Columnists, and Columns
2. Reporters - Manages reports
3. Columnists - Manage articles in his/her personal column
4. Guests - Interacts with reports(share, like, view comment)

###Screenshots

![Dashboard](/tellit/dashboard.PNG)
![Breaking News](/tellit/breakingnews.PNG)
![New Report](/tellit/new_report.PNG)
![GUEST PAGE](/tellit/verbatim.PNG)
![Headline Picture](/tellit/dp.PNG)
![Customize Page](/tellit/customize.PNG)

## Getting Started

### Prerequisites

1. You must have [Apache Server](https://www.apache.org/), [Mysql Database](https://www.mysql.com/), [PHP 5+](http://php.net/). You can either download all independently or download [XAMPP](https://www.apachefriends.org/index.html).

2. Setup GIT locally.

### Installation

**Clone the project to your server**: On your PC, navigate to your server directory and create a new folder for the project. Open git bash, navigate to the project folder you just created and run the command below.

```
$ git clone https://github.com/holuborhee/Tell-It
```

### Database setup

1. Import to your database server "tellit.sql" file.
2. Locate ".env.example" file and change the values below to match you server value

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tellit
DB_USERNAME=YOUR USERNAME
DB_PASSWORD=YOUR PASSWORD

```
Lastly, Rename the ".env.example" to ".env"

### Run the app

To get started navigate to the application in your browser, you are now good to go. Note to access the admin page, add a "/home" to the applications base url.

Use the below details to log in

```
Email Address: daveholuborhee@gmail.com
Password: secret123

```

## Built With

* [Laravel 5.3](https://laravel.com/)
* [Twitter Bootstrap](https://getbootstrap.com/)
* [JQUERY](https://jquery.com/)
* [AJAX](https://getbootstrap.com/)
* [MIND MUP](https://mindmup.github.io/bootstrap-wysiwyg/)
* [DROPZONE JS](http://www.dropzonejs.com/)

## Contributing

Please feel free to fork this package and contribute by submitting a pull request to enhance the functionalities.


## How can I thank you?

Why not star the github repo? I'd love the attention! Why not share the link for this repository on Twitter or HackerNews? Spread the word!

Thanks!
John David.

## Author

[John Olubori David](https://github.com/holuborhee)

### Contacts

* Email: daveholuborhee@gmail.com
* LinkedIn: https://ng.linkedin.com/in/johnoluboridavid
* Facebook: https://www.facebook.com/daveholuborhee

## License

This project is licensed under the [MIT license](http://opensource.org/licenses/MIT).
