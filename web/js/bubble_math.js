function Bubble(name, code, diff, results, type){
    this.name = name;
    this.code = code;
    this.diff = diff;
    this.results = results;
    this.type = type;
}

Bubble.prototype.evaluateCode = function() {
    this.results = eval(this.code);
};

Bubble.prototype.drawPlot = function(options) {
    $.plot($('#bubblePlot'), this.results, options);
};