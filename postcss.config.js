const purgecss = require("@fullhuman/postcss-purgecss")({
  // Specify the paths to all of the template files in your project
  content: [
    "./*.php",
    "./lib/*.php",
    "./includes/*.php",
    "./samples/*.html",
    // etc.
  ],
  whitelistPatternsChildren: [
    /^prose$/,
    /^prose-lg$/,
    /^xl:prose-xl$/,
    /^max-w-none$/,
  ],

  // Include any special characters you're using in this regular expression
  defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || [],
});
module.exports = {
  plugins: [
    require("tailwindcss"),
    require("autoprefixer"),
    ...(process.env.NODE_ENV === "production"
      ? [
          purgecss,
          require("cssnano")({
            preset: "default",
          }),
        ]
      : []),
  ],
};
