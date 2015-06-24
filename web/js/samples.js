/**
 * Custom function which rode form editor
 * @param x
 * @returns {Object}
 */
var equation = function(x) {
    var bubble = new Bubble();
    bubble.setupEquation();
    return eval(bubble.parseMathML())
};

// Example of usage
result=[];
for(var i=-1000;1000>i;i++) {
    result.push([i, equation(i)])
}

var plot = new Bubble();

/**
 * Bubble API function
 * @format Array result, Array options
 */
plot.drawPlot(result, null);