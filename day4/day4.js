var md5 = require('js-md5');

var input = 'iwrupvqb',
    iterator = 0,
    hash = '';

while (hash.substr(0, 5) != '00000') {
    iterator++;
    hash = md5(input + iterator);
}

console.log(hash);
console.log(iterator);