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
            width: {
                '1/7': '14.2857143%',
                '2/7': '28.5714286%',
                '3/7': '42.8571429%',
                '4/7': '57.1428571%',
                '5/7': '71.4285714%',
                '6/7': '85.7142857%',
                '1/6': '16.6666667%',
                '2/6': '33.3333333%',
                '3/6': '50%',
                '4/6': '66.6666667%',
                '5/6': '83.3333333%',
                '1/5': '20%',
            },
            spacing: {
                '8': '2rem',
                '9': '2.25rem',
                '11': '2.75rem',
                '28': '7rem',
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
                '128': '32rem',
                '144': '36rem',
            },
            minHeight: {
                '60-screen': '60vh',
                '65-screen': '65vh',
                '70-screen': '70vh',
                '75-screen': '75vh',
                '80-screen': '80vh',
                '85-screen': '85vh',
                '90-screen': '90vh',
                '95-screen': '95vh',
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