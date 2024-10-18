const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const { VueLoaderPlugin } = require('vue-loader');

module.exports = {
  entry: './index.js', // Точка входа
  output: {
    filename: 'bundle.js', // Имя скомпилированного файла
    path: path.resolve(__dirname, 'dist'), // Папка для сборки
  },
  mode: 'development', // Режим сборки
  devServer: {
    static: {
      directory: path.resolve(__dirname, 'dist'),
    },
    compress: true, // Сжатие для оптимизации
    port: 8080, // Порт сервера
  },
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader',
      },
      {
        test: /\.js$/,
        use: 'babel-loader',
        exclude: /node_modules/,
      },
      {
        test: /\.css$/,
        use: ['style-loader', 'css-loader'],
      },
      {
        test: /\.(png|svg|jpg|gif|woff(2)?|eot|ttf|otf)$/,
        type: 'asset/resource',
      },
      {
        test: /\.html$/i,
        loader: 'html-loader',
      },
    ],
  },
  resolve: {
    extensions: ['*', '.js', '.vue', '.json'], // Теперь это внутри resolve
  },
  plugins: [
    new VueLoaderPlugin(),
    new CleanWebpackPlugin(),
    new HtmlWebpackPlugin({
      template: './index.html',
      filename: 'index.html',
      minify: false,
    }),
    new MiniCssExtractPlugin({
      filename: 'main.css',
    }),
  ],
};
