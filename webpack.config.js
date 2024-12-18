const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .addEntry('user', './assets/js/user.js') // Fichier JS supplémentaire
    .addStyleEntry('styles', './assets/scss/app.scss')
    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[ext]'
    })
    .enableSassLoader((options) => {
        options.sassOptions = {
            quietDeps: true, // Supprime les avertissements liés à @import
        };
    })    
    .enableSingleRuntimeChunk()
    .enableSourceMaps(!Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableVersioning(Encore.isProduction());

module.exports = Encore.getWebpackConfig();