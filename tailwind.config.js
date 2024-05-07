/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        "color-primary-100": "#F8FED8",
        "color-primary-200": "#EFFDB3",
        "color-primary-300": "#E2FB8C",
        "color-primary-400": "#D4F76E",
        "color-primary-500": "#C0F340",
        "color-primary-600": "#9DD02E",
        "color-primary-700": "#7DAE20",
        "color-primary-800": "#5F8C14",
        "color-primary-900": "#4A740C",
        "color-success-100": "#F3FCD9",
        "color-success-200": "#E6FAB5",
        "color-success-300": "#CFF08C",
        "color-success-400": "#B6E16C",
        "color-success-500": "#93CE40",
        "color-success-600": "#75B12E",
        "color-success-700": "#5A9420",
        "color-success-800": "#417714",
        "color-success-900": "#30620C",
        "color-info-100": "#DEE7FF",
        "color-info-200": "#BECFFF",
        "color-info-300": "#9EB5FF",
        "color-info-400": "#86A0FF",
        "color-info-500": "#5E7EFF",
        "color-info-600": "#445FDB",
        "color-info-700": "#2F44B7",
        "color-info-800": "#1D2E93",
        "color-info-900": "#121E7A",
        "color-warning-100": "#FEFAD1",
        "color-warning-200": "#FEF4A4",
        "color-warning-300": "#FDEB76",
        "color-warning-400": "#FBE254",
        "color-warning-500": "#F9D51D",
        "color-warning-600": "#D6B315",
        "color-warning-700": "#B3920E",
        "color-warning-800": "#907309",
        "color-warning-900": "#775D05",
        "color-danger-100": "#FFE5D9",
        "color-danger-200": "#FFC5B4",
        "color-danger-300": "#FF9E8E",
        "color-danger-400": "#FF7972",
        "color-danger-500": "#FF444B",
        "color-danger-600": "#DB3147",
        "color-danger-700": "#B72242",
        "color-danger-800": "#93153B",
        "color-danger-900": "#7A0D37"
      }
    },
  },
  plugins: [],
}

