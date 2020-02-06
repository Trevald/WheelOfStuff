// vue.config.js

const devServer = {
    proxy: {
      '^/api': {
        target: 'http://wheel.test',
        ws: true,
        changeOrigin: true,
      },
    },
  };

module.exports = {
    outputDir: "./../public",
    devServer
}