module.exports = {
  content: [
    // https://tailwindcss.com/docs/content-configuration
    "./*.php",
    "./inc/**/*.php",
    "./templates/**/*.php",
    "./safelist.txt",
    //'./**/*.php', // recursive search for *.php (be aware on every file change it will go even through /node_modules which can be slow, read doc)
  ],
  purge: false, // ["./**/*.html", "./**/*.js", "./**/*.php"],
  darkMode: "media", // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        /*  primary: "#002e65", */
        /* light: {
          primary: "#D0E5EC",
        }, */
        /*  primary: "#002e65", */
      },
      fontFamily: {
        '"poppins"': ["Poppins", "sans-serif"],
        "josefin-sans": ["Josefin Sans", "sans-serif"],
        montserrat: ["montserrat", "sans-serif"],
        "dancing-script": ["Dancing Script", "cursive"],
      },
      screens: {
        "2xl": "1685px",
      },
    },
    container: {
      center: true,
      padding: {
        DEFAULT: "1rem",
        sm: "2rem",
        lg: "7%",
        xl: "8%",
        "2xl": "10%",
      },
    },
  },
  variants: {
    extend: {
      backgroundColor: ["active"],
    },
  },
  plugins: [],
};
