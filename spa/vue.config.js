module.exports = {
  transpileDependencies: [
    'vuetify'
  ],
  devServer:{
    proxy: 'http://tech.test/api/'
  }
}
