module.exports = {
  content: [
    // https://tailwindcss.com/docs/content-configuration
    "./*.php",
    "./inc/**/*.php",
    "./templates/**/*.php",
    "./safelist.txt",
    "./**/*.php", // recursive search for *.php (be aware on every file change it will go even through /node_modules which can be slow, read doc)
  ],
  darkMode: "media", // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        lcw: {
          primary: {
            white: "#D6D6D6",
            red: "#D72818",
            blue: "#14151B",
            gray: "#E7E7E7",
          },
        },
      },
      fontFamily: {
        '"poppins"': ["Poppins", "sans-serif"],
        "josefin-sans": ["Josefin Sans", "sans-serif"],
        montserrat: ["montserrat", "sans-serif"],
        "dancing-script": ["Dancing Script", "cursive"],
        rubik: ["Rubik", "sans-serif"],
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
