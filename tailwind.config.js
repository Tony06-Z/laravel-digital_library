/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [  
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {},
  },
  plugins: [
      require('flowbite/plugin')
  ],
  // resolve: {
  //   alias: {
  //     'bootstrap': path.resolve(__dirname, 'nodes_modules/bootstrap'),
  //   }
  // }
}

