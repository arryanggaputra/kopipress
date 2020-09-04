module.exports = {
  purge: [],
  theme: {
    typography: {
      default: {
        css: {
          color: "var(--text-color)",
          blockquote: {
            color: "var(--text-color)",
            fontSize: "1.3rem",
            fontFamily: "monospace",
            wordBreak: "break-word",
          },
          h1: {
            color: "var(--text-color)",
          },
          h2: {
            color: "var(--text-color)",
          },
          h3: {
            color: "var(--text-color)",
          },
          h4: {
            color: "var(--text-color)",
          },
          h5: {
            color: "var(--text-color)",
          },
          strong: {
            color: "var(--link-color-hover)",
          },
          code: {
            color: "var(--link-color-hover)",
          },
          a: {
            color: "var(--link-color)",
            "&:hover": {
              color: "var(--link-color-hover)",
            },
          },
        },
      },
    },
    extend: {
      colors: {
        primary: "var(--primary) !important",
        secondary: "var(--secondary) !important",
      },
    },
    container: {
      screens: {
        sm: "100%",
        md: "100%",
        lg: "1000px",
        xl: "1000px",
      },
    },
  },
  variants: {},
  plugins: [
    require("@tailwindcss/typography")({
      modifiers: ["sm"],
    }),
  ],
};
