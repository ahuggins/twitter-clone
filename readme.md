# Twitter Clone

### Installation
Clone the repo to wherever you store webapps on your machine.

* `git clone git@github.com:ahuggins/twitter-clone.git`
    * Or set a customFolder name - `git clone git@github.com:ahuggins/twitter-clone.git customFolder`

* `cd twitter-clone` (Or if you customized the name of the holding folder, use that) `cd customFolder` 

* `composer install`

* `yarn install`

* `yarn run dev` (Compiles CSS and JS assets)
    * CSS - `assets/css/style.css` will compile to `public/css/style.css` with all TailwindCSS and custom styles. 
    * JS - `assets/js/app.js` will compile to `public/js/app.js`. Register components or other changes can go in `assets/js/app.js`.
    * Vue components - `assets/js/components/` is where the .vue single file components should go.

You can use any server running php 7.1.3 or higher. The easiest way to run this is to use the built in php server. You can run `bin/console server:start`. You should see `[OK] Server listening on http://127.0.0.1:8000` which means you can visit `http://127.0.0.1:8000` in a browser and you should see the site.

Add db credentials to the .env file, in line 23. Replace the `db_user` with your database user, replace `db_password` with the database password, and replace `db_name` with the name of the password.

Then run `bin/console doctrine:migrations:migrate`. You will be asked that running the migrations could result in data loss, but if you are installing this for the first time, you can safely answer `y`.

##### Sample Data

To better asses the app, you can install sample data with users and tweets. You just need to run `bin/console doctrine:fixtures:load` in the terminal. It will ask prompt you `Careful, database will be purged. Do you want to continue?` If you are testing this app, enter `y`, if not you probably should not run this command, because you will lose data.

### Using Site

Visit the site in a browser. If you used the php server, visit `http://127.0.0.1:8000` or if you set up a `hosts` file record, use that.

You should see the "landing" page for the site. Here you can sign up or log in. If this is your first time using the app, you will need to "Sign up." Click the Sign Up button.

The Sign Up page allows you to register. As long as your username and email are unique, upon registration it will redirect you to the login page. Use the credentials to login.

Upon Login, you will see the home page, if you installed the sample data, you should see users listed. Click a user name to view their profile. You can also view your own if you go to the user navigation in the top right corner and click `View Profile`.

You can post a tweet anywhere the Tweet form is shown. The tweet will be added to the db, and if you are on your profile, it will be added inline.

Tweets are limited to 250 characters, and will warn you when there are fewer than 40 characters left, as well as fewer than 20 characters. If you go over 250 characters you will not be able to post the tweet. Make sure it is 250 or less characters.