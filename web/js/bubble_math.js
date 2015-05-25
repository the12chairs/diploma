function Bubble(){
    //this.code = code;
    //this.results = results;
    this.mathML = null;
    this.equation = null;
    //this.func = func;
}

Bubble.prototype.evaluateCode = function() {
    this.results = eval(this.code);
};

Bubble.prototype.drawPlot = function(options) {
    $.plot($('#bubblePlot'), this.results, options);
};

Bubble.prototype.setMathML = function(mathML) {
    this.mathML = mathML;
};

Bubble.prototype.setupEquation = function() {
    this.setMathML(editor.getMathML());
    this.func = this.parseMathML();
    return this.func;
};

function getDOM(xmlstring) {
    parser = new DOMParser();
    return parser.parseFromString(xmlstring, "text/xml");
}

function remove_tags(node) {
    var result = "";
    var nodes = node.childNodes;
    var tagName = node.tagName;
    if (!nodes.length) {
        if (node.nodeValue == "π") result = "pi";
        else if (node.nodeValue == " ") result = "";
        else result = node.nodeValue;
    } else if (tagName == "mfrac") {
        result = "("+remove_tags(nodes[0])+")/("+remove_tags(nodes[1])+")";
    } else if (tagName == "msup") {
        result = "Math.pow((" + remove_tags(nodes[0]) + "),(" + remove_tags(nodes[1]) + "))";
    } else if (tagName == "msub") {
        result = "digitConvert((" + remove_tags(nodes[0]) + "),(" + remove_tags(nodes[1]) + "))";
    } else if(tagName == "mtable") {

        result = [];

        var cols = 0;
        var rows = 0;

        for (var i = 0; i < nodes.length; ++i) {
            if(nodes[i].tagName == 'mtr') {
                rows++;
                var mtd = nodes[i].childNodes;
                cols = mtd.length;
            }
        }

        var noTaggedNodes = '';

        for (var i = 0; i < nodes.length; ++i) {
            noTaggedNodes += (remove_tags(nodes[i]));
        }

        return arrayedResult(rows, cols, noTaggedNodes);
    }
    else {
        for (var i = 0; i < nodes.length; ++i) {
            result += remove_tags(nodes[i]);
        }
    }

    if (tagName == "mfenced") result = "("+result+")";
    if (tagName == "msqrt") result = "Math.sqrt("+result+")";

    return result;
}

function arrayedResult(cols, rows, line) {
    var result = [];
    var iterator = 0;
    for (var i = 0; i < rows; i++) {
        result[i] = [];
        for (var j = 0; j < cols; j++) {
            result[i][j] = line.charAt(iterator);
            iterator++;
        }
    }

    return result;
}

function stringifyMathML(mml) {
    xmlDoc = getDOM(mml);
    return remove_tags(xmlDoc.documentElement);
}

Bubble.prototype.parseMathML = function() {
    this.equation = stringifyMathML(this.mathML);
    return this.equation;
};