module.exports = {

  baseUrl: process.env.NODE_ENV === 'production'
      ? '/build'
      : '/',

  // output built static files to Laravel's public dir.
  // note the "build" script in package.json needs to be modified as well.
  outputDir: '../../public/build',

  // modify the location of the generated HTML file.
  // make sure to do this only in production.
  indexPath: process.env.NODE_ENV === 'production'
    ? '../../templates/index.html.twig'
    : 'index.html',
};