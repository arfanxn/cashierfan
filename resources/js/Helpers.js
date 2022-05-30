export function tap (variable , callback) {
    if (typeof callback != 'function') 
        throw new Error('callback must be a function');

    return callback(variable) ;
}

export function randInt(min = 1 ,max = 9999999) {
     return Math.floor(Math.random() * (max - min + 1) + min)
}

export function imgValidation(filenameOrFilepath){
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.jfif)$/i;
    if(!allowedExtensions.exec(filenameOrFilepath)){
        console.warn('Please upload file having extensions .jpeg/.jpg/.png/.gif/.jfif only.');
        return false;
    }
    return true ; 
}