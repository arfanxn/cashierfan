export function tap (variable , callback) {
    if (typeof callback != 'function') 
        throw new Error('callback must be a function');

    return callback(variable) ;
}

export function randInt(min = 1 ,max = 9999999) {
     return Math.floor(Math.random() * (max - min + 1) + min)
}

export function randChars(length = 16 ,chars ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') {

    let randChars = `` ;

    for ( var i = 0; i < length; i++ ) {
        randChars  += chars.charAt(Math.floor(Math.random() * 
        chars.length));
    }

    return randChars  ;
}


export function imgValidation(filenameOrFilepath){
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.jfif)$/i;
    if(!allowedExtensions.exec(filenameOrFilepath)){
        console.warn('Please upload file having extensions .jpeg/.jpg/.png/.gif/.jfif only.');
        return false;
    }
    return true ; 
}