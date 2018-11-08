var Encore = require('@symfony/webpack-encore');
const { VueLoaderPlugin } = require('vue-loader')


Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .addEntry('app', './assets/js/main.js')
    .enableVueLoader()
    .addPlugin(new VueLoaderPlugin())
;

module.exports = Encore.getWebpackConfig();
