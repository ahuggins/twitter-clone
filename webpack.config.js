var Encore = require('@symfony/webpack-encore');
const { VueLoaderPlugin } = require('vue-loader')

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // .enableVersioning(Encore.isProduction())
    .addStyleEntry('css/style', './assets/scss/style.scss')
    .addEntry('js/app', './assets/js/app.js')
    .enableSassLoader()
    .enablePostCssLoader()
    .enableVueLoader()
    .addPlugin(new VueLoaderPlugin)
;

module.exports = Encore.getWebpackConfig();
