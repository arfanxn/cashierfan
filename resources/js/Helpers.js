export function tap (variable , callback) {
    if (typeof callback != 'function') 
        throw new Error('callback must be a function');

    return callback(variable) ;
}

export function randInt(min = 1 ,max = 9999999) {
     return Math.floor(Math.random() * (max - min + 1) + min)
}