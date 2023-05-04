const path = require("path");

// css extraction and minification
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");

// clean out build dir in-between builds
const { CleanWebpackPlugin } = require("clean-webpack-plugin");

module.exports = [
  {
    entry: {
      //main: ["./js/src/main.js", "./css/src/main.scss"],
      main: "./assets/scripts/main.js",
    },
    output: {
      filename: "./dist/[name].min.js",
      //filename: "./dist/[name].min.[fullhash].js",
      path: path.resolve(__dirname),
    },
    module: {
      rules: [
        // js babelization
        {
          test: /\.(js|jsx)$/,
          exclude: /node_modules/,
          loader: "babel-loader",
        },

        {
          test: /\.(s[ac]|c)ss$/i,
          use: [
            {
              loader: MiniCssExtractPlugin.loader,
              options: { publicPath: "" },
            },

            "css-loader",
            "postcss-loader",
            "sass-loader",
          ],
        },
        /*  // sass compilation
        {
          test: /\.(sass|scss)$/,
          use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
        }, */
        // loader for webfonts (only required if loading custom fonts)
        {
          test: /\.(woff|woff2|eot|ttf|otf)$/,
          type: "asset/resource",
          generator: {
            filename: "./css/build/font/[name][ext]",
          },
        },
        // loader for images and icons (only required if css references image files)
        {
          test: /\.(png|jpg|gif)$/,
          type: "asset/resource",
          generator: {
            filename: "./css/build/img/[name][ext]",
          },
        },
      ],
    },
    plugins: [
      // clear out build directories on each build
      new CleanWebpackPlugin({
        cleanOnceBeforeBuildPatterns: ["./js/build/*", "./css/build/*"],
      }),
      // css extraction into dedicated file
      new MiniCssExtractPlugin({
        filename: "./dist/main.min.css",
      }),
      new BrowserSyncPlugin({
        proxy: "lcw.local",
        files: ["**/*.php", "**/*.css", "**/*.scss"],
        notify: false,
      }),
    ],
    optimization: {
      // minification - only performed when mode = production
      minimizer: [
        // js minification - special syntax enabling webpack 5 default terser-webpack-plugin
        `...`,
        // css minification
        new CssMinimizerPlugin(),
      ],
    },
  },
];
