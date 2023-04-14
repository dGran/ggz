/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            textColor: {
                'custom-tab': '#7D00E2',
            },
            maxWidth: {
                'xl': '36rem',
              },
            width: {
                'custom-105': '105px',
                'custom-142': '142px',
            },
            height: {
                'custom-105': '105px',
                'custom-142': '142px',
            },  
            backgroundOpacity: {
                '10': '0.1',
                '20': '0.2',
                '25': '0.25',
            },
            fontSize: {
                '4xl': '2.5rem',
                '5xl': '3rem',
                '6xl': '4rem',
                '7xl': '5rem',
            },
            fontWeight: {
                'extrabold': '900',
        },
        colors: {
            'purpleggz' : '#7D00E2',
            'purpleggz2' : '#A535FF',
            'disabled-gray' : '#969696',
            'purpleggz-inactive' : '#A768EC',
            'main-bg' : '#F7F7F7',
            'black-text' : '#303030',
            'gray-border' : '#D6D6D6'
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
}