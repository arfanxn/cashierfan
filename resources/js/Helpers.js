export function tap(variable, callback = null) {
    if (typeof variable == 'function' && callback == null) {
        return variable();
    } else if (typeof variable != 'function' && typeof callback != 'function') {
        throw new Error('callback must be a function');
    }

    return callback(variable);
}

export function randInt(min = 1, max = 9999999) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}

export function randChars(
    length = 16,
    chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
) {
    let randChars = ``;

    for (var i = 0; i < length; i++) {
        randChars += chars.charAt(Math.floor(Math.random() * chars.length));
    }

    return randChars;
}

export function imgValidation(filenameOrFilepath) {
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.jfif)$/i;
    if (!allowedExtensions.exec(filenameOrFilepath)) {
        console.warn(
            'Please upload file having extensions .jpeg/.jpg/.png/.gif/.jfif only.'
        );
        return false;
    }
    return true;
}

export function isset(accessor, fallback = null, report = false) {
    try {
        const accessed = accessor();
        if (typeof accessed === 'undefined')
            throw new Error('Accessor returning undefined');

        return accessed;
    } catch (err) {
        if (report === true) console.error(err);

        if (typeof fallback === 'function') return fallback();

        return fallback ? fallback : null;
    }
}

export function setURIQueryString(uri, key, value) {
    var re = new RegExp('([?&])' + key + '=.*?(&|$)', 'i');
    var separator = uri.indexOf('?') !== -1 ? '&' : '?';
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + '=' + value + '$2');
    } else {
        return uri + separator + key + '=' + value;
    }
}

export function toCurrency(input, locale = 'id-ID', currency = 'IDR') {
    let fmt = String(input)
        .replace(/(?<=\d)[.,](?!\d+$)/g, '')
        .replace(',', '.');
    const pts = fmt.split('.');
    if (pts.length > 1) {
        if (+pts[0] === 0) fmt = pts.join('.');
        else if (pts[1].length === 3) fmt = pts.join('');
    }

    // format the input string to different formats
    const number = Number(fmt);
    const string = number.toFixed(2);
    // detect if the number is valid
    const isValid = isFinite(number);

    // regex pattern
    const exceptNumericNCommaNDot = /[^0-9,.]/gi;

    // format to currency
    let output = new Intl.NumberFormat(locale, {
        style: 'currency',
        currency
    }).format(number);

    // get the currency symbol from "output" string
    const symbol = String(output)
        .match(exceptNumericNCommaNDot)
        .join('')
        .replace(/\s/, '');

    // remove the currency symbol
    const withoutSymbol = String(output).replace(exceptNumericNCommaNDot, '');

    return {
        input,
        isValid,
        string,
        number,
        currency,
        output,
        withoutSymbol,
        symbol
    };
}
