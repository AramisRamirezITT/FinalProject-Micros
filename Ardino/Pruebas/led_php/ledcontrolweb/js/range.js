function isOlderEdgeOrIE() {
    return (
        window.navigator.userAgent.indexOf("MSIE ") > -1 ||
        !!navigator.userAgent.match(/Trident.*rv\:11\./) ||
        window.navigator.userAgent.indexOf("Edge") > -1
    );
}

function valueTotalRatio(value, min, max) {
    return ((value-min)/(max-min)).toFixed(2);
}

function getLinearGradientCSS(ratio, leftColor, rightColor) {
    return [
        '-webkit-gradient(',
        'linear, ',
        'left top, ',
        'right top, ',
        'color-stop(' + ratio/4 + ', ' + leftColor + '), ',
        'color-stop(' + ratio + ', #81d895), ',
        'color-stop(' + ratio + ', ' + rightColor + ')',
        ')'
    ].join('');
}

function updateRange(range) {
    var ratio = valueTotalRatio(range.value, range.min, range.max);
    range.style.backgroundImage = getLinearGradientCSS(ratio, '#31beb5', '#e3ebfe');
}