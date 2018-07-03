# Twitter Clone

### Installation
Clone the repo to wherever you store webapps on your machine.

* `git clone git@github.com:ahuggins/twitter-clone.git`
    * Or set a customFolder name - `git clone git@github.com:ahuggins/twitter-clone.git customFolder`

* `cd twitter-clone` || `cd customFolder` (Or if you customized the name of the holding folder, use that)

* `composer install` composer version  1.5.1

* `yarn install` yarn version 1.5.1

* `yarn run dev` (Compiles CSS and JS assets)
    * CSS - `assets/css/style.css` will compile to `public/css/style.css` with all TailwindCSS and custom styles. 
    * JS - `assets/js/app.js` will compile to `public/js/app.js`. Register components or other changes can go in `assets/js/app.js`.
    * Vue components - `assets/js/components/` is where the .vue single file components should go.

You can use any server running php 7.1.3 or higher. The easiest way to run this is to use the built in php server. You can run `bin/console server:start`. You should see `[OK] Server listening on http://127.0.0.1:8000` which means you can visit `http://127.0.0.1:8000` in a browser and you should see the site.



Add db credentials to the .env file, in line 23. Replace the `db_user` with your database user, replace `db_password` with the database password, and replace `db_name` with the name of the password.

Then run `bin/console doctrine:migrations:migrate`. You will be asked that running the migrations could result in data loss, but if you are installing this for the first time, you can safely answer `y`.

### First Steps

After the above steps are complete, navigate to 


