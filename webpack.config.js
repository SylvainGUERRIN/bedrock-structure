const outputPath = 'web/app/themes/maquette/assets';
const webpackAssetsManifest = require('webpack-assets-manifest');
const path = require('path');
const {isProduction} = require('webpack-mode');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const CSSLoader = () => {
    const postCSSPlugins = [require('css-mqpacker')()];
    if (isProduction) {
        postCSSPlugins.push(require('autoprefixer'));
        postCSSPlugins.push(require('cssnano')())
    }
    return{
        test: /\.s?css$/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader,
                options: {
                    filename: '[name].[hash].css',
                    chunkFilename: '[id].[hash].css',
                    hmr: !isProduction
                }
            },
            'css-loader',
            {loader: 'postcss-loader', options: {plugins: postCSSPlugins}},
            'sass-loader'
        ]
    }
};

//console.log(isProduction);

module.exports = {
    entry: {
        main: ['./assets/js/main.js','./assets/css/main.scss']
    },
    output: {
        path: path.resolve(__dirname, outputPath),
        publicPath: isProduction ? './' : 'http://localhost:3000/',
        filename: isProduction ? '[name].[hash].js' : '[name].js'
    },
    devServer: {
        port: 3000,
        host: '0.0.0.0',
        hot: true,
        stats: 'minimal',
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, PATCH, OPTIONS',
            'Access-Control-Allow-Headers': 'X-Requested-With, content-type, Authorization',
        }
    },
    stats: 'minimal',
    // resolve: {
    //     extensions: ['.mjs','.js','.svelte'],
    //     mainFields: ['svelte','browser','module','main'],
    //     alias: {
    //         svelte: path.resolve('node_modules','svelte'),
    //         "@fn": path.resolve(__dirname, 'assets/js/functions/'),
    //         "@components": path.resolve(__dirname, 'assets/js/functions/'),
    //     }
    // }
    externals: {
        'jquery': 'jQuery',
    },
    module: {
        rules: [
            // {
            //     test: /\.mjs$/,
            //     include: /node_modules/,
            //     type: 'javascript/auto',
            //     loader: 'babel-loader',
            // },
            // {
            //     test: /\.js$/,
            //     exclude: /(node_modules|bower_components)/,
            //     use: {}
            // },
            {
                test: /\.(png|jpg|gif|eot|svg|ttf|woff|woff2)$/i,
                use: [
                    'file-loader'
                ]
            },
            // {
            //     test: /\.(scss)$/i,
            //     use: [
            //         'file-loader'
            //     ]
            // },
            CSSLoader()
        ]
    },
    plugins: [
        new webpackAssetsManifest({
            writeToDisk: true,
            publicPath: true
        }),
        new MiniCssExtractPlugin({
            filename: '[name].css',
            chunkFilename: '[id].css'
        })
    ]
};
