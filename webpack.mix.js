const mix = require('laravel-mix');
const CompressionWebpackPlugin = require('compression-webpack-plugin');
const rimraf = require('rimraf');

// Clean the dist folder before building when in production
if (mix.inProduction()) {
    mix.before(() => {
        rimraf.sync('dist');
    });
}
mix
    .options({
        processCssUrls: false,
        postCss: [
            require('tailwindcss'), // Ensure Tailwind CSS is added here
            require('autoprefixer'), // Ensure Autoprefixer is included
        ],
    })
    .js('src/app.js', 'js/app.js')
    .sass('src/app.scss', 'css/app.css')
    .setPublicPath('dist')
    .disableNotifications();

if (!mix.inProduction()) {
    mix.sourceMaps(true, 'source-map');
}

mix.webpackConfig({
    plugins: [

        new CompressionWebpackPlugin({
            algorithm: 'gzip',
            test: /\.(js|css|html|svg)$/,
            minRatio: 0.8,
        }),
    ],
});
