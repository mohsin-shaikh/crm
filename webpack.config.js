const path = require('path');

module.exports = {
    resolve: {
        alias: {
            // vue$: 'vue/dist/vue.runtime.esm.js',
            '@': path.resolve('resources/js'),
        },
    },
};
